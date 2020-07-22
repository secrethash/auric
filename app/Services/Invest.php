<?php

namespace App\Services;

use Carbon\Carbon;
use App\ {
    Color,
    Lobby,
    Number,
    Order,
    Period,
    PeriodUser,
    User
};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Services\Transact;
use App\Services\Calculate;

class Invest {

    var $colors = [];
    var $numbers = [];

    public static function createPeriod()
    {
        $lobbies = Lobby::all();
        $now = Carbon::now();
        $date = $now->format('Ymd');
        $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
        $id = floor($id);
        $id = str_pad($id, 3, '0', STR_PAD_LEFT);
        $current = collect([]);

        foreach ($lobbies as $lobby)
        {
            $uid = $lobby->slug.'-'.$date.$id;
            // Collecting Current UIDs
            $current->push($uid);

            // Find UID in database then proceed
            $find = Period::whereUid($uid)->first();
            if (!$find)
            {
                // Creating new Periods
                $period = new Period;
                $period->uid = $uid;
                $period->start = $now->toDateTimeString();
                $period->lobby_id = $lobby->id;
                $period->active = 1;
                $period->save();
            }
        }

        // Processing Results
        self::processor($current);
        // Deactivating Old Periods
        self::deactivate($current);

        return true;
    }

    /**
     * Deactivating OLD Periods
     *
     * @var Illuminate\Support\Collection
     * @return bool
     */
    protected static function deactivate(Collection $current)
    {
        $periods = Period::where('active', 1)
                        ->whereNotIn('uid', $current->toArray())
                        ->get();

        foreach ($periods as $period) {
            if ($period->uid != $current)
            {
                $period->active = 0;
                $period->save();
            }
        }

        return true;
	}

	/**
	 * If a Lobby is active and 30 sec has elapsed, Pre-process
	 *
	 * @return mixed
	 */
	public static function preprocessor()
	{
        // Log::debug('Pre Processor Running!');

        $lobbies = Lobby::all();
        $now = Carbon::now()->subMinutes(2)->subSeconds(30);
        $date = $now->format('Ymd');
        $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
        $id = floor($id);
        $id = str_pad($id, 3, '0', STR_PAD_LEFT);

        $collection = collect([]);
        $check = false;

		foreach ($lobbies as $lobby)
        {
            $uid = $lobby->slug.'-'.$date.$id;
            // Collecting Current UIDs
            $collection->push($uid);

            $period = Period::whereUid($uid)->get();

            if($period->count())
            {
                $check = true;
            }
            else
            {
                $check = false;
                break;
            }
        }
        // Log::debug('Check for Preprocessor: '.$check);
        if ($check)
        {
            self::processor($collection, true);
        }

	}
    /**
     * Will Calculate Results
     *
     * @return mixed
     */
    protected static function processor(Collection $current, $pre = false)
    {
        if ($pre)
        {
            // Periods that are active and have elapsed
            // Log::debug('Executing $Pre');
            $periods = Period::where('active', 1)->get();
        }
        else
        {
            // Periods that are active and have elapsed
            $periods = Period::where('active', 1)
                            ->whereNotIn('uid', $current->toArray())
                            ->get();
        }

        foreach ($periods as $period) {

            if (!$period->processed)
            {
                // Log::debug('Period '.$period->uid.' is not processed');
                $colors = self::colors($period);
                $numbers = self::numbers($period);

                // Log::debug('Period: '.$period->uid);

                if($period->user->count())
                {
                    self::generate($colors->first(), $numbers->first(), $period);
                }
                else
                {
                    // Standby
                    self::standby($colors);
                }
                // self::generate($colors, $numbers, $period);

                $colors = Color::orderBy('weightage', 'desc')->get();
                $numbers = Number::orderBy('weightage', 'desc')->get();

                $color = $colors->first();
                $number = $numbers->first();


                $find = $color->numbers->where('id', $number->id);

                if (!$find->count())
                {

                    $check = false;

                    while (!$check)
                    {
                        foreach ($color->numbers as $colorNumbers)
                        {
                            if ($colorNumbers->number === $number->number)
                            {
                                $check = true;
                            }
                        }
                        if (!$check)
                        {

                            if ($period->user->count())
                            {
                                // Log::critical('Period Active!');
                                self::generate($color, $number, $period);
                            }
                            else
                            {
                                self::standby($colors);
                            }

                            // Log::critical('Check failed at Processor!');
                            // Log::critical('Color: '.$color->name.' & Number: '.$number->number);
                            $color = Color::orderBy('weightage', 'desc')->first();
                            $number = Number::orderBy('weightage', 'desc')->first();
                        }
                    }
                }

                self::save($color, $number, $period);
            }


        }
    }

    protected static function standby($colors)
    {
        // Working on Standby
        // Log::debug('Generating On Standby Mode!');

        $select = $colors->random();
        $number = $select->numbers->random();
        // Log::debug('Regenrate Select: '.$select);
        $select->weightage += 0.50;
        $select->save();
        $number->weightage += 0.50;
        $number->save();
    }

