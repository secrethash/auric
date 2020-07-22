<?php

namespace Depricated\App\Services;
use App\ {
    Color,
    Number,
    Period,
};

use Illuminate\Support\Facades\Log;

class Invest {

    public static function generate($colors, $numbers, Period $period)
    {
        //

        if($period->user->count())
        {
            Log::debug('Generate Period is Active! Period: '.$period->uid);

            $selected = self::sortAmount($numbers, $period, 'number_id')->first();
            $selectedNumber = Number::find($selected['id']);
            $amountNumber = $selected['amount']; // red, 8 = 900*8

            Log::debug('Generated Number Selected: '.json_encode($selectedNumber->number));

            $selected = self::sortAmount($colors, $period, 'color_id');
            $rejected = $selected->last();
            $selected = $selected->first();
            $selectedColor = Color::find($selected['id']);
            $amountColor = $selected['amount']; // 7, green = 1000X2

            $rejectedColor = Color::find($rejected['id']);
            $rejectedColor->weightage -= 0.25;
            $rejectedColor->save();

            Log::debug('Generated Color Selected: '.json_encode($selectedColor->name));

            $color = Color::orderBy('weightage', 'desc')->first();
            $number = Number::orderBy('weightage', 'desc')->first();

            if ($amountNumber < $amountColor)
            {
                Log::debug('Amount for Number: '.$selectedNumber->number.' is Lesser.');

                // Check for 0 and 5
                $count = $selectedNumber->colors->where('id', $selectedColor->id)->count();
                Log::debug('Color Check Count: '.$count);

                if ($count)
                {
                    $selectedColor->weightage -= 0.25;
                    $selectedColor->save();
                    $selectedNumber->weightage -= 0.25;
                    $selectedNumber->save();

                    return self::regenerate(Color::orderBy('weightage', 'desc')->first(), Number::orderBy('weightage', 'desc')->first(), $period);
                }
                else
                {

                    $selectedColor->weightage -= 0.25;
					$selectedColor->save();

                    $selectedNumber->weightage += 0.50;
                    $selectedNumber->save();
                    $color->weightage += 0.50;
                    $color->save();
                }
            }
            elseif ($amountColor < $amountNumber)
            {
                Log::debug('Amount for Color: '.$selectedColor->name.' is Lesser.');


                $count = $selectedColor->numbers->where('id', $selectedNumber->id)->count();
                Log::debug('Number Check Count: '.$count);

                if ($count)
                {
                    $selectedNumber->weightage -= 0.25;
                    $selectedNumber->save();
                    $selectedColor->weightage -= 0.25;
                    $selectedColor->save();

                    return self::regenerate(Color::orderBy('weightage', 'desc')->first(), Number::orderBy('weightage', 'desc')->first(), $period);
                }
                else
                {

                    $selectedNumber->weightage -= 0.25;
					$selectedNumber->save();

                    $selectedColor->weightage += 0.50;
                    $selectedColor->save();
                    $number->weightage += 0.50;
                    $number->save();
                }

            }
            elseif ($amountColor === $amountNumber)
            {
                Log::debug('Else for Generate!');
                Log::debug('AmountColor: '.$amountColor.' For Color: '.$selectedColor->name.' And Number: '.$number->number);
                Log::debug('AmountNumber: '.$amountNumber.' For Number: '.$selectedNumber->number.' And Color: '.$color->name);

                $num = $selectedColor->numbers;
                $selected = self::sortAmount($num, $period, 'number_id')->first();
                $selectedNumber = Number::find($selected['id']);

                $selectedColor->weightage += 0.50;
                $selectedColor->save();
                $selectedNumber->weightage += 0.50;
                $selectedNumber->save();
            }
        }
        else
        {
            // Log::debug('Generating On Standby Mode!');
            $select = $colors->random();
            $number = $select->numbers->random();
            // Log::debug('Regenrate Select: '.$select);
            $select->weightage += 0.25;
            $select->save();
            $number->weightage += 0.25;
            $number->save();
        }
    }

