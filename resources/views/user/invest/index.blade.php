@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Invest
    @endcomponent
@endsection

@section('style')
    <link rel="stylesheet" href="css/jquery.countdown.css">
@endsection

@section('content')

    <!-- Live Chat Intro-->
    <div class="live-chat-intro">
        <p>Available Balance</p>
        <h1 class="text-white">&#8377;{{$user->credits}}</h1>
        <div>
            <button href="#addmoney" class="btn btn-light text-dark"><i class="lni-plus"></i>&nbsp;Add Money</button>
            <button href="#rules" class="btn btn-dark"><i class="lni-agenda"></i>&nbsp;Rules</button>
        </div>
        <div class="clearfix mt-2 mb-0 pb-0 text-white">
            <span class="font-weight-bolder">ID:</span>&nbsp;<span>{{$user->username}}</span>
        </div>
    </div>

    <div class="container mt-1 clearfix">
        <a href="{{route('invest.index', $current->slug)}}" class="btn btn-link text-danger float-right mt-0"><i class="lni-reload"></i>&nbsp;Refresh Lobby</a>
    </div>

    <div class="container mt-2">
        <div class="checkout-wrapper-area py-3">
            <ul class="nav nav-pills nav-fill nav-justified">
                @foreach ($lobbies as $lobby)
                    <li class="nav-item">
                        <a class="nav-link @if($current->slug===$lobby->slug){{e('active bg-success')}}@endif" href="{{route('invest.index', $lobby->slug)}}">{{$lobby->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
            <div class="row mt-3">
                <div class="col-6 text-left">
                    <span class="text-muted">Period</span>
                    <h4 style="color: #333;">{{$period->uid}}</h4>
                </div>
                <div class="col-6 text-right">
                    <span class="text-muted">Coutdown</span>
                    <h4 style="color: #333;"><div id="period-countdown"></div></h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')

    <script src="{{asset("js/jquery.countdown.min.js")}}"></script>
    <script type="text/javascript">
        var countTime = "{{Carbon\Carbon::create($period->start)->addMinutes(3)->format('Y/m/d H:i:s')}}";
        $('div#period-countdown')
        .countdown(countTime, function(event) {
            $(this).text(
                event.strftime('%M:%S')
            );
        })
        .on('finish.countdown', function(){
            location.reload(true);
        });
    </script>
@endsection
