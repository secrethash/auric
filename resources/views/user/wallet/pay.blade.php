@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.wallet.index')])
        Wallet
    @endcomponent
@endsection

@section('style')
    <style>
        #card-error {
            color: rgb(105, 115, 134);
            text-align: left;
            font-size: 13px;
            line-height: 17px;
            margin-top: 12px;
        }
        #card-element {
            border-radius: 4px 4px 0 0 ;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            width: 100%;
            background: white;
        }
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="{{asset("images/bg-img/12.png")}}" alt="">
                <div class="pay-credit-card-form">
                    <p class="result-message hidden">
                        <strong>Payment Succeeded! Don't click anywhere, you are being redirected.</strong><br/>The transaction is being verified and Saved!
                    </p>
                    {{-- <p>Add Money to your Wallet. Your wallet will be creadited with the specified amount after a successful transaction.</p> --}}
                    {{-- <i class="lni-reload lni-is-spinning lni-lg text-center"></i> --}}
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Amount <span class="font-weight-bold">&#8377;{{$amount}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">Payment Method<span class="font-weight-normal">{{Str::ucfirst(config('payment.gateway'))}}</span></li>
                    </ul>
                    {{-- <form name='razorpayform' action="{{route('user.wallet.pay.verify', $transaction)}}" method="post">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_signature"  id="razorpay_signature">
                        <input type="hidden" name="transaction_handler" id="transaction_handler" value="{{$transaction}}">
                    </form> --}}
                    {{-- <button id="pay-button" class="btn btn-warning w-100 btn-lg">Continue</button> --}}
                    <form id="payment-form">

                        <p id="card-error" class="text-danger font-weight-bolder" role="alert"></p>
                        <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                        <input type="hidden" name="transaction_handler" id="transaction_handler" value="{{$transaction}}">

                        <button id="submit" class="btn btn-warning w-100 btn-lg mt-4">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">Pay</span>
                        </button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')
    {{-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> --}}
    <script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">
        {{--
        // Checkout details as a json
        // var options = {!! $json !!}

        /**
        * The entire list of Checkout fields is available at
        * https://docs.razorpay.com/docs/checkout-form#checkout-fields
        */

        // options.handler = function (response){
        //     document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        //     document.getElementById('razorpay_signature').value = response.razorpay_signature;
        //     document.razorpayform.submit();
        // };

        // Boolean whether to show image inside a white frame. (default: true)
        // options.theme.image_padding = true;

        // options.modal = {
        //     ondismiss: function() {
        //         console.log("This code runs when the popup is closed");
        //     },
        //     // Boolean indicating whether pressing escape key
        //     // should close the checkout form. (default: true)
        //     escape: true,
        //     // Boolean indicating whether clicking translucent blank
        //     // space outside checkout form should close the form. (default: false)
        //     backdropclose: false
        // };

        // var rzp = new Razorpay(options);

        // document.getElementById('pay-button').onclick = function(e){
        //     rzp.open();
        //     e.preventDefault();
        // };
        // $(document).ready(function(event) {
        //     rzp.open();
        //     event.preventDefault();
        // });
        --}}

        var stripe = Stripe('{{config("payment.stripe.key")}}');

        // Disable the button until we have Stripe set up on the page
        document.querySelector("button").disabled = true;

        var elements = stripe.elements();

        var style = {
        base: {
            color: "#32325d",
            fontFamily: 'Arial, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
            color: "#32325d"
            }
        },
        invalid: {
            fontFamily: 'Arial, sans-serif',
            color: "#fa755a",
            iconColor: "#fa755a"
        }
        };

        var card = elements.create("card", { style: style });
        // Stripe injects an iframe into the DOM
        card.mount("#card-element");

        card.on("change", function (event) {
            // Disable the Pay button if there are no card details in the Element
            document.querySelector("button").disabled = event.empty;
            document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        });

        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            // Complete payment when the submit button is clicked
            payWithCard(stripe, card, '{{$payment['client_secret']}}');
        });

        // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
            loading(true);
            stripe
                .confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card
                    }
                })
                .then(function(result) {
                    if (result.error) {
                        // Show error to your customer
                        showError(result.error.message);
                    } else {
                        // The payment succeeded!
                        var transaction = '{{$transaction}}';
                        orderComplete(result.paymentIntent.id, transaction);
                    }
                });
        };

        /* ------- UI helpers ------- */

        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId, transactionHandler) {
            loading(false);
            // document
            //     .querySelector(".result-message a")
            //     .setAttribute(
            //         "href",
            //         "https://dashboard.stripe.com/test/payments/" + paymentIntentId
            //     );
            document.querySelector(".result-message").classList.remove("hidden");
            document.querySelector("button").disabled = true;
            setTimeout(function () {
                window.location.href = "{{route('user.wallet.pay.verify.get', $transaction)}}";
            }, 2000);

        };

        // Show the customer the error from Stripe if their card fails to charge
        var showError = function(errorMsgText) {
            loading(false);
            var errorMsg = document.querySelector("#card-error");
            errorMsg.textContent = errorMsgText;
            setTimeout(function() {
                errorMsg.textContent = "";
            }, 14000);
        };

        // Show a spinner on payment submission
        var loading = function(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("button").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("button").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        };

    </script>
    {{-- <script src="{{asset('js/stripe-client.js')}}" type="text/javascript"></script> --}}
@endsection


