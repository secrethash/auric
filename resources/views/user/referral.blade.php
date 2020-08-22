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
            <div class="credit-card-info-wrapper">
                <div class="bank-ac-info">
                    <div class="clearfix m-3">
                        <h5>Bonus Rules</h5>
                        <p><strong>Level 1:</strong> 0.6% per transaction</p>
                        <p><strong>Level 2:</strong> 0.5% per transaction</p>
                        {{-- <p><strong>Level 3:</strong> 0.4% per transaction</p>
                        <p><strong>Level 4:</strong> 0.3% per transaction</p>
                        <p><strong>Level 5:</strong> 0.2% per transaction</p> --}}
                        {{-- <p><strong>Level 6 and below:</strong> flat 0.1% per transaction</p> --}}
                        <blockquote>Commissions can be withdrawn from your account at anytime.</blockquote>
                    </div>

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
                        <li class="list-group-item justify-content-between align-items-center">
                            <div class="row center">
                                <div class="col-12 text-center">
                                    <h5>Total People Referred</h5>
                                </div>
                                <div class="col-12 text-center">
                                    <h5 class="display-4"><span class="badge badge-dark">{{$user->referrals()->count()}}</span></h5>
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