    protected static function generate($color, $number, Period $period)
    {
        //

        // Log::debug('Gen Selected Color: '.$color->name);
        // Log::debug('Gen Selected Number: '.$number->number);


        // Log::debug('Count Check in Gen is '.json_encode($color->numbers->where('id', $number->id)->count()));

        $check = false;
        while(!$check)
        {
            if (!$color->numbers->where('id', $number->id)->count())
            {
                $check = true;
            }
            else
            {
                $number = self::numbers($period)->first();
            }
            // Log::debug('Check in Gen is '.json_encode($check));
        }

        $numbersOfColors = $color->numbers;
        $colorsOfNumbers = $number->colors;

        // Processing Colors
        $colorAmount = self::amount($color, $period, 'color_id');
        $finalColorAmount = $colorAmount * 2;
        // Log::debug('Selected Color Amount: '.$finalColorAmount);

        $conAmount = self::sortAmount($colorsOfNumbers, $period, 'color_id');
        $conAmount = $conAmount->first();
        $con = Color::find($conAmount['id']);
        $conAmount = $conAmount['amount'] * 2;

        // Processing Numbers
        $numberAmount = self::amount($number, $period, 'number_id');
        $finalNumberAmount = $numberAmount * 9;
        // Log::debug('Selected Number Amount: '.$finalNumberAmount);

        $nocAmount = self::sortAmount($numbersOfColors, $period, 'number_id');
        $nocAmount = $nocAmount->first();
        $noc = Number::find($nocAmount['id']);
        $nocAmount = $nocAmount['amount'] * 9;

        // Log::debug('Colors of Numbers Amount: '.$conAmount);
        // Log::debug('Numbers of Colors Amount: '.$nocAmount);

        $colorNumber = $finalColorAmount + $nocAmount;
        $numberColor = $finalNumberAmount + $conAmount;

        // Log::debug('Color + NumberOfColor:'. $colorNumber);
        // Log::debug('Number + ColorOfNumber:'. $numberColor);

        if ($colorNumber < $numberColor)
        {

            // Log::debug('Color + NumberOfColor is lesser!');

            $color->weightage += 0.50;
            $color->save();
            $noc->weightage += 0.50;
            $noc->save();

        }
        elseif ($numberColor < $colorNumber)
        {

            // Log::debug('Number + ColorOfNumber is lesser!');

            $number->weightage += 0.50;
            $number->save();
            $con->weightage += 0.50;
            $con->save();

        }
        elseif ($colorNumber === $numberColor)
        {

            // Log::debug('(Number + ColorOfNumber) is equal to (Color + NumberOfColor) !');

            $number->weightage += 0.50;
            $number->save();
            $con->weightage += 0.50;
            $con->save();
        }
    }

    /**
     * Collect Colors
     *
     * @return App\Color
     */
    protected static function colors(Period $period)
    {
        // Log::debug('Period: '.$period->uid);
        $colors = Color::orderBy('weightage', 'desc')->get();

        // First set to default
        foreach ($colors as $color)
        {
            $color->weightage = $color->default;
            $color->save();
        }

        $colors = Color::orderBy('weightage', 'desc')->get();


        if (!$period->user->count())
        {
            // Log::debug('On Standby Mode!');
            $select = $colors->random();
        }
        else
        {
            // Log::debug('Period is Active!');

            $selected = self::sortAmount($colors, $period, 'color_id')->first();
            $select = Color::find($selected['id']);
        }

        $select->weightage += 0.25;
        $select->save();

        $colors = Color::orderBy('weightage', 'desc')->get();

        // // Log::debug('Colors after Process: '.json_encode($colors->all()));

        return $colors;
    }

    /**
     * Collect Numbers
     *
     * @return App\Number
     */
    protected static function numbers(Period $period)
    {

        $numbers = Number::orderBy('weightage', 'desc')->get();

        // First set to default
        foreach ($numbers as $number)
        {
            $number->weightage = $number->default;
            $number->save();
        }

        $numbers = Number::orderBy('weightage', 'desc')->get();


        if (!$period->user->count())
        {
            // Log::debug('On Standby Mode!');
            $select = $numbers->random();
        }
        else
        {
            // Log::debug('Period is Active!');

            $selected = self::sortAmount($numbers, $period, 'number_id')->first();
            $select = Number::find($selected['id']);
        }


        $select->weightage += 0.25;
        $select->save();

        $numbers = Number::orderBy('weightage', 'desc')->get();

        // // Log::debug('Numbers after Process: '.json_encode($numbers->all()));

        return $numbers;
    }

    /**
     * Sorting amount for a Model
     *
     * @var $model
     * @var \App\Period $period
     * @var string $reference
     * @return \Illuminate\Support\Collection
     */
    protected static function sortAmount($model, Period $period, $reference = '')
    {
        $amount = collect([]);

        foreach ($model as $m) {

            $count = self::amount($m, $period, $reference);

            $amount->push(['id'=>$m->id, 'amount'=>$count]);

            // Log::debug('Sorting Push: '.$amount->toJson());
        }

        $selected = $amount->shuffle()->sortBy('amount');

        Log::debug('Sorted Amount: '. $selected->toJson());

        return $selected;
    }

