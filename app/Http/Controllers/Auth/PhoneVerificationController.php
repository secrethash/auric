<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class PhoneVerificationController extends Controller
{
    //

    /**
     * Shows the verification form
     *
     * @return view()
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedPhone()
                        ? redirect()->route('home')
                        : view('auth.verify-phone')->with('user', $request->user());
    }

    /**
     * Verifies Phone Number
     *
     * @return mixed
     */
    public function verify(Request $request)
    {
        if ($request->user()->verification_code !== $request->code)
        {
            throw ValidationException::withMessages([
                'code' => ['The Code/OTP you provided is wrong. Please try again or request another Code/OTP.']
            ]);
        }

        if ($request->user()->hasVerifiedPhone())
        {
            return redirect()->route('home');
        }

        $request->user()->markPhoneAsVerified();

        return redirect()->route('home')->with('status', 'Your phone was successfully Verified!');
    }

    /**
     * Resend Code for Verification
     *
     * @return mixed
     */
    public function resend($token)
    {
        $token = decrypt($token);
        Log::debug('Resend: Token: '.$token);
        $user = User::find($token);
        $now = now();
        $limit = $user->code_sent_at ? $user->code_sent_at->addSeconds(60) : $now->subSeconds(60);

        Log::debug('User: '.$user->name);

        if ($user->hasVerifiedPhone())
        {
            Log::debug('Phone has been Verified!');
            return response()->json([
                'redirect' => route('home'),
            ]);
        }

        if ($now->greaterThanOrEqualTo($limit))
        {
            Log::debug('Time has Exceeded the Limit');
            $user->textToVerify();
        }

        return response()->json([
            'success' => true,
            'time' => now()->addSeconds(61)->format('Y/m/d H:i:s'),
            'message' => 'A Code has been resent!',
        ]);
    }
}
