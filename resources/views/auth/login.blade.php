@extends('layouts.auth')

@section('content')

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group text-left mb-4"><span>{{ __('E-Mail Address') }}</span>
            <label for="email"><i class="lni-user"></i></label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="info@example.com">
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
