@extends('layouts.main')

@section('header')
    @include('partials.header.logo')
@endsection

@section('content')
    <div class="container">
        <!-- Settings Wrapper-->
        <div class="settings-wrapper py-3">
            <div class="card settings-card">
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
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-delivery"></i><span>My Orders</span></div>
                        <div class="data-content"><a href="language.html">View<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-crown"></i><span>My Promotions</span></div>
                        <div class="data-content"><a href="{{route('user.referral')}}">Referral<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-wallet"></i><span>My Wallet</span></div>
                        <div class="data-content"><a href="{{route('user.wallet')}}">&#8377;{{$user->credits}}<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-lock"></i><span>Profile Settings</span></div>
                        <div class="data-content"><a href="change-password.html">Edit<i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>Privacy</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="privacy-policy.html"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>Risk & Disclosure</span></div>
                        <div class="data-content"><a class="pl-4" href="privacy-policy.html"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-protection"></i><span>About Us</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="privacy-policy.html"><i class="lni-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="card settings-card">
                <div class="card-body">
                    <!-- Single Settings-->
                    <div class="single-settings d-flex align-items-center justify-content-between">
                        <div class="title"><i class="lni-question-circle"></i><span>Support & Complaints</span></div>
                        <div class="data-content"><a class="pl-4 stretched-link" href="support.html"><i class="lni-chevron-right"></i></a></div>
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