    protected static function regenerate(Color $color, Number $number, Period $period)
    {
        $noc = $color->numbers;
        $con = $number->colors;

        if ($period->user->count())
        {
            Log::debug('Regenrate Period is Active! Period: '.$period->uid);

            $selected = self::sortAmount($noc, $period, 'number_id')->first();
            $selectedNumber = Number::find($selected['id']);
            Log::debug('Regenerated Number Selected: '.json_encode($selectedNumber->number).' after: '.$number->number);
            $amountNumber = $selected['amount']; // red, 8 = 100

            $selected = self::sortAmount($con, $period, 'color_id')->first();
            $selectedColor = Color::find($selected['id']);
            Log::debug('Regenerated Color Selected: '.json_encode($selectedColor->name).' after: '.$color->name);
            $amountColor = $selected['amount']; // 7, green = 10

            if ($amountNumber < $amountColor)
            {

                Log::debug('Regenerate: Amount for Number: '.$selectedNumber->number.' is Lesser.');
                // Check for 0 and 5
                $count = $selectedNumber->colors->where('id', $selectedColor->id)->count();
                Log::debug('Regenerate: Color Check Count: '.$count);

                if ($count)
                {
                    Log::debug('Rejected Number: '.$selectedNumber->number.' Rejected Color: '.$selectedColor->name);
                    $selectedColor->weightage -= 0.25;
                    $selectedColor->save();
                    $selectedNumber->weightage -= 0.25;
                    $selectedNumber->save();

                    return self::regenerate(Color::orderBy('weightage', 'desc')->first(), Number::orderBy('weightage', 'desc')->first(), $period);
                }
                else
                {
                    Log::debug('Color Rejected: '.$selectedColor->name);
                    $selectedColor->weightage -= 0.25;
					$selectedColor->save();
					// $number->weightage -= 0.25;
					// $number->save();

                    Log::debug('Number Selected: '.$selectedNumber->number.' Color Selected: '.$color->name);
                    $selectedNumber->weightage += 0.50;
                    $selectedNumber->save();
                    $color->weightage += 0.50;
                    $color->save();
                }
            }
            elseif ($amountColor < $amountNumber)
            {
                Log::debug('Regenerate: Amount for Color: '.$selectedColor->name.' is Lesser.');

                // Check for Violet
                $count = $selectedColor->numbers->where('id', $selectedNumber->id)->count();
                Log::debug('Regenerate: Number Check Count: '.$count);

                if ($count)
                {
                    Log::debug('Rejected Number: '.$selectedNumber->number.' Rejected Color: '.$selectedColor->name);
                    $selectedNumber->weightage -= 0.25;
                    $selectedNumber->save();
                    $selectedColor->weightage -= 0.25;
                    $selectedColor->save();

                    return self::regenerate(Color::orderBy('weightage', 'desc')->first(), Number::orderBy('weightage', 'desc')->first(), $period);
                    // return self::regenerate($selectedColor, $number, $period);
                }
                else
                {
                    Log::debug('Number Rejected: '.$selectedNumber->number);
                    $selectedNumber->weightage -= 0.25;
					$selectedNumber->save();

                    Log::debug('Color Selected: '.$selectedColor->name.' Number Selected: '.$number->number);
                    $selectedColor->weightage += 0.50;
                    $selectedColor->save();
                    $number->weightage += 0.50;
                    $number->save();
                }
            }
            elseif ($amountColor === $amountNumber)
            {
                Log::debug('Else for Regenerate!');
                Log::debug('AmountColor: '.$amountColor.' For Color: '.$selectedColor->name.' And Number: '.$number->number);
                Log::debug('AmountNumber: '.$amountNumber.' For Number: '.$selectedNumber->number.' And Number: '.$color->name);

                $num = $selectedColor->numbers;
                $selected = self::sortAmount($num, $period, 'number_id')->first();
                $selectedNumber = Number::find($selected['id']);

                Log::debug('Regenerated Number Selected: '.json_encode($selectedNumber->number).' after: '.$number->number);
                // $amountNumber = $selected['amount'];
                Log::debug('Elseif Regenerated Color Selected: '.json_encode($selectedColor->name).' after: '.$color->name);

                $selectedColor->weightage += 0.50;
                $selectedColor->save();
                $selectedNumber->weightage += 0.50;
                $selectedNumber->save();
            }

        }

        else
        {
            $select = $con->random();
            $select->weightage += 0.50;
            $select->save();
            $number->weightage += 0.50;
            $number->save();
        }

    }
}
