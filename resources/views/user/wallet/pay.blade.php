@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Wallet
    @endcomponent
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="{{asset("images/bg-img/12.png")}}" alt="">
                <div class="pay-credit-card-form">
                    {{-- <p>Add Money to your Wallet. Your wallet will be creadited with the specified amount after a successful transaction.</p> --}}
                    {{-- <i class="lni-reload lni-is-spinning lni-lg text-center"></i> --}}
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Amount <span class="font-weight-bold">&#8377;{{$amount}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Payment Method<span class="font-weight-normal">Razorpay</span></li>
                    </ul>
                    <form name='razorpayform' action="{{route('user.wallet.pay.verify', $transaction)}}" method="post">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_signature"  id="razorpay_signature">
                        <input type="hidden" name="transaction_handler" id="transaction_handler" value="{{$transaction}}">
                    </form>
                    <button id="pay-button" class="btn btn-warning w-100 btn-lg">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">
        // Checkout details as a json
        var options = {!! $json !!}

        /**
        * The entire list of Checkout fields is available at
        * https://docs.razorpay.com/docs/checkout-form#checkout-fields
        */
        options.handler = function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.razorpayform.submit();
        };

        // Boolean whether to show image inside a white frame. (default: true)
        // options.theme.image_padding = true;

        options.modal = {
            ondismiss: function() {
                console.log("This code runs when the popup is closed");
            },
            // Boolean indicating whether pressing escape key
            // should close the checkout form. (default: true)
            escape: true,
            // Boolean indicating whether clicking translucent blank
            // space outside checkout form should close the form. (default: false)
            backdropclose: false
        };

        var rzp = new Razorpay(options);

        document.getElementById('pay-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        };
        $(document).ready(function(event) {
            rzp.open();
            event.preventDefault();
        });
    </script>
@endsection
