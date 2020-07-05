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

class Invest {

    var $colors = [];
    var $numbers = [];

    public static function createPeriod()
    {
        $lobbies = Lobby::all();
        $now = Carbon::now();
        $date = $now->format('Ymd');
        $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
        $current = collect([]);

        foreach ($lobbies as $lobby)
        {
            $uid = $lobby->slug.'-'.$date.floor($id);
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
        $collection = collect([]);
        $check = false;

		foreach ($lobbies as $lobby)
        {
            $uid = $lobby->slug.'-'.$date.floor($id);
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

                $color = $colors->first();
                $number = $numbers->first();

                self::generate($color, $number, $period);

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
                            self::regenerate($color, $number, $period);

                            $color = Color::orderBy('weightage', 'desc')->first();
                            $number = Number::orderBy('weightage', 'desc')->first();
                        }
                    }
                }

                self::saveBets($color, $number, $period);
            }


        }
    }

    protected static function saveBets(Color $color, Number $number, Period $period)
    {
        // Log::debug('Final Color Saved Results: '.$color->name);
        // Log::debug('Final Number Saved Results: '.$number->number);

        // Association for Violet
        if ($color->name === 'violet')
        {
            if ($number->number === 0)
            {
                // Also Associate Color Red
                $period->color()->associate(Color::whereName('red')->first());
            }
            elseif ($number->number === 5)
            {
                // Also Associate Color Green
                $period->color()->associate(Color::whereName('green')->first());
            }
        }
        else
        {
            // Associate the Orignal Selection
            $period->color()->associate($color);
        }

        $period->number()->associate($number);
        $period->price = rand(20000, 29999);
        $period->save();

        $order = Order::whereType('roi')->first();

        $puNumber = PeriodUser::where(['number_id' => $number->id, 'period_id' => $period->id])
                            ->get();

        foreach ($puNumber as $pu)
        {
            $pu->result = 1;
            $pu->save();
            self::transact($pu, $period, $order);
        }

        $colorId = collect([$color->id]);

        if ($color->name === 'violet')
        {
            // If Violet || 0
            if ($number->number === '0')
            {
                $colorId->push(Color::whereName('red')->first()->id);
            }
            elseif ($number->number === '5')
            {
                $colorId->push(Color::whereName('green')->first()->id);
            }
        }

        $puColor = PeriodUser::where('period_id', $period->id)
                            ->whereIn('color_id', [$colorId->toArray()])
                            ->get();

        foreach ($puColor as $pu)
        {
            $pu->result = 1;
            $pu->save();
            self::transact($pu, $period, $order);

        }

        // Result Fails

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

        $period->processed = 1;
        $period->save();


    }

    protected static function transact($pu, $period, $order)
    {

        // Create Transaction
        $user = User::find($pu->user_id);
        $amount = $pu->amount;
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

    public static function generate(Color $color, Number $number, Period $period)
    {
        //
        if($period->user->count())
        {
            // Log::debug('Generate Period is Active! Period: '.$period->uid);
            $selected = self::sortAmount($color->numbers, $period, 'number_id')->first();
            $selectedNumber = Number::find($selected['id']);
            // Log::debug('Generated Number Selected: '.json_encode($selectedNumber->number).' after: '.$number->number);
            $amountNumber = $selected['amount']; // red, 8 = 100

            $selected = self::sortAmount($number->colors, $period, 'color_id')->first();
            $selectedColor = Color::find($selected['id']);
            // Log::debug('Generated Color Selected: '.json_encode($selectedColor->name).' after: '.$color->name);
            $amountColor = $selected['amount']; // 7, green = 10

            if ($amountNumber < $amountColor)
            {
                Log::debug('Amount for Number: '.$selectedNumber->number.' is Lesser.');

                $count = $selectedNumber->colors->where('id', $selectedColor->id)->count();
                Log::debug('Color Check Count: '.$count);

                if ($count)
                {
                    return self::regenerate($color, $selectedNumber, $period);
                }
                else
                {
                    $selectedNumber->weightage += 0.50;
                    $selectedNumber->save();
                    $color->weightage += 0.50;
                    $color->save();
                }
            }
            elseif ($amountColor < $amountNumber)
            {
                // Log::debug('Amount for Color: '.$selectedColor->name.' is Lesser.');


                $count = $selectedColor->numbers->where('id', $selectedNumber->id)->count();
                // Log::debug('Number Check Count: '.$count);

                if ($count)
                {
                    return self::regenerate($selectedColor, $number, $period);
                }
                else
                {
                    $selectedColor->weightage += 0.50;
                    $selectedColor->save();
                    $number->weightage += 0.50;
                    $number->save();
                }

            }
            elseif ($amountColor === $amountNumber)
            {
                // Log::debug('Else for Generate!');
                // Log::debug('AmountColor: '.$amountColor.' For Color: '.$selectedColor->name.' And Number: '.$number->number);
                // Log::debug('AmountNumber: '.$amountNumber.' For Number: '.$selectedNumber->number.' And Color: '.$color->name);

                $num = $selectedColor->numbers;
                $selected = self::sortAmount($num, $period, 'number_id')->first();
                $selectedNumber = Number::find($selected['id']);

                $selectedColor->weightage += 0.50;
                $selectedColor->save();
                $selectedNumber->weightage += 0.50;
                $selectedNumber->save();
            }
        }
    }

    protected static function regenerate(Color $color, Number $number, Period $period)
    {
        $noc = $color->numbers;
        $con = $number->colors;

        if (!$period->user->count())
        {
            // Log::debug('Regenerating On Standby Mode!');
            $select = $con->random();
            // Log::debug('Regenrate Select: '.$select);
            $select->weightage += 0.50;
            $select->save();
            $number->weightage += 0.50;
            $number->save();
        }
        else {
            // Log::debug('Regenrate Period is Active! Period: '.$period->uid);
            $selected = self::sortAmount($noc, $period, 'number_id')->first();
            $selectedNumber = Number::find($selected['id']);
            // Log::debug('Regenerated Number Selected: '.json_encode($selectedNumber->number).' after: '.$number->number);
            $amountNumber = $selected['amount']; // red, 8 = 100

            $selected = self::sortAmount($con, $period, 'color_id')->first();
            $selectedColor = Color::find($selected['id']);
            // Log::debug('Regenerated Color Selected: '.json_encode($selectedColor->name).' after: '.$color->name);
            $amountColor = $selected['amount']; // 7, green = 10

            if ($amountNumber < $amountColor)
            {

                // Log::debug('Regenerate: Amount for Number: '.$selectedNumber->number.' is Lesser.');

                $count = $selectedNumber->colors->where('id', $selectedColor->id)->count();
                // Log::debug('Regenerate: Color Check Count: '.$count);

                if ($count)
                {
                    return self::regenerate($color, $selectedNumber, $period);
                }
                else
                {
                    $selectedNumber->weightage += 0.50;
                    $selectedNumber->save();
                    $color->weightage += 0.50;
                    $color->save();
                }
            }
            elseif ($amountColor < $amountNumber)
            {
                // Log::debug('Regenerate: Amount for Color: '.$selectedColor->name.' is Lesser.');


                $count = $selectedColor->numbers->where('id', $selectedNumber->id)->count();
                // Log::debug('Regenerate: Number Check Count: '.$count);

                if ($count)
                {
                    return self::regenerate($selectedColor, $number, $period);
                }
                else
                {
                    $selectedColor->weightage += 0.50;
                    $selectedColor->save();
                    $number->weightage += 0.50;
                    $number->save();
                }
            }
            elseif ($amountColor === $amountNumber)
            {
                // Log::debug('Else for Regenerate!');
                // Log::debug('AmountColor: '.$amountColor.' For Color: '.$selectedColor->name.' And Number: '.$number->number);
                // Log::debug('AmountNumber: '.$amountNumber.' For Number: '.$selectedNumber->number.' And Number: '.$color->name);

                $num = $selectedColor->numbers;
                $selected = self::sortAmount($num, $period, 'number_id')->first();
                $selectedNumber = Number::find($selected['id']);

                $count = $selectedNumber->colors->where('id', $selectedColor->id)->count();
                // Log::debug('ElseIf for Regenerate: Color Check Count: '.$count);

                if ($count)
                {
                    return self::regenerate($color, $selectedNumber, $period);
                }
                else
                {
                    $selectedColor->weightage += 0.50;
                    $selectedColor->save();
                    $selectedNumber->weightage += 0.50;
                    $selectedNumber->save();
                }

                // Log::debug('Regenerated Number Selected: '.json_encode($selectedNumber->number).' after: '.$number->number);
                // $amountNumber = $selected['amount'];
                // Log::debug('Elseif Regenerated Color Selected: '.json_encode($selectedColor->name).' after: '.$color->name);

                $selectedColor->weightage += 0.50;
                $selectedColor->save();
                $selectedNumber->weightage += 0.50;
                $selectedNumber->save();
            }

        }




        // Log::debug('NOC: '.json_encode($noc));
        // Log::debug('CON: '.json_encode($con));
    }

    protected static function sortAmount($model, Period $period, $reference = '')
    {
        $amount = collect([]);

        foreach ($model as $m) {
            // $periodUser = $period->user->where($reference, $m->id);
            $periodUser = PeriodUser::where($reference, $m->id)
                                    ->where('period_id', $period->id)
                                    ->get();

            // Log::debug('Sorting Model: '.json_encode($m).' and Refrence: '.$reference);
            // Log::debug('Sorting Amount: Period->User'. $periodUser->toJson());
            // Log::debug('Sorting Amount Count: Period->User: '. $periodUser->count());

            $count = 0;
            foreach ($periodUser as $pu)
            {
                // Log::debug('Counting Amount: '.$pu->amount);
                $count += $pu->amount;
            }
            $amount->push(['id'=>$m->id, 'amount'=>$count]);
            // Log::debug('Sorting Push: '.$amount->toJson());
        }
        $selected = $amount->shuffle()->sortBy('amount');

        // Log::debug('Sorted Amount: '. $selected->toJson());

        return $selected;
    }

    /**
     * Collect Colors
     *
     * @return Collection
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

        $weightage = $select->weightage + 0.25;

        $select->weightage = $weightage;
        $select->save();

        $colors = Color::orderBy('weightage', 'desc')->get();

        // Log::debug('Colors after Process: '.json_encode($colors->all()));

        return $colors;
    }

    /**
     * Collect Colors
     *
     * @return Collection
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

        $weightage = $select->weightage + 0.25;

        $select->weightage = $weightage;
        $select->save();

        $numbers = Number::orderBy('weightage', 'desc')->get();

        // Log::debug('Numbers after Process: '.json_encode($numbers->all()));

        return $numbers;
    }

    /**
     * Cleanup of old Periods
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
