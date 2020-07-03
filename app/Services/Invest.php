<?php

namespace App\Services;

use Carbon\Carbon;
use App\ {
    Color,
    Lobby,
    Number,
    Period,
    PeriodUser
};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
     * Will Calculate Results
     *
     * @return mixed
     */
    protected static function processor(Collection $current)
    {
        // Periods that are active and have elapsed
        $periods = Period::where('active', 1)
                        ->whereNotIn('uid', $current->toArray())
                        ->get();

        foreach ($periods as $period) {

            $colors = self::colors($period);
            $numbers = self::numbers($period);

            $color = $colors->first();
            $number = $numbers->first();

            $find = $color->numbers->where('id', $number->id);

            if (!$find->count())
            {
                self::regenerate($color, $number, $period);

                $color = Color::orderBy('weightage')->first();
                $number = Number::orderBy('weightage')->first();
            }

            self::saveBets($color, $number, $period);


        }
    }

    protected static function saveBets(Color $color, Number $number, Period $period)
    {
        Log::debug('Final Color Saved Results: '.$color->name);
        Log::debug('Final Number Saved Results: '.$number->number);

        $period->color()->associate($color);
        $period->number()->associate($number);
        $period->save();

        $puNumber = PeriodUser::where(['number_id' => $number->id, 'period_id' => $period->uid])
                            ->get();

        foreach ($puNumber as $pu)
        {
            $pu->result = 1;
            $pu->save();
        }

        $puColor = PeriodUser::where(['color_id' => $color->id, 'period_id' => $period->id])
                            ->get();

        foreach ($puColor as $pu)
        {
            $pu->result = 1;
            $pu->save();
        }

        // Result Fails

        $puFail = PeriodUser::where('period_id', $period->uid)
                            ->whereNotIn('number_id', [$number->id])
                            ->whereNotIn('color_id', [$color->id])
                            ->get();

        foreach ($puFail as $pu)
        {
            $pu->result = 0;
            $pu->save();
        }

    }

    protected static function regenerate(Color $color, Number $number, Period $period)
    {
        $noc = $color->numbers;
        $con = $number->colors;

        if (!$period->user->count())
        {
            Log::debug('Regenerating On Standby Mode!');
            $select = $con->random();
            Log::debug('Regenrate Select: '.$select);
            $select->weightage += 0.25;
            $select->save();
        }
        else {
            Log::debug('Regenrate Period is Active!');
            $selected = self::sortAmount($noc, $period, 'number_id');
            Log::debug('Regenerated Selected: '.json_encode($selected));
            $selectNumber = Number::find($selected['id']);
            $amountNoc = $selected['amount'];

            $selected = self::sortAmount($noc, $period, 'number_id');
            Log::debug('Regenerated Selected: '.json_encode($selected));
            $selectColor = Color::find($selected['id']);
            $amountCon = $selected['amount'];

            if ($amountNoc > $amountCon)
            {
                $selectColor->weightage += 0.25;
                $selectColor->save();
            }
            else
            {
                $selectNumber->weightage += 0.25;
                $selectNumber->save();
            }

        }




        Log::debug('NOC: '.json_encode($noc));
        Log::debug('CON: '.json_encode($con));
    }

    protected static function sortAmount($model, Period $period, $reference = '')
    {
        $amount = collect([]);
        foreach ($model as $m) {
            $periodUser = $period->user->where($reference, $m->id);
            $count = 0;
            foreach ($periodUser as $pu)
            {
                $count += $pu->pivot->amount;
            }
            $amount->push(['id'=>$m->id, 'amount'=>$count]);
        }
        $selected = $amount->sortBy('amount')->first();

        return $selected;
    }

    /**
     * Collect Colors
     *
     * @return Collection
     */
    protected static function colors(Period $period)
    {

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
            Log::debug('On Standby Mode!');
            $select = $colors->random();
        }
        else
        {
            Log::debug('Period is Active!');
            $amount = collect([]);
            foreach ($colors as $color) {
                $periodUser = $period->user->where('color_id', $color->id);
                $colorAmount = 0;
                foreach ($periodUser as $pu)
                {
                    $colorAmount += $pu->pivot->amount;
                }
                $amount->push(['color'=>$color->id, 'amount'=>$colorAmount]);
            }
            $selected = $amount->sortBy('amount')->first();
            $select = Color::find($selected['color']);
        }

        $weightage = $select->weightage + 0.25;

        $select->weightage = $weightage;
        $select->save();

        Log::debug('Colors after Process: '.json_encode($colors->all()));

        $colors = Color::orderBy('weightage', 'desc')->get();

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
            Log::debug('On Standby Mode!');
            $select = $numbers->random();
        }
        else
        {
            Log::debug('Period is Active!');
            $amount = collect([]);
            foreach ($numbers as $number) {
                $periodUser = $period->user->where('number_id', $number->id);
                $numberAmount = 0;
                foreach ($periodUser as $pu)
                {
                    $numberAmount += $pu->pivot->amount;
                }
                $amount->push(['number'=>$number->id, 'amount'=>$numberAmount]);
            }
            $selected = $amount->sortBy('amount')->first();
            $select = Number::find($selected['number']);
        }

        $weightage = $select->weightage + 0.25;

        $select->weightage = $weightage;
        $select->save();

        Log::debug('Numbers after Process: '.json_encode($numbers->all()));

        $numbers = Number::orderBy('weightage', 'desc')->get();

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
