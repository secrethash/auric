<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\Pay;
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
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        // dd($transactions);
        return view('user.wallet.index')->with(['user' => $user, 'transactions' => $transactions]);
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
        $year = now()->format('Y');
        $validated = $request->validate([
            "amount" => ["numeric", "min:100", "required"],
            // "card-number" => ["numeric", "digits:16", "required"],
            // "card-holder" => ["required"],
            // "card-exp-mm" => ["numeric", "digits_between:1,12", "required"],
            // "card-exp-yy" => ["numeric", "min:".$year, "required"],
            // "card-cvv" => ["numeric", "digits:3", "required"],
        ]);

        $gateway = config('payment.gateway');
        $key = config('payment.'.$gateway.'.key');
        $secret = config('payment.'.$gateway.'.secret');

        $payment = new Pay($gateway, $key, $secret);

        $amount = $validated['amount'];
        $currency = 'INR';
        // $card = [
        //     "number" => $validated['card-number'],
        //     "holder" => $validated['card-holder'],
        //     "expiryMonth" => $validated['card-exp-mm'],
        //     "expiryYear" => $validated['card-exp-yy'],
        //     "cvv" => $validated['card-cvv'],
        // ];

        $pay = $payment->initialize($amount, $currency, $request);
        Log::debug('OrderID: '.$pay['order_id']);
        // Record Transaction
        $orderType = Order::whereType('wallet-plus')->first();
        $user = $request->user();
        $data = [
            "note" => "Adding Money to Wallet.",
            "amount" => $amount,
            "request_id" => $pay['order_id'],
            "payment_id" => NULL,
        ];
        $transact = Transact::create($data, $user, $orderType);

        $json = json_encode($pay);

        return view('user.wallet.pay')->with(['user' => auth()->user(), 'json' => $json, 'amount' => $amount, 'transaction' => encrypt($transact->sign), 'payment' => $pay]);
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
        $gateway = config('payment.gateway');
        $key = config('payment.'.$gateway.'.key');
        $secret = config('payment.'.$gateway.'.secret');

        $user = $request->user();

        $transaction = decrypt($transaction);
        $transaction = Transaction::whereSign($transaction)->first();

        $pay = new Pay($gateway, $key, $secret);
        $success = $pay->capture($transaction->request_id, $request);

        if ($success)
        {
            $transaction->payment_id = $pay->paymentId;
            $transaction->note = "Added Money to Wallet.";
            $transaction->status = 'success';
            $transaction->save();

            $user->credits += $transaction->amount;
            $user->save();

            $message = 'YuHoo! Your Payment was Successful!';
        }
        else
        {
            $transaction->payment_id = $pay->paymentId;
            $transaction->note = "Failed! " . $pay->error;
            $transaction->status = 'failed';
            $transaction->save();

            $message = 'Oops! Payment seems to have failed somehow! '.$pay->error.'.';
        }

        return redirect()->route('user.wallet.index')->with(['success'=>$success, 'message'=>$message]);
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
