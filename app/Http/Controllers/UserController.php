<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\Transact;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display Account Options
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        //
        return view('user.account')->with('user', auth()->user());
    }


    /**
     *
     *
     * @return redirect Route
     */
    public function logout() {

        Auth::logout();

        return redirect()->route('home');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function referral()
    {
        //
        return view('user.referral')->with('user', auth()->user());
    }

    /**
     * User Wallet Show.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wallet()
    {
        //
        return view('user.wallet.index')->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function walletAdd()
    {
        //
        return view('user.wallet.add')->with('user', auth()->user());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        //

        $validated = $request->validate([
            "amount" => ["numeric", "min:100", "required"],
        ]);

        $key = env("RAZORPAY_KEY");
        $secret = env("RAZORPAY_SECRET");
        $api = new Api($key, $secret);

        $creation = array(
            'receipt' => uniqid(),
            'amount' => $validated['amount'],
            'currency' => 'INR',
            'payment_capture' => 1
        );
        Log::debug('Razorpay Key: '.$key);
        Log::debug('Razorpay Secret: '.$secret);
        $order = $api->order->create($creation); // Creates order

        // Record Transaction
        $orderType = Order::whereType('wallet-plus')->first();
        $user = $request->user();
        $data = [
            "note" => "Adding Money to Wallet.",
            "amount" => $validated['amount'],
            "request_id" => $order['id'],
            "payment_id" => NULL,
        ];
        $transact = Transact::create($data, $user, $orderType);

        $data = [
            "key"               => $key,
            "amount"            => $validated['amount'],
            "name"              => setting('site.title'),
            "description"       => 'Your one Stop Shop',
            "prefill"           => [
                "name"          => $request->user()->name,
                "contact"       => $request->user()->phone,
            ],
            "order_id"          => $order['id'],
            "display_currency"  => 'INR',
            "display_amount"    => $validated['amount'],
            "theme"             => [
                "image_padding" => false,
            ],
        ];

        $json = json_encode($data);

        return view('user.wallet.pay')->with(['user' => auth()->user(), 'json' => $json, 'amount' => $validated['amount'], 'transaction' => encrypt($transact->sign)]);
    }

    /**
     * Verify the processed Payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payVerify(Request $request, $transaction)
    {
        //
        $key = env('RAZORPAY_KEY');
        $secret = env('RAZORPAY_SECRET');
        $success = true;

        $transaction = decrypt($transaction);
        $transaction = Transaction::whereSign($transaction)->first();

        $order = $transaction->request_id;
        $payment = $request->input('razorpay_payment_id');
        $signature = $request->input('razorpay_signature');

        if (!empty($payment))
        {
            $api = new Api($key, $secret);

            try
            {

                $attributes = array(
                    'razorpay_order_id' => $order,
                    'razorpay_payment_id' => $payment,
                    'razorpay_signature' => $signature
                );
                $verification = $api->utility->verifyPaymentSignature($attributes);
                Log::debug('Razorpay Signature Verification Returns '.json_encode($verification));

            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Payment Error : ' . $e->getMessage();
            }
        }

        if ($success)
        {
            $transaction->payment_id = $payment;
            $transaction->note = "Added Money to Wallet.";
            $transaction->status = 'success';
            $transaction->save();

            $message = 'YuHoo! Your Payment was Successful!';
        }
        else
        {
            $transaction->payment_id = $payment;
            $transaction->note = "Failed! ".$error;
            $transaction->status = 'failed';
            $transaction->save();

            $message = 'Oops! Payment seems to have failed somehow! '.$error.'.';
        }

        return redirect()->route('user.wallet')->with(['success'=>$success, 'message'=>$message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
