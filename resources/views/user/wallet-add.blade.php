@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.wallet')])
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
                        <p>Add Money to your Wallet. Your wallet will be creadited with the specified amount after a successful transaction.</p>
                        <form action="payment-success.html" method="POST">
                            <label for="amount">Amount to Add</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-dark text-white" id="basic-addon1">&nbsp;&#8377;&nbsp;</span>
                                </div>
                                <input class="form-control" type="text" id="amount" placeholder="Amount to add" value="1000"><small class="ml-1"><i class="fa fa-lock mr-1"></i>Your payment is processed under Maximum Security.<a class="ml-1" href="#">Learn More</a></small>
                            </div>
                            <button class="btn btn-warning btn-lg w-100" type="submit">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
