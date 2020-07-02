<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ {
    Number,
    Period
};

class Color extends Model
{
    /**
     * Refrence to Numbers
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function numbers() {
        return $this->belongsToMany(Number::class, 'number_color');
    }

    /**
     * Refrence to Periods
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function period() {
        return $this->hasMany(Period::class);
    }
}
