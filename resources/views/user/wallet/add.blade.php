@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.wallet.index')])
        Add Money
    @endcomponent
@endsection

@section('style')
    <style>
        .pay-credit-card-form .input-group-append {
            height: 44px;
            padding-top: 5px;
            padding-bottom: 5px;
            box-shadow: 0 3px 8px rgba(15, 15, 15, 0.1) !important;
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
                        <p>Add Money to your Wallet (minimum: &#8377;100). Your wallet will be credited with the specified amount after a successful transaction.</p>
                        <form action="{{route('user.wallet.pay')}}" method="POST">
                            @csrf
                            <label for="amount">Amount to Add</label>
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-white" id="basic-addon1">&nbsp;&#8377;&nbsp;</span>
                                </div>
                                <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" id="amount" placeholder="Amount to add" value="1000">
                            </div>
                            <div class="clearfix mt-0 mb-3">
                                <small class="ml-1"><i class="fa fa-lock mr-1"></i>Your payment is processed under Maximum Security.<a class="ml-1" href="#">Learn More</a></small>
                            </div>
                            @error('amount')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
{{--
                            <div class="form-group">
                                <label for="cardNumber">Credit/Debit Card Number</label>
                                <input class="form-control @error('card-number') is-invalid @enderror" type="text" maxlength="16" id="cardNumber" name="card-number" placeholder="5596 ×××× ×××× ××××" style="letter-spacing: 5px;" value="{{old('card-number')}}" required><small class="ml-1"><i class="fa fa-lock mr-1"></i>Your payment info is stored securely.<a class="ml-1" href="#">Learn More</a></small>

                                @error('card-number')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cardholder">Cardholder Name</label>
                                <input class="form-control @error('card-holder') is-invalid @enderror" type="text" id="cardholder" name="card-holder" placeholder="Rohit Verma" value="{{old('card-holder')}}" style="letter-spacing: 5px;" required>

                                @error('card-holder')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="expiration-mm">Exp. Month</label>
                                                <input class="form-control text-center @error('card-exp-mm') is-invalid @enderror" type="text" name="card-exp-mm" maxlength="2" id="expiration-mm" placeholder="MM" value="{{old('card-exp-mm')}}" style="letter-spacing: 10px;" required>

                                                @error('card-exp-mm')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="expiration-yy">Exp. Year</label>
                                                <input class="form-control text-center @error('card-exp-yy') is-invalid @enderror" type="text" name="card-exp-yy" maxlength="4" id="expiration-yy" placeholder="YYYY" value="{{old('card-exp-yy')}}" style="letter-spacing: 5px;" required>

                                                @error('card-exp-yy')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cvvcode">CVV Code</label>
                                        <input class="form-control text-center @error('card-cvv') is-invalid @enderror" type="password" id="cvvcode" name="card-cvv" maxlength="3" placeholder="×××" value="" style="letter-spacing: 10px;" required>

                                        @error('card-cvv')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            <button class="btn btn-warning btn-lg w-100" type="submit">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

        var stripe = Stripe('{{config("payment.stripe.key")}}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: "#32325d",
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");
    </script> --}}
@endsection
