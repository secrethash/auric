@extends('layouts.auth')

@section('content')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            We have sent you the Reset Link!
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group text-left mb-4"><span>{{__('Phone Number')}}</span>
                            <label for="phone"><i class="lni-phone-handset"></i></label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="9876543210" required autocomplete="phone" style="letter-spacing: 2px;" autofocus>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning btn-lg w-100">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>
@endsection
