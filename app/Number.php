<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ {
    Color,
    Period
};

class Number extends Model
{
    /**
     * Refrence to Colors
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function colors() {
        return $this->belongsToMany(Color::class, 'number_color');
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
