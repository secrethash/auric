<?php

namespace App\Services;

use Carbon\Carbon;
use App\ {
    Lobby,
    Period
};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Invest {

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
        self::process($current);
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
    protected static function process(Collection $current)
    {
        // Periods that are active and have elapsed
        // $periods = Period::where('active', 1)
        //                 ->whereNotIn('uid', $current->toArray())
        //                 ->get();

        // foreach ($periods as $period) {

        //     $green = $period->user()->where('invest_color', 'green');
        //     $red = $period->user()->where('invest_color', 'red');
        //     $violet = $period->user()->where('invest_color', 'violet');

        //     $color = [
        //         [
        //             'color' => 'green',
        //             'obj' => $green,
        //             'count' => $green->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'color' => 'red',
        //             'obj' => $red,
        //             'count' => $red->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'color' => 'violet',
        //             'obj' => $violet,
        //             'count' => $violet->count(),
        //             'weightage' => 0
        //         ]
        //     ];

        //     $numZero = $period->user()->where('invest_number', 0);
        //     $numOne = $period->user()->where('invest_number', 1);
        //     $numTwo = $period->user()->where('invest_number', 2);
        //     $numThree = $period->user()->where('invest_number', 3);
        //     $numFour = $period->user()->where('invest_number', 4);
        //     $numFive = $period->user()->where('invest_number', 5);
        //     $numSix = $period->user()->where('invest_number', 6);
        //     $numSeven = $period->user()->where('invest_number', 7);
        //     $numEight = $period->user()->where('invest_number', 8);
        //     $numNine = $period->user()->where('invest_number', 9);

        //     $number = [
        //         [
        //             'obj' => $numZero,
        //             'count' => $numZero->count(),
        //             'weightage' => 0
        //         ],
        //         [
        //             'obj' => $numOne,
        //             'count' => $numOne->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numTwo,
        //             'count' => $numTwo->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numThree,
        //             'count' => $numThree->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numFour,
        //             'count' => $numFour->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numFive,
        //             'count' => $numFive->count(),
        //             'weightage' => 0
        //         ],
        //         [
        //             'obj' => $numSix,
        //             'count' => $numSix->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numSeven,
        //             'count' => $numSeven->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numEight,
        //             'count' => $numEight->count(),
        //             'weightage' => 0.10
        //         ],
        //         [
        //             'obj' => $numNine,
        //             'count' => $numNine->count(),
        //             'weightage' => 0.10
        //         ],
        //     ];

        //     $collection = collect(['numbers' => $number, 'colors' => $color]);

        //     // $numberCollect = collect([
        //     //     $number[0]['count'],
        //     //     $number[1]['count'],
        //     //     $number[2]['count'],
        //     //     $number[3]['count'],
        //     //     $number[4]['count'],
        //     //     $number[5]['count'],
        //     //     $number[6]['count'],
        //     //     $number[7]['count'],
        //     //     $number[8]['count'],
        //     //     $number[9]['count'],
        //     // ]);
        //     // $number['sorted'] = $numberCollect->sortDesc();

        //     // $color['least'] = $color['sorted']->last();
        //     // $number['least'] = $number['sorted']->last();

        //     // $number = collect($number);
        //     // $color = collect($color);

        //     if ($collection->where('colors')->contains(function ($value, $key){
        //         if ($key==='count')
        //         {
        //             return $value <= 0;
        //         }
        //         Log::debug('Key: '.$key);
        //         Log::debug('Value: '.$value);
        //     }))
        //     {
        //         // $collection->where('colors')->get('sorted')->reject(function($value, $key) {
        //         //     return $value <= 0;
        //         // });
        //         Log::debug('Color Contains Zero!');
        //     }

        //     // if ($collection->where('numbers')->get('count')->contains(0))
        //     // {
        //     //     // $collection->where('number')->get('sorted')->reject(function($value, $key) {
        //     //     //     return $value <= 0;
        //     //     // });
        //     //     Log::debug('Number Containes Zero!');
        //     // }

        //     Log::debug('Collection to Json: '. $collection->toJson());






        // }
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
