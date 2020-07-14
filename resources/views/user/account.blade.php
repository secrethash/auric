@extends('layouts.main')

@section('header')
    @include('partials.header.logo')
@endsection

@section('content')
    <div class="container">
        <!-- Settings Wrapper-->
        <div class="settings-wrapper py-3">
            {{-- <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-night"></i><span>Night Mode</span></div>
                        <div class="data-content">
                            <div class="toggle-button-cover">
                                <div class="button r">
                                    <input class="checkbox" id="darkSwitch" type="checkbox">
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-star"></i><span>My Offers</span></div>
                        <div class="data-content"><a href="{{route('page', 'my-offers')}}" class="stretched-link">View<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-crown"></i><span>My Bonus</span></div>
                        <div class="data-content"><a href="{{route('user.referral')}}" class="stretched-link">Referral<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-wallet"></i><span>My Wallet</span></div>
                        <div class="data-content"><a href="{{route('user.wallet.index')}}" class="stretched-link">&#8377;{{$user->credits}}<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-restaurant"></i><span>Bank Details</span></div>
                        <div class="data-content"><a href="{{route('user.withdraw.bank.index')}}" class="stretched-link">Edit <i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            {{-- <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-lock"></i><span>Profile Settings</span></div>
                        <div class="data-content"><a href="change-password.html">Edit<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div> --}}
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>Privacy</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="{{route('page', 'privacy-policy')}}"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>Risk & Disclosure</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="{{route('page', 'risk-disclosure')}}"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>About Us</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="{{route('page', 'about-us')}}"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-question-circle"></i><span>Support & Complaints</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="{{route('page', 'support')}}"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-power-switch"></i><span>Signout</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="{{route('user.logout')}}"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
