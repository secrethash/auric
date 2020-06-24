<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Transaction extends Model
{
    //

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
