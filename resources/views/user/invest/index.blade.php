@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Invest
    @endcomponent
@endsection

@section('style')
    <link rel="stylesheet" href="css/jquery.countdown.css">
    <style>
        .btn-violet {
            color: #fff;
            background-color: #FF26D3;
            border-color: #FF26D3;
        }

        .btn-violet:hover {
            color: #fff;
            background-color: #d841ba;
            border-color: #d841ba;
        }

        .btn-violet:focus, .btn-violet.focus {
            color: #fff;
            background-color: #d841ba;
            border-color: #d841ba;
            box-shadow: 0 0 0 0.2rem rgba(216, 65, 186, 0.5);
        }

        .btn-violet.disabled, .btn-violet:disabled {
            color: #fff;
            background-color: #ff26d3;
            border-color: #ff26d3;
        }

        .btn-violet:not(:disabled):not(.disabled):active, .btn-violet:not(:disabled):not(.disabled).active,
        .show > .btn-violet.dropdown-toggle {
            color: #fff;
            background-color: #d841ba;
            border-color: #d841ba;
        }

        .btn-violet:not(:disabled):not(.disabled):active:focus, .btn-violet:not(:disabled):not(.disabled).active:focus,
        .show > .btn-violet.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(216, 65, 186, 0.5);
        }

    </style>
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
                        <a class="nav-link @if($current->slug===$lobby->slug){{e('active bg-primary')}}@endif" href="{{route('invest.index', $lobby->slug)}}">{{$lobby->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
            <div class="row mt-3">
                <div class="col-6 text-left">
                    <span class="text-muted">Period</span>
                    <h4 style="color: #333;">{{Str::of($period->uid)->trim($current->slug.'-')}}</h4>
                </div>
                <div class="col-6 text-right">
                    <span class="text-muted">Coutdown</span>
                    <h4 style="color: #333;"><div id="period-countdown"></div></h4>
                </div>
            </div>
            <div class="row mt-3 align-items-center">
                <div class="col-4">
                    <button class="btn btn-success">Join Green</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-violet">Join Violet</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-danger">Join Red</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="m-1 mt-2"></div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">0</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">1</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">2</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">3</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">4</button>
                </div>
                <div class="m-1 mt-2"></div>

                <div class="m-1 mt-2"></div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">5</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">6</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">7</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">8</button>
                </div>
                <div class="col-2 m-1 mt-2">
                    <button class="btn btn-primary btn-block">9</button>
                </div>
                <div class="m-1 mt-2"></div>
            </div>
            <div class="clearfix mt-3 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h5 class="text-left">{{$current->name}} Records</h5>
                    </div>
                    <div class="col-4">
                        <a href="#" class="btn text-danger btn-link float-right">More <i class="lni-chevron-right"></i></a>
                    </div>
                </div>

                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted font-weight-normal">Period</th>
                            <th scope="col" class="text-muted font-weight-normal">Price</th>
                            <th scope="col" class="text-muted font-weight-normal">Number</th>
                            <th scope="col" class="text-muted font-weight-normal">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($current->periods->where('active', 0)->sortDesc()->take(10) as $result)

                            <tr>
                                <th class="font-weight-normal">{{Str::of($result->uid)->trim($current->slug.'-')}}</th>
                                <td class="font-weight-normal">{{$result->price}}</td>
                                <td class="font-weight-normal">{{$result->result_number}}</td>
                                <td class="font-weight-normal">{{$result->result_color}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="clearfix mt-3">
                <div class="row">
                    <div class="col-8">
                        <h5 class="text-left">My {{$current->name}} Records</h5>
                    </div>
                    <div class="col-4">
                        <a href="#" class="btn text-danger btn-link float-right">More <i class="lni-chevron-right"></i></a>
                    </div>
                </div>

				<ul class="list-group mb-3">
                @foreach ($user->periods->where('lobby_id', $current->id)->sortDesc()->take(10) as $result)

                    <li class="list-group-item justify-content-between align-items-center {{$result->pivot->result ? 'border-success' : 'border-danger'}}">
                        <div class="row">
                            <div class="col-8">
								<span class="text-muted">Period</span>
                                <h6 class="text-dark">{{Str::of($result->uid)->trim($current->slug.'-')}}</h6>
                            </div>
                            <div class="col-4">
								<span class="text-muted">Invested</span>
								<h6 class="text-dark text-align-center">&#8377;{{$result->pivot->amount}}</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
								<span class="text-muted">Number</span>
								<h6 class="text-dark text-align-center">{{$result->pivot->invest_number ?? '-' }}</h6>
                            </div>
                            <div class="col-4">
								<span class="text-muted">Color</span>
								<h6 class="text-dark text-align-center">{{$result->pivot->invest_color ?? '-' }}</h6>
                            </div>
                            <div class="col-4">
								<span class="text-muted">Result</span>
								<h6 class="text-align-center {{$result->pivot->result ? 'text-success' : 'text-danger'}}">{{$result->pivot->result ? 'WIN' : 'LOOSE' }}</h6>
                            </div>
                        </div>
                    </li>

                @endforeach

            	</ul>

                {{-- <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted font-weight-normal">Period</th>
                            <th scope="col" class="text-muted font-weight-normal">Price</th>
                            <th scope="col" class="text-muted font-weight-normal">Number</th>
                            <th scope="col" class="text-muted font-weight-normal">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->periods->where('lobby_id', $current->id)->sortDesc()->take(10) as $result)

                            <tr>
                                <th class="font-weight-normal">{{Str::of($result->uid)->trim($current->slug.'-')}}</th>
                                <td class="font-weight-normal">{{$result->price}}</td>
                                <td class="font-weight-normal">{{$result->result_number}}</td>
                                <td class="font-weight-normal">{{$result->result_color}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table> --}}

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
