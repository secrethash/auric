@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        My Promotions
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="{{asset('images/bg-img/12.png')}}" alt="">
                <div class="bank-ac-info">
                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    <ul class="list-group mb-3">
                        <li class="list-group-item justify-content-between align-items-center">
                            <div class="row center">
                                <div class="col-12 text-center">
                                    <h5>Referral ID</h5>
                                </div>
                                <div class="col-12 center">
                                    <input type="text" id="referral-id" value="{{$user->username}}" class="border-0 form-control form-control-lg text-center" readonly onclick="selectAll()" />
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item justify-content-between align-items-center">
                            <div class="row center">
                                <div class="col-12 text-center">
                                    <h5>Link</h5>
                                </div>
                                <div class="col-12">
                                    <input type="text" id="referral" value="{{$user->referral_link}}" class="border-0 form-control form-control-lg text-center" readonly onclick="copyFunction()" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-warning btn-lg w-100" type="button" onclick="copyFunction()">
                    <i class="lni-share"></i>&nbsp; Copy Referral Link
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function copyFunction() {
            /* Get the text field */
            var copyText = document.getElementById("referral");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied: " + copyText.value;
        }
        function selectAll() {
            var field = document.getElementById('referral-id');
            field.select();
            field.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
        }
    </script>
@endsection