    /**
     * Total amount for a Model
     *
     * @var $model
     * @var \App\Period $period
     * @var string $reference
     * @return int amount
     */
    protected static function amount($model, Period $period, $reference = '')
    {

        $amount = 0;

        $periodUser = PeriodUser::where($reference, $model->id)
                                ->where('period_id', $period->id)
                                ->get();

        foreach ($periodUser as $pu)
        {
            // Log::debug('Counting Amount: '.$pu->amount);
            $amount += $pu->amount;
        }

        return $amount;

    }


    protected static function save(Color $color, Number $number, Period $period)
    {
        // Log::debug('Final Color Saved Results: '.$color->name);
        // Log::debug('Final Number Saved Results: '.$number->number);

        // Association for Violet
        if ($color->name === 'violet')
        {
            if ($number->number === 0)
            {
                // Associate Color Red
                $period->color()->associate(Color::whereName('red')->first());
            }
            elseif ($number->number === 5)
            {
                // Associate Color Green
                $period->color()->associate(Color::whereName('green')->first());
            }
        }
        else
        {
            // Associate the Orignal Selection
            $period->color()->associate($color);
        }

        $period->number()->associate($number);
        $period->price = rand(2000, 2999);
        $period->save();


        ////////////////////////////////
        // Saving Individual Results //
        //////////////////////////////

        $order = Order::whereType('roi')->first();

        // Period User For Number
        self::saveNumber($number, $period, $order);

        // Period User For Color
        self::saveColor($color, $number, $period, $order);

        // Save Failed Results
        self::saveFailed($color, $number, $period);

        $period->processed = 1;
        $period->save();


    }

    protected static function transact($amount, $user, $period, $order)
    {


        $data = [
            'amount' => $amount,
            'note' => 'Return on Investment for: '.$period->uid,
            'status' => 'success',
            'payment_id' => null,
            'request_id' => $period->uid
        ];

        $transact = Transact::create($data, $user, $order);
        $wallet = Transact::wallet($order->method, $amount, $user);

    }

    /**
     * Saving Success Color Results
     *
     * @return mixed
     */
    protected static function saveColor(Color $color, Number $number, Period $period, Order $order)
    {
        $colorId = collect([$color->id]);

        if ($color->name === 'violet')
        {
            // If Violet || 0
            if ($number->number === 0)
            {
                $colorId->push(Color::whereName('red')->first()->id);
            }
            elseif ($number->number === 5)
            {
                $colorId->push(Color::whereName('green')->first()->id);
            }
        }

        $periodUser = PeriodUser::where('period_id', $period->id)
                            ->whereIn('color_id', [$colorId->toArray()])
                            ->get();

        foreach ($periodUser as $pu)
        {
            $user = User::find($pu->user_id);
            $puColor = Color::find($pu->color_id);
            $calculate = new Calculate;
            $calculate->amount = $pu->amount;
            $calculate->color($puColor, $number);
            $amount = $calculate->prize();

            $pu->result = 1;
            $pu->delivery = $amount;
            $pu->save();

            self::transact($amount, $user, $period, $order);

        }

    }

    /**
     * Saving Success Number Results
     *
     * @return mixed
     */
    protected static function saveNumber(Number $number, Period $period, Order $order)
    {
        $periodUser = PeriodUser::where(['number_id' => $number->id, 'period_id' => $period->id])
                            ->get();

        foreach ($periodUser as $pu)
        {
            $user = User::find($pu->user_id);
            $calculate = new Calculate;
            $calculate->amount = $pu->amount;
            $calculate->number();
            $amount = $calculate->prize();

            $pu->result = 1;
            $pu->delivery = $amount;
            $pu->save();

            self::transact($amount, $user, $period, $order);
        }

    }

    /**
     * Saving Failed Results
     *
     * @return mixed
     */
    protected static function saveFailed(Color $color, Number $number, Period $period)
    {

        $puFailColor = PeriodUser::where('period_id', $period->id)
                            ->where('number_id', NULL)
                            ->whereNotIn('color_id', [$color->id])
                            ->get();

        // Log::debug('Save Bets: Color Result Failed: '.$puFailColor->toJson());

        foreach ($puFailColor as $pu)
        {
            $pu->result = 0;
            $pu->save();
        }

        $puFailNumber = PeriodUser::where('period_id', $period->id)
                            ->where('color_id', NULL)
                            ->whereNotIn('number_id', [$number->id])
                            ->get();

        // Log::debug('Save Bets: Color Result Failed: '.$puFailNumber->toJson());

        foreach ($puFailNumber as $pu)
        {
            $pu->result = 0;
            $pu->save();
        }

    }


    /**
     * Cleanup of old Periods and Transactions
     *
     * @return bool
     */
    public static function cleanup()
    {
        $now = Carbon::now();
        $from = $now->subDays(10);

        $periods = Period::all();

        foreach ($periods as $period) {

            if ($from->greaterThan($period->created_at))
            {
                $period->delete();
            }
        }
        return true;
    }


}
