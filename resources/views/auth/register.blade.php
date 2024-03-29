@extends('layouts.auth')

@section('content')

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="form-group text-left mb-4"><span>{{ __('Full Name') }}</span>
        <label for="name"><i class="lni-user"></i></label>
        <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="John Doe" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group text-left mb-4"><span>{{__('Phone Number')}}</span>
        <label for="phone">+91</label>
        <input class="ml-2 form-control @error('phone') is-invalid @enderror" id="phone" type="tel" placeholder="EX: 9866556252" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group text-left mb-4"><span>{{__('Password')}}</span>
        <label for="password"><i class="lni-lock"></i></label>
        <input class="input-psswd form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password" placeholder="********************">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group text-left mb-4"><span>{{__('Confirm Password')}}</span>
        <label for="password-confirm"><i class="lni-protection"></i></label>
        <input class="input-psswd form-control @error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="********************">

        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group text-left mb-4"><span>{{__('Referral Code')}}</span>
        <label for="refer"><i class="lni-crown"></i></label>
        <input class="form-control @error('referral') is-invalid @enderror" id="refer" name="referral" type="text" value="{{old('referral', Session::get('referrer'))}}" placeholder="jane_doe" required>

        @error('referral')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button class="btn btn-success btn-lg w-100">{{__('Register Now')}}</button>
</form>

@endsection

@section('auth-meta')

    <p class="text-white mt-3 mb-0">Already have an account?<a class="ml-2" href="{{route('login')}}">Login</a></p>

@endsection

