<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Period;

class Lobby extends Model
{
    //

    /**
     * Periods of the Lobby
     *
     * @
     */
    public function periods()
    {
        return $this->hasMany(Period::class);
    }

}
