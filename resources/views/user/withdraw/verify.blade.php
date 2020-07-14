@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.withdraw.index')])
        Withdrawal Request
    @endcomponent
@endsection

@section('content')

<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area py-3">
        <!-- Credit Card Info-->
        <div class="credit-card-info-wrapper">

            <div class="pay-credit-card-form">

                <form action="{{route('user.withdraw.verify', encrypt($withdrawal->id))}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" class="form-control" value="{{$user->country_code.'-'.$user->phone}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="code">Verify OTP (<span id="count"></span>)</label>
                        <a href="#" onclick="sendotp();" id="otp" class="btn btn-link text-primary float-right">Re-send OTP</a>
                        <input
                            class="form-control text-center @error('code') is-invalid @enderror"
                            type="number"
                            name="code"
                            id="code"
                            placeholder="------"
                            value=""
                            style="letter-spacing: 25px;"
                            autofocus="true"
                        />

                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <button
                        class="btn btn-warning btn-lg w-100"
                        type="submit"
                    >
                    Complete Verification
                </button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('after-scripts')
    <script src="{{asset("js/jquery.countdown.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            function count(countTime) {
                $('span#count')
                .countdown(countTime, function(event) {
                    $(this).text(
                        event.strftime('%M:%S')
                    );
                })
                .on('finish.countdown', function(){
                    $("#otp").show();
                })
                .on('update.countdown', function (event) {
                    if (event.offset.totalSeconds != 0)
                    {
                        $("#otp").hide();
                    }

                });
            }

            var countTime = "{{$withdrawal->code_sent_at->addSeconds(60)->format('Y/m/d H:i:s')}}";
            count(countTime);
        });
    </script>
    <script type="text/javascript">
        function sendotp() {
            $.ajax({
                url: "{{route('user.withdraw.verify.resend', encrypt($withdrawal->id))}}",
                type: "GET",
                success: function (data) {
                    console.log(data);

                    if(data.errors) {
                        // do nothing
                    }
                    if (data.success) {
                        //
                        $('span#count').countdown(data.time);
                        $("#otp").hide();
                    }
                },
            });
        }
    </script>
@endsection

