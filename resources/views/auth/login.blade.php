@extends('layouts.auth')

@section('content')

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group text-left mb-4"><span>{{ __('Phone Number') }}</span>
            <label for="phone"><i class="lni-phone-handset"></i></label>
            <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="number" name="phone" value="{{ old('phone', '+91') }}" required autocomplete="phone" autofocus placeholder="EX: 7000090000">
        </div>
        <div class="form-group text-left mb-4"><span>{{ __('Password') }}</span>
            <label for="password"><i class="lni-lock"></i></label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password" placeholder="***************">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button class="btn btn-success btn-lg w-100" type="submit">{{ __('Login') }}</button>
    </form>

@endsection

@section('auth-meta')

    <a class="forgot-password d-block mt-3 mb-1" href="{{ route('password.request') }}">Forgot Password?</a>
    <p class="text-white mb-0">Didn't have an account?<a class="ml-2" href="{{ route('register') }}">Register</a></p>

@endsection
