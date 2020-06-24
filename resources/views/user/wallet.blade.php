@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Wallet
    @endcomponent
@endsection

@section('content')

    <!-- Live Chat Intro-->
    <div class="live-chat-intro mb-3">
        <p>Your Balance</p>
        <h1 class="text-white">&#8377;{{$user->credits}}</h1>
        <div class=""><button href="#addmoney" class="btn btn-light text-dark"><i class="lni-plus"></i>&nbsp;Add Money</button></div>
        <!-- .status.offline We’ll be back soon // Use this code for "Offline" Status-->
    </div>

    <div class="container">
        <div class="checkout-wrapper-area py-3">
            <h3 class="text-center" style="color: #333;">Transactions</h3>
            <ul class="list-group mb-3">
                @foreach ($user->transactions as $trans)

                    <li class="list-group-item justify-content-between align-items-center">
                        <div class="row">
                            <div class="col-8">
                                <span>{{$trans->order->description}} ({{$trans->order->name}})</span>
                            </div>
                            <div class="col-4">
                                @if($trans->order->method === 'plus')
                                    <span class="text-success float-right"><i class="lni-plus"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @else
                                    <span class="text-danger float-right"><i class="lni-minus"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @endif
                            </div>
                        </div>
                    </li>

                @endforeach

                <li class="list-group-item justify-content-between align-items-center">
                    <div class="row">
                        <div class="col-8">
                            <span>Lobby 3 (Invest)</span>
                        </div>
                        <div class="col-4">
                            <span class="text-danger float-right"><i class="lni-minus"></i>&nbsp;&#8377;100</span>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>

@endsection
