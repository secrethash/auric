<?php

namespace App\Services;

use App\Color;
use App\Number;
use App\Period;

class Calculate {


    public float $amount;
    protected $prize;
    protected $commission = [];
    protected $condition = [];
    protected $comitted;

    const COMMISSION = [10, 2];
    const CONDITION = [99, 100];

    // Prize Multiplier
    const NUMBER = 9;

    const COLOR_GREEN = 2;
    const COLOR_GREEN_FIVE = 1.5;

    const COLOR_RED = 2;
    const COLOR_RED_ZERO = 1.5;

    const COLOR_VIOLET = 4.5;

    /**
     * Constructor
     *
     * @return App\Services\Calculate
     */
    public function __construct($commission = [], $condition = [])
    {
        $this->commission = empty($commission) ? self::COMMISSION : $commission;
        $this->condition = empty($condition) ? self::CONDITION : $condition;
    }

    /**
     * Calculate Commission
     *
     * @return int $commission
     */
    public function commission(float $amount = null)
    {
        $amount = $amount ?? $this->amount;
        if ($amount < 100)
        {
            $commission = $amount * $this->commission[0] / 100;
        }
        elseif ($amount >= 100)
        {
            $commission = $amount * $this->commission[1] / 100;
        }
        else
        {
            return false;
        }

        $this->amount = $amount - $commission;
        $this->committed = $commission;
        return $commission;

    }

    public function number()
    {
        //
        $prize = $this->amount * self::NUMBER;

        $this->prize = $prize;

        return true;
    }

    public function color(Color $color, Number $number)
    {
        if ($color->name === 'violet')
        {
            $prize = $this->amount * self::COLOR_VIOLET;
        }
        elseif ($color->name === 'red')
        {
            if ($number->number == 0)
            {
                $prize = $this->amount * self::COLOR_RED_ZERO;
            }
            else {
                $prize = $this->amount * self::COLOR_RED;
            }
        }
        elseif ($color->name === 'green')
        {
            if ($number->number == 5)
            {
                $prize = $this->amount * self::COLOR_GREEN_FIVE;
            }
            else {
                $prize = $this->amount * self::COLOR_GREEN;
            }
        }
        else {
            return false;
        }

        $this->prize = $prize;

        return true;
    }

    public function prize()
    {
        return $this->prize;
    }

    public function final()
    {
        //
        return $this->amount;
    }
}
