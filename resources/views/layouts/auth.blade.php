<!DOCTYPE html>
<html lang="en">
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
    </head>
    <body>
        <!-- Preloader-->
        <div class="preloader" id="preloader">
            <div class="spinner-grow text-secondary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
            <!-- Background Shape-->
            <div class="background-shape"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="img/core-img/logo_yellow_icon_small.png" alt="">
                        <h1 class="text-white w-100 center">Auric Shops</h1>
                        <!-- Register Form-->
                        <div class="register-form mt-5 px-4">
                            @yield('content')
                        </div>
                        <!-- Login Meta-->
                        <div class="login-meta-data">
                            @yield('auth-meta')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <script src="{{mix("js/app.js")}}"></script> --}}
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
    </body>
</html>
