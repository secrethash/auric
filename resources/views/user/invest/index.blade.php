@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Invest
    @endcomponent
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('css/jquery.countdown.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.loading.css')}}">
    <style>
        .text-violet {
            color: #FF26D3;
        }
        .btn-violet {
            color: #fff;
            background-color: #FF26D3;
            border-color: #FF26D3;
        }

        .btn-violet:hover, .btn-violet:focus, .btn-violet.focus {
            color: #fff;
            background-color: #020310;
            border-color: #020310;
        }

        .btn-violet.disabled, .btn-violet:disabled {
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
        <h1 class="text-white">&#8377;<span id="wallet-credits">{{$user->credits}}</span></h1>
        <div>
            <a href="{{route('user.wallet.add')}}" class="btn btn-light text-dark"><i class="lni-plus"></i>&nbsp;Add Money</a>
            <button href="#rules" class="btn btn-dark" data-toggle="modal" data-target="#rules"><i class="lni-agenda"></i>&nbsp;Rules</button>
        </div>
        <div class="clearfix mt-2 mb-0 pb-0 text-white">
            <span class="font-weight-bolder">ID:</span>&nbsp;<span>{{Str::slug($user->name)}}</span>
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
                    <span class="text-muted">Countdown</span>
                    <h4 style="color: #333;"><div id="period-countdown"></div></h4>
                </div>
            </div>
            <div id="investron">
                <div class="row row-cols-3 mt-3 align-items-center">
                    <div class="col">
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Green Color" data-slug="{{encrypt('color-green')}}" data-color="{{encrypt('green')}}" style="font-weight:900; letter-spacing: 1px;">Join Green</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-block btn-violet" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Violet Color" data-slug="{{encrypt('color-violet')}}" data-color="{{encrypt('violet')}}" style="font-weight:900; letter-spacing: 1px;">Join Violet</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Red Color" data-slug="{{encrypt('color-red')}}" data-color="{{encrypt('red')}}" style="font-weight:900; letter-spacing: 1.5px;">Join Red</button>
                    </div>
                </div>
                <div class="row row-cols-5 mt-2">

                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 0" data-slug="{{encrypt('number-0')}}" data-number="{{encrypt('0')}}">0</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 1" data-slug="{{encrypt('number-1')}}" data-number="{{encrypt('1')}}">1</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 2" data-slug="{{encrypt('number-2')}}" data-number="{{encrypt('2')}}">2</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 3" data-slug="{{encrypt('number-3')}}" data-number="{{encrypt('3')}}">3</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 4" data-slug="{{encrypt('number-4')}}" data-number="{{encrypt('4')}}">4</button>
                    </div>

                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 5" data-slug="{{encrypt('number-5')}}" data-number="{{encrypt('5')}}">5</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 6" data-slug="{{encrypt('number-6')}}" data-number="{{encrypt('6')}}">6</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 7" data-slug="{{encrypt('number-7')}}" data-number="{{encrypt('7')}}">7</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 8" data-slug="{{encrypt('number-8')}}" data-number="{{encrypt('8')}}">8</button>
                    </div>
                    <div class="col mt-2">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#investModal" data-label="{{$current->name}} Number 9" data-slug="{{encrypt('number-9')}}" data-number="{{encrypt('9')}}">9</button>
                    </div>

                </div>
            </div>

            <!-- Alerts -->
            <div id="alerts" class="mt-3">
                <div id="a-primary" class="d-none alert alert-primary alert-dismissible fade show" role="alert">
                    <span id="a-content"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="a-success" class="d-none alert alert-success alert-dismissible fade show" role="alert">
                    <span id="a-content"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="a-danger" class="d-none alert alert-danger alert-dismissible fade show" role="alert">
                    <span id="a-content"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="clearfix mt-3 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h5 class="text-left">{{$current->name}} Records</h5>
                    </div>
                    <div class="col-4">
                        <a href="{{route('invest.periods', $current->slug)}}" class="btn text-danger btn-link float-right">More <i class="lni-chevron-right"></i></a>
                    </div>
                </div>

                <table class="table table-hover table-responsive w-100">
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
                            @php
                                $color = App\Color::find($result->color_id);
                                $number = App\Number::find($result->number_id);
                            @endphp
                            <tr>
                                <th class="font-weight-normal">{{Str::of($result->uid)->trim($current->slug.'-')}}</th>
                                <td class="font-weight-normal">&#8377;{{$result->price}}{{$number->number}}</td>
                                <td class="font-weight-normal text-center">{{$number->number}}</td>
                                <td class="font-weight-normal text-left">
                                    <i class="fa fa-circle @if($color->name === 'red'){{e('text-danger')}}@elseif($color->name === 'green'){{e('text-success')}}@else{{e('text-violet')}}@endif"></i>
                                    @if($color->name === 'red' AND $number->number === 0)
                                        <i class="fa fa-circle text-violet"></i>
                                    @elseif($color->name === 'green' AND $number->number === 5)
                                        <i class="fa fa-circle text-violet"></i>
                                    @elseif($color->name === 'violet' AND $number->number === 5)
                                        <i class="fa fa-circle text-violet"></i>
                                    @elseif($color->name === 'violet' AND $number->number === 0)
                                        <i class="fa fa-circle text-violet"></i>
                                    @endif
                                </td>
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
                        <a href="{{route('invest.records', $current->slug)}}" class="btn text-danger btn-link float-right">More <i class="lni-chevron-right"></i></a>
                    </div>
                </div>

				<ul class="list-group mb-3">
                @foreach ($user->periods->where('lobby_id', $current->id)->sortDesc()->take(10) as $result)
                    @php
                        $color = App\Color::find($result->pivot->color_id);
                        $number = App\Number::find($result->pivot->number_id);
                    @endphp
                    <li class="list-group-item justify-content-between align-items-center @if($result->pivot->result && !$result->active){{e('border-success')}}@elseif($result->pivot->result===0 && !$result->active){{e('border-danger')}}@else{{e('border-primary')}}@endif">
                        <div class="row">
                            <div class="col-6">
								<span class="text-muted">Period</span>
                                <h6 class="text-dark">{{Str::of($result->uid)->trim($current->slug.'-')}}</h6>
                            </div>
                            <div class="col-6 text-right">
								<span class="text-muted text-right">Created On</span>
								<h6 class="text-muted text-right">{{$result->pivot->created_at->format('Y-m-d H:i')}}</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4 text-left">
								<span class="text-muted">Number</span>
								<h6 class="text-dark text-left ml-2">{!!$number->number ?? '&mdash;' !!}</h6>
                            </div>
                            <div class="col-4 text-center">
								<span class="text-muted">Color</span>
								<h6 class="text-dark">@if($color)<i class="fa fa-circle @if($color->name === 'violet'){{e('text-violet')}}@elseif($color->name === 'red'){{e('text-danger')}}@elseif($color->name === 'green'){{e('text-success')}}@endif"></i>@else{!!'&mdash;'!!}@endif</h6>
                            </div>
                            <div class="col-4 text-right">
								<span class="text-muted text-right">Result</span>
								<h6 class="text-right @if($result->pivot->result && !$result->active){{e('text-success')}}@elseif($result->pivot->result===0 && !$result->active){{e('text-danger')}}@else{{e('text-primary')}}@endif">@if($result->pivot->result && !$result->active){{e('WIN')}}@elseif($result->pivot->result===0 && !$result->active){{e('LOOSE')}}@else{{e('ON-GOING')}}@endif</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-4 text-left">
								<span class="text-muted text-left">Contract</span>
								<h6 class="text-dark text-left">&#8377; {{$result->pivot->amount + $result->pivot->fees}}</h6>
                            </div>
                            <div class="col-4 text-center">
								<span class="text-muted text-center">Fees</span>
								<h6 class="text-dark text-center">&#8377;{{$result->pivot->fees}}</h6>
                            </div>
                            <div class="col-4 text-right">
								<span class="text-muted text-right">Delivery</span>
								<h6 class="@if($result->pivot->result && !$result->active){{e('text-success')}}@elseif($result->pivot->result===0 && !$result->active){{e('text-danger')}}@else{{e('text-primary')}}@endif text-right">@if($result->pivot->result && !$result->active){!!e('+ ').'&#8377;'.$result->pivot->delivery!!}@elseif($result->pivot->result===0 && !$result->active){!!e('- ').'&#8377;'.$result->pivot->amount!!}@else{!!'&mdash;'!!}@endif</h6>
                            </div>
                        </div>
                    </li>

                @endforeach

            	</ul>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Rules Modal -->
    <div class="modal fade" id="rules" tabindex="-1" role="dialog" aria-labelledby="rulesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rulesModalLabel">Rules of guess:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                        {!! setting('invest.rules') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invest Modal -->
    <div class="modal fade" id="investModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="investModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="investModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="investForm" method="POST">
                        @csrf
                        <div class="d-none" id="slugtoken">
                            <input type="hidden" name="slugtoken" value="">
                        </div>
                        <div class="d-none" id="bet-color">
                            <input type="hidden" name="bet_color" value="">
                        </div>
                        <div class="d-none" id="bet-number">
                            <input type="hidden" name="bet_number" value="">
                        </div>
                        <div class="form-group">
                            <label for="number">Contract Money</label>
                            <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="amount" value="10" id="option1" checked> 10
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="amount" value="100" id="option2"> 100
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="amount" value="1000" id="option3"> 1000
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="amount" value="10000" id="option4"> 10000
                                </label>
                            </div>
                            <span class="text-danger">
                                <strong id="amount-error"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="bets-number">Number of Bets</label>
                            <input id="bets-number" class="form-control" type="number" value="1" name="bets" min="1" max="999">
                            <span class="text-danger">
                                <strong id="bets-error"></strong>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="formInvest();">Proceed</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
    <script src="{{asset("js/jquery.countdown.min.js")}}"></script>
    <script type="text/javascript">
        var countTime = "{{$period->start->addMinutes(3)->addSeconds(2)->format('Y/m/d H:i:s')}}";
        $('div#period-countdown')
        .countdown(countTime, function(event) {
            $(this).text(
                event.strftime('%M:%S')
                );
        })
        .on('finish.countdown', function(){
            location.reload(true);
        })
        .on('update.countdown', function (event) {
            if (event.offset.totalSeconds == 30)
            {
                // console.log('Pre-processor Running!');
                // $.get('{{--route('invest.process', encrypt($id))--}}');
            }
            if (event.offset.totalSeconds <= 30)
            {
                $("#investron").find("button").prop("disabled", true);
                jQuery("#investModal").modal('hide');
            }

        });

        $('#investModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var slug = button.data('slug');
            var label = button.data('label');
            var color = button.data('color');
            var number = button.data('number');

            var modal = $(this);
            modal.find('.modal-title').text('Invest in ' + label);
            modal.find('.modal-body #slugtoken input').val(slug);
            modal.find('.modal-body #bet-color input').val(color);
            modal.find('.modal-body #bet-number input').val(number);
        });

        function hideInvestModal() {
            jQuery("#investModal").modal('hide');
        }
    </script>

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        var noConJq = $.noConflict(true);
    </script>
    <script type="text/javascript" src="{{asset('js/jquery.loading.js')}}"></script>
    <script type="text/javascript">
        function formInvest(){
            console.log('Initiation');
            var registerForm = $("#investForm");
            var formData = registerForm.serialize();
            var wallet = {{$user->credits}};
            $("#investron").loading({
                message: "Working On It...",
                onStart: function(loading) {
                        loading.overlay.slideDown(400);
                },
                onStop: function(loading) {
                    loading.overlay.slideUp(400);
                }
            });
            $("#investron").find("button").prop('disabled', true);
            $("#amount-error").html( "" );
            $("#bets-error").html( "" );

            console.log('Starting Ajax Requests');
            $.ajax({
                url:"{{ route("invest.create", [encrypt($current->id), encrypt($period->uid)]) }}",
                type:"POST",
                data: formData,
                success:function(data) {
                    console.log(data);
                    if(data.errors) {
                        $("#investron").loading("stop");
                        $("#investron").find("button").prop('disabled', false);
                        $("#alerts").find("#a-danger").removeClass("d-none");
                        $("#alerts").find("#a-danger").find("#a-content").html("You have an Error!");
                        // Notification
                        if(data.errors.amount){
                            $("#amount-error").html( data.errors.amount[0] );
                            console.log(data.errors.amount[0]);
                        }
                        if(data.errors.bets){
                            $("#bets-error").html( data.errors.bets[0] );
                        }
                        if(data.errors.time){
                            $("#alerts").find("#a-danger").removeClass("d-none");
                            $("#alerts").find("#a-danger").find("#a-content").html( data.errors.time[0] );
                            jQuery("#a-danger").alert();
                        }

                    }
                    if(data.success) {
                        $("#investron").loading("stop");
                        $("#investron").loading({
                            message: "Data Saved! Click Here.",
                            stoppable: true,
                            onStart: function(loading) {
                                    loading.overlay.slideDown(400);
                            },
                            onStop: function(loading) {
                                loading.overlay.slideUp(400);
                            }
                        }, 2000);
                        $("#wallet-credits").html(data.wallet);
                        $("#investron").find("button").removeProp('disabled', true);
                        $("#alerts").find("#a-success").removeClass("d-none");
                        $("#alerts").find("#a-success").find("#a-content").html("Invested Successfully!");
                        hideInvestModal();
                    }
                },
            });
        }
    </script>
@endsection
