<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
        <!-- Title-->
        <title>{{env('APP_NAME')}}</title>
        <!-- Favicon-->
        <link rel="icon" href="images/core-img/favicon.ico">
        <!-- Stylesheet-->
        <link rel="stylesheet" href="{{asset("style.css")}}">
        {{-- <link rel="stylesheet" href="{{mix("css/app.css")}}"> --}}
        @yield('style')
    </head>
    <body>
        <!-- Preloader-->
        <div class="preloader" id="preloader">
            <div class="spinner-grow text-secondary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <!-- Header Area-->
        <div class="header-area" id="headerArea">
            <div class="container h-100 d-flex align-items-center justify-content-between">
                @yield('header')
                <!-- Navbar Toggler-->
                <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
            </div>
        </div>
        <!-- Sidenav Black Overlay-->
        <div class="sidenav-black-overlay"></div>
        <!-- Side Nav Wrapper-->
        <div class="suha-sidenav-wrapper" id="sidenavWrapper">
            <!-- Sidenav Profile-->
            <div class="sidenav-profile">
                <div class="user-profile"><img src="{{asset("images/bg-img/user.png")}}" alt=""></div>
                <div class="user-info">
                    <h6 class="user-name mb-0">
                        @auth
                            Welcome {{auth()->user()->name}}
                        @endauth
                        @guest
                            Welcome Guest!
                        @endguest
                    </h6>
                    <p class="available-balance">Balance <span>&#8377; @auth<span class="counter">{{auth()->user()->credits}}</span> @else{{e('--')}}@endauth </span></p>
                </div>
            </div>
            <!-- Sidenav Nav-->
            <ul class="sidenav-nav">
                @auth{!! menu('side_nav_auth', 'layouts.menu.side') !!}@endauth
                @guest{!! menu('side_nav', 'layouts.menu.side') !!}@endguest
            </ul>
            <!-- Go Back Button-->
            <div class="go-home-btn" id="goHomeBtn"><i class="lni-arrow-left"></i></div>
        </div>

        <div class="page-content-wrapper">
            @yield('content')
        </div>
        <!-- Footer Nav-->
        <div class="footer-nav-area" id="footerNav">
            <div class="container h-100 px-0">
                <div class="suha-footer-nav h-100">
                    {{-- <ul class="h-100 d-flex align-items-center justify-content-between">
                        <li class="active"><a href="home.html"><i class="lni-home"></i>Home</a></li>
                        <li><a href="message.html"><i class="lni-support"></i>Support</a></li>
                        <li><a href="cart.html"><i class="lni-cart"></i>Cart</a></li>
                        <li><a href="pages.html"><i class="lni-heart"></i>Pages</a></li>
                        <li><a href="settings.html"><i class="lni-cog"></i>Settings</a></li>
                    </ul> --}}
                    @guest{!! menu('foot_nav', 'layouts.menu.foot') !!}@endguest
                    @auth{!! menu('foot_nav_auth', 'layouts.menu.foot') !!}@endauth
                </div>
            </div>
        </div>
        {{-- <script src="{{mix("js/app.js")}}"></script> --}}
        <!-- Custom JS Code -->
        @yield('scripts')

        <!-- All JavaScript Files-->
        <script src="{{asset("js/jquery.min.js")}}"></script>
        <script src="{{asset("js/popper.min.js")}}"></script>
        <script src="{{asset("js/bootstrap.min.js")}}"></script>
        <script src="{{asset("js/waypoints.min.js")}}"></script>
        <script src="{{asset("js/jquery.easing.min.js")}}"></script>
        <script src="{{asset("js/owl.carousel.min.js")}}"></script>
        <script src="{{asset("js/jquery.animatedheadline.min.js")}}"></script>
        <script src="{{asset("js/jquery.counterup.min.js")}}"></script>
        <script src="{{asset("js/wow.min.js")}}"></script>
        <script src="{{asset("js/jarallax.min.js")}}"></script>
        <script src="{{asset("js/jarallax-video.min.js")}}"></script>
        <script src="{{asset("js/default/jquery.passwordstrength.js")}}"></script>
        <script src="{{asset("js/default/dark-mode-switch.js")}}"></script>
        <script src="{{asset("js/default/active.js")}}"></script>

        @yield('after-scripts')
    </body>
</html>
