<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Illuminate\Support\Facades\Log;
use App\ {
    Transaction,
    Period,
    Withdrawal,
    Bank
};

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password', 'referrer_id', 'username', 'email', 'country_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'code_sent_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link'];


    /**
     * User's Transcations
     *
     * @return \App\Transaction
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * A user has many Bank Details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->hasMany(Bank::class);
    }

    /**
     * A user has many Bank Details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    /**
     * Periods of Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function periods()
    {
        return $this->belongsToMany(Period::class)->withPivot(['amount', 'fees', 'transaction_id', 'number_id', 'color_id', 'result', 'created_at', 'delivery']);
    }

    /**
     * Get the user's referral link.
     *
     * @return string
     */
    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
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

        $country_code = $this->country_code ?? config('auth.defaults.country_code');
        $to = strval($country_code.$this->phone);

        Log::debug('To Phone: '.$to);

        $message = "Hello from Auric Shops! Your One Time Password is: ".$code." \n For Security reasons, don't share this with anyone!";


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
