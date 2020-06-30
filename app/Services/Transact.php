<?php

namespace App\Services;

use Carbon\Carbon;
use App\ {
    Order,
    User,
    Transaction
};
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Transact {

    public static function create(array $data, User $user, Order $order)
    {
        $trans = new Transaction;
        $trans->sign = self::createUid();
        $trans->note = $data['note'] ?? 'No Information Provided';
        $trans->amount = $data['amount'];
        $trans->status = $data['status'] ?? 'processing';
        $trans->payment_id = $data['payment_id'];
        $trans->request_id = $data['request_id'];
        $trans->user_id = $user->id;
        $trans->order_id = $order->id;
        $trans->save();

        return $trans;
    }

    public static function wallet($method, $amount, User $user)
    {
        if ($method==='minus' OR $method==='substract' OR $method==='sub')
        {
            $user->credits = $user->credits - $amount;
        }
        elseif ($method==='plus' OR $method==='addition' OR $method==='add')
        {
            $user->credits = $user->credits + $amount;
        }
        else
        {
            return false;
        }

        $user->save();
        return $user->credits;
    }

    protected static function createUid()
    {
        $uid = Str::uuid();
        $trans = Transaction::whereSign($uid)->first();

        if (!$trans)
        {
            return $uid;
        }

        return self::createUid();
    }
}
