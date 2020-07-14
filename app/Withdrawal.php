<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use App\ {
    User,
    Bank
};

class Withdrawal extends Model
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'code_sent_at' => 'datetime',
    ];


    /**
     * User who created the Withdrawal Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User who created the Withdrawal Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Check for verified Phone Number
     *
     * @return boolean
     */
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    /**
     * Marks phone as Verified
     *
     * @return mixed
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
            'verification_code' => NULL,
        ])->save();
    }

    /**
     * Text (sms) message with verification code
     *
     * @return mixed
     */
    public function textToVerify()
    {
        $code = random_int(100000, 999999);

        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.number');

        $this->forceFill([
            'verification_code' => $code,
            'code_sent_at' => $this->freshTimestamp(),
        ])->save();

        $country_code = $this->user()->country_code ?? config('auth.defaults.country_code');
        $to = strval($country_code.$this->user->phone);
        $amount = $this->amount - $this->fee;

        $message = "Hello from Auric Shops! Your One Time Password for a Withdrawal of ₹".$amount." is: ".$code." \n For Security reasons, don't share it with anyone!";


        $client = new Client($sid, $token);

        $client->messages->create(
            $to,
            [
                "body" => $message,
                "from" => $from
            ]
        );
    }

}
