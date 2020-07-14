<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BankType;
use App\User;

class Bank extends Model
{
    //

    public function type()
    {
        return $this->belongsTo(BankType::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
