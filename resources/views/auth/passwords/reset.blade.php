@extends('layouts.auth')

@section('content')

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group text-left mb-4"><span>{{__('Phone Number')}}</span>
                            <label for="phone"><i class="lni-phone-handset"></i></label>
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $phone ?? old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-left mb-4"><span>{{__('New Password')}}</span>
                            <label for="password"><i class="lni-protection"></i></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-left mb-4"><span>{{__('Confirm New Password')}}</span>

                            <label for="password-confirm"><i class="lni-protection"></i></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100">
                            {{ __('Update Password') }}
                        </button>
                    </form>
@endsection
