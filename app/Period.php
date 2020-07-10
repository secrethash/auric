<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ {
    User,
    Color,
    Number
};

class Period extends Model
{
    //
    public function user()
    {
        return $this->belongsToMany(User::class)->withPivot(['amount', 'transaction_id', 'number_id', 'color_id', 'result', 'delivery']);
    }

    /**
     * Refrence to Color
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function color() {
        return $this->belongsTo(Color::class);
    }

    /**
     * Refrence to Number
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function number() {
        return $this->belongsTo(Number::class);
    }
}
