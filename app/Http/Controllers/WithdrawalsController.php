<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\ {
    Bank,
    BankType,
    Order,
    User,
    Withdrawal
};
use App\Services\Calculate;
use App\Services\Transact;

class WithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();

        $withdrawals = $user->withdrawal()->latest()->paginate(10);

        return view('user.withdraw.index')->with([
            'user' => $user,
            'withdrawals' => $withdrawals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $limit = $user->credits;
        $maxAmount = ($limit < 50000) ? $limit : 50000;

        return view('user.withdraw.create')->with(['user' => $user, 'amountLimit' => $maxAmount]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $fee = Calculate::withdrawFees($request->amount);
        $limit = intval($request->user()->credits);
        $maxAmount = ($limit < 50000) ? $limit : 50000;

        $rules = [
            "bank" => ['numeric', 'exists:banks,id', 'required'],
            "amount" => ['required', 'numeric', 'max:'.$maxAmount],
            "note" => ['max:255', 'string', 'nullable'],
        ];

        $messages = [
            "bank.required" => "Bank Details are Required!",
            "bank.exits" => "Bank Details should have been created first!",
            "bank.numeric" => "Select Bank Details from the list",
            "amount.required" => "Amount is Required!",
            "amount.max" => "The Amount is Over the Limit, try lowering the value.",
        ];

        $validated = $request->validate($rules, $messages);

        $bank = $validated['bank'];
        $bank = Bank::findOrFail($bank);
        $fee = Calculate::withdrawFees($validated['amount']);

        $withdrawal = new Withdrawal;
        $withdrawal->amount = $validated['amount'] - $fee;
        $withdrawal->fee = $fee;
        $withdrawal->note = $validated['note'] ?? NULL;
        $withdrawal->bank()->associate($bank);
        $withdrawal->user()->associate($request->user());
        $withdrawal->save();

        $withdrawal->textToVerify();

        return redirect()->route('user.withdraw.verify', encrypt($withdrawal->id));
    }

    /**
     * Shows the verification form
     *
     * @return view()
     */
    public function verifyShow($token, Request $request)
    {
        $id = decrypt($token);
        $withdrawal = Withdrawal::findOrFail($id);
        return $withdrawal->hasVerifiedPhone()
                        ? redirect()->route('user.withdraw.index')
                        : view('user.withdraw.verify')->with(['withdrawal' => $withdrawal, 'user' => $request->user()]);
    }

    /**
     * Verifies Phone Number
     *
     * @return mixed
     */
    public function verify($token, Request $request)
    {
        $id = decrypt($token);
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->verification_code !== $request->code)
        {
            throw ValidationException::withMessages([
                'code' => ['The Code/OTP you provided is wrong. Please try again or request another Code/OTP.']
            ]);
        }

        if ($withdrawal->hasVerifiedPhone())
        {
            return redirect()->route('user.withdraw.index');
        }

        $withdrawal->markPhoneAsVerified();

        $amount = $withdrawal->amount + $withdrawal->fee;
        $data = [
            "amount" => $amount,
            "note" => "Withdraw Requested",
            "status" => "success",
            "payment_id" => NULL,
            "request_id" => "withdraw_".$withdrawal->id,
        ];
        $order = Order::whereType('withdraw-hold')->first();

        $transaction = Transact::create($data, $request->user(), $order);
        $wallet = Transact::wallet($order->method, $amount, $request->user());

        return redirect()->route('user.withdraw.index')->with('status', 'Verification Completed! Request is now Processing!');
    }

    /**
     * Resends OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend($token)
    {
        $token = decrypt($token);

        $withdrawal = Withdrawal::find($token);
        $limit = $withdrawal->code_sent_at->addSeconds(60);
        $now = now();


        if ($withdrawal->hasVerifiedPhone())
        {
            return response()->json([
                'redirect' => route('user.withdraw.index'),
            ]);
        }

        if ($now->greaterThanOrEqualTo($limit))
        {
            $withdrawal->textToVerify();
        }

        // $user->withdrawal()->textToVerify();

        return response()->json([
            'success' => true,
            'time' => now()->addSeconds(61)->format('Y/m/d H:i:s'),
            'message' => 'A Code has been resent!',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bank()
    {
        //
        $user = Auth::user();
        $banks = $user->bank()->paginate(10);

        return view('user.withdraw.bank.index')->with(['banks' => $banks, 'user' => $user]);
    }

    /**
     * Show the bank types.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankCreate($type = NULL)
    {
        //
        $user = auth()->user();
        if(!$type) {
            $method = BankType::all();
        }
        else
        {
            $method = BankType::whereSlug($type)->first();
        }

        if (!$method)
        {
            return abort(404);
        }

        return view('user.withdraw.bank.create')->with(['user' => $user, 'method' => $method, 'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bankStore($type, Request $request)
    {
        //
        $rules = [
            "account_number" => ['numeric', 'required_without:account_address'],
            "ifsc_code" => ['required_with:account_number', 'alpha_num'],
            "account_holder" => ['required_with:account_number', 'string'],
            "account_address" => ['required_without:account_number'],
        ];

        $messages = [
            "account_address.required_without" => "Account Address is Required!",
            "account_number.required_without" => "Account Number is Required!",
            "account_holder.required_with" => "Account Number is Required!",
            "ifsc_code.required_with" => "Bank IFSC Code is Required!",
        ];

        $validated = $request->validate($rules, $messages);

        $type = decrypt($type);
        $type = BankType::findOrFail($type);

        $bank = new Bank;
        $bank->short_name = $type->name;
        $bank->account_number = $validated['account_number'] ?? NULL;
        $bank->holder_name = $validated['account_holder'] ?? NULL;
        $bank->ifsc = $validated['ifsc_code'] ?? NULL;
        $bank->payment_address = $validated['account_address'] ?? NULL;
        $bank->type()->associate($type);
        $bank->user()->associate($request->user());
        $bank->save();

        return redirect()->route('user.withdraw.bank.index');

    }

    /**
     * Show the bank types.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankDestroy($id)
    {
        //
        $id = decrypt($id);
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
