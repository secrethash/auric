<?php

namespace App\Services;

use Carbon\Carbon;
use App\ {
    Color,
    Lobby,
    Number,
    Period
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

            Log::debug('Collect Colors: '.$colors->toJson());
            Log::debug('Collect Numbers: '.$numbers->toJson());

            if (!$period->user->count())
            {
                Log::debug('On Standby Mode!');
                $selectedColor = $colors->random();
            }
            else
            {
                Log::debug('Period is Active!');
                $selectedColor = $colors->sortBy('amount')->first();
            }

            foreach ($colors as $color)
            {
                $counter = 0;

                if ($color['color'] === $selectedColor['color'])
                {
                    Log::debug('Single Color: '.json_encode($color));
                    Log::debug('Selected Color: '.json_encode($selectedColor));

                    $weightage = $selectedColor['weightage'] + 0.25;
                    Log::debug('Weightage: '.$weightage);
                    $colors->replaceRecursive([$counter => [ 'color' => $color['color'], 'amount' => $selectedColor['amount'], 'weightage' => $weightage]]);
                }

                $counter ++;
            }

            Log::debug('Colors after Process: '.json_encode($colors->all()));

        }
    }

    /**
     * Collect Colors
     *
     * @return Collection
     */
    protected static function colors(Period $period)
    {
        $collection = collect([]);

        $colors = Color::all();
        foreach ($colors as $color)
        {
            $collection->push(['color' => $color->name, 'amount' => 0, 'weightage' => $color->weightage]);
        }

        foreach ($period->user as $periodUser)
        {
            $color = Color::find($periodUser->pivot->color_id);
            if ($color)
            {
                $amount = $periodUser->pivot->amount + $collection->where($color->name)->get('amount');
                $collection->merge(['color' => $color->name, 'amount' => $amount]);
            }
        }

        return $collection->sortByDesc('weightage');
    }

    /**
     * Collect Colors
     *
     * @return Collection
     */
    protected static function numbers(Period $period)
    {
        $collection = collect([]);

        $numbers = Number::all();
        foreach ($numbers as $number)
        {
            $collection->push(['number' => $number->number, 'amount' => 0, 'weightage' => $number->weightage]);
        }

        foreach ($period->user as $periodUser)
        {
            $number = Number::find($periodUser->pivot->number_id);
            if ($number)
            {
                $collection->merge(['number' => $number->number, 'amount' => $periodUser->pivot->amount]);
            }
        }

        return $collection->sortByDesc('weightage');
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
