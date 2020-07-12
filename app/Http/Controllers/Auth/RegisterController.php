<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/auth/phone/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'referral' => ['required', 'string', 'exists:users,username', 'alpha_dash', 'min:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        $username = $this->generateUsername();

        if (!$referrer)
        {
            $referrer = User::whereUsername($data['referral'])->first();
        }

        return User::create([
            'username' => $username,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Triggered after a successful registration
     *
     * @return redirect
     */
    protected function registered(Request $request, User $user)
    {
        $user->textToVerify();
        return redirect($this->redirectPath());
    }

    /**
     * Generates a random username
     *
     * @return string uuid
     */
    protected function generateUsername()
    {
        //
        $generated = Str::random(32);

        $user = User::whereUsername($generated)->first();

        if (!$user)
        {
            return $generated;
        }

        return $this->generateUsername();
    }
}
