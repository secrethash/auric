<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class Pay {

    /**
     * Name of the Payment Gateway
     *
     * @var string gateway
     */
    protected $gateway = 'paypal';

    /**
     * API Key of the gateway
     *
     * @var string api
     */
    protected $api = '';

    /**
     * API Secret Key of the Gateway
     *
     * @var string secret
     */
    protected $secret = '';

    /**
     * Store Payment ID (if capture success)
     *
     * @var string paymentId
     */
    public string $paymentId = '';

    /**
     * Store Payment Errors (if capture fails)
     *
     * @var string error
     */
    public string $error = '';

    /**
     * Initialize Payments
     *
     * @return mixed
     */
    public function __construct($gateway, $api, $secret)
    {
        $this->gateway = $gateway;
        $this->api = $api;
        $this->secret = $secret;
    }

    /**
     * Start the payment process
     *
     * @return mixed
     */
    public function initialize($amount, $currency, Request $request, array $card = [])
    {
        if ($this->gateway === 'razorpay')
        {
            return $this->_razorpay_init($amount, $currency, $request);
        }
        elseif ($this->gateway === 'stripe')
        {
            return $this->_stripe_init($amount, $currency, $request);
        }

        $init = Omnipay::create(ucfirst($this->gateway));
        $init->setApiKey($this->secret);

        // $card = $request->only(['card-number', 'card-holder', 'card-exp-mm', 'card-exp-yy', 'card-cvv']);
        $response = $init->purchase([
            'amount' => $amount,
            'currency' => $currency,
            'card' => $card,
        ])->send();

        if ($response->isSuccessful())
        {
            Log::debug('Payment Gateway Response: isSuccessful');
            Log::debug('Response: '.json_encode($response));
        }
        elseif ($response->isRedirect())
        {
            Log::debug('Payment Gateway Response: isRedirect');
            Log::debug('Response: '.json_encode($response));
            $response->redirect();
        }
        else
        {
            Log::debug('Payment Gateway Response: Failed');
            Log::debug('Response: '.json_encode($response));
            Log::debug('Response Message: '.$response->getMessage());
        }

    }

    /**
     * Capture Payments
     *
     * @return mixed
     */
    public function capture($order, Request $request)
    {
        if ($this->gateway === 'razorpay')
        {
            return $this->_razorpay_capture($order, $request);
        }
        elseif ($this->gateway === 'stripe')
        {
            return $this->_stripe_capture($order, $request);
        }
    }

    /**
     * Razorpay Initialize
     *
     * @return array
     */
    protected function _razorpay_init($amount, $currency, Request $request)
    {
        $rzp = new Api($this->api, $this->secret);

        $creation = array(
            'receipt' => uniqid(),
            'amount' => $amount * 100,
            'currency' => $currency,
            'payment_capture' => 1
        );

        $order = $rzp->order->create($creation); // Creates order

        $data = [
            "key"               => $this->api,
            "amount"            => $amount * 100,
            "name"              => setting('site.title'),
            "description"       => 'Your one Stop Shop',
            "prefill"           => [
                "name"          => $request->user()->name,
                "contact"       => $request->user()->phone,
                "email"         => $request->user()->email,
            ],
            "order_id"          => $order['id'],
            "display_currency"  => $currency,
            "display_amount"    => $amount,
            "theme"             => [
                "image_padding" => false,
            ],
        ];

        return $data;

    }

    /**
     * Capture Razorpay Payments
     *
     * @return bool
     */
    protected function _razorpay_capture($order, Request $request)
    {

        $payment = $request->input('razorpay_payment_id');
        $signature = $request->input('razorpay_signature');
        $success = true;

        if (!empty($payment))
        {
            $api = new Api($this->api, $this->secret);
            try
            {

                $attributes = array(
                    'razorpay_order_id' => $order,
                    'razorpay_payment_id' => $payment,
                    'razorpay_signature' => $signature
                );
                $verification = $api->utility->verifyPaymentSignature($attributes);

            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $this->error = 'Payment Error : ' . $e->getMessage();
            }
        }

        $this->paymentId = ($success) ? $payment : '';
        return $success;


    }


    /**
     * Stripe Initialize
     *
     * @return array
     */
    protected function _stripe_init($amount, $currency, Request $request)
    {
        Stripe::setApiKey(config('payment.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => $currency,
        ]);
        return ['order_id' => $intent->id, 'client_secret' => $intent->client_secret];
    }

    /**
     * Stripe Capture
     *
     * @return mixed
     */
    protected function _stripe_capture($order, Request $request)
    {
        ## Code..
        Stripe::setApiKey(config('payment.stripe.secret'));

        $intent = PaymentIntent::retrieve($order);

        if ($intent->amount_capturable === 0)
        {
            $this->paymentId = $order;
            return true;
        }

        return false;
    }

}
