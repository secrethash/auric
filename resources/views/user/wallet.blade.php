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
                            <div class="col-6 mb-2">
                                <span class="text-muted"><strong>ID:</strong> {{$trans->sign}}</span>
                            </div>
                            <div class="col-6 mb-2">
                                <span class="text-muted float-right">{{$trans->created_at->toFormattedDateString()}}</span>
                            </div>
                            <div class="col-8">
                                <span class="font-weight-bold">{{$trans->order->description}} ({{$trans->order->name}})</span>
                            </div>
                            <div class="col-4">
                                @if($trans->order->method === 'plus')
                                    <span class="text-success float-right"><i class="lni-plus"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @else
                                    <span class="text-danger float-right"><i class="lni-minus"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @endif
                            </div>
                            @if($trans->note)
                            <div class="col-12 mt-3">
                                <p class="text-muted"><strong class="text-primary">Note:</strong> {{$trans->note}}</p>
                            </div>
                            @endif
                        </div>
                    </li>

                @endforeach

            </ul>
        </div>
    </div>

@endsection
