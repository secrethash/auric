@extends('layouts.auth')

@section('content')
    <form action="{{route('auth.phone.verify')}}" method="post">
        @csrf
        <div class="form-group text-left mb-4"><span>{{__('Phone Number')}}</span>
            <label for="phone"><i class="lni-phone-handset"></i></label>
            <input class="form-control" id="phone" type="text" value="{{$user->phone}}" readonly>
        </div>
        <div class="form-group text-left mb-4"><span>{{__('One Time Password / Code')}}</span>
            <label for="otp"><i class="lni-more-alt"></i></label>
            <input class="form-control @error('code') is-invalid @enderror" id="otp" name="code" type="number" placeholder="090867">

            @error('code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <span class="invalid-feedback d-none" role="alert">
                <strong id="failed-message"></strong>
            </span>
        </div>
        <button class="btn btn-warning btn-lg w-100">Verify</button>
    </form>
@endsection

@section('auth-meta')
    <p class="text-white mb-0 mt-5">
        Didn't Recived the code?<br/>
        <div id="count" class="text-white mb-0"></div>
        <button id="resend-code" onclick="resend();" class="btn btn-link btn-disabled text-white text-center font-weight-bolder">Resend Code</button>
    </p>
@endsection

@section('after-scripts')
    <script src="{{asset("js/jquery.countdown.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            function count(count) {
                $('div#count')
                .countdown(countTime, function(event) {
                    $(this).text(
                        event.strftime('%M:%S')
                    );
                })
                .on('finish.countdown', function(){
                    $("#resend-code").show();
                });
            }

            var countTime = "{{$user->code_sent_at->addSeconds(60)->format('Y/m/d H:i:s')}}";
            count(countTime);
        });
    </script>
    <script type="text/javascript">
        function resend() {
            $.ajax({
                url: "{{route('auth.phone.verify.resend', encrypt($user->id))}}",
                type: "GET",
                success: function (data) {
                    console.log(data);

                    if(data.errors) {
                        // do nothing
                    }
                    if (data.success) {
                        //
                        count(data.time);
                        $("#resend-code").hide();
                    }
                },
            });
        }
    </script>
@endsection