@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Invest
    @endcomponent
@endsection

@section('content')

    <!-- Live Chat Intro-->
    <div class="live-chat-intro">
        <p>Available Balance</p>
        <h1 class="text-white">&#8377;{{$user->credits}}</h1>
        <div>
            <button href="#addmoney" class="btn btn-light text-dark"><i class="lni-plus"></i>&nbsp;Add Money</button>
        {{-- </div>
        <div> --}}
            <button href="#rules" class="btn btn-dark"><i class="lni-agenda"></i>&nbsp;Rules</button>
        </div>
    </div>

    <div class="container mt-1 clearfix">
        <button class="btn btn-link text-danger float-right mt-0"><i class="lni-reload"></i>&nbsp;Refresh Lobby</button>
    </div>

    <div class="container mt-2">
        <div class="checkout-wrapper-area py-3">
            <ul class="nav nav-pills nav-fill nav-justified">
                @foreach ($lobbies as $lobby)
                    <li class="nav-item">
                        <a class="nav-link @if($current->slug===$lobby->slug){{e('active bg-success')}}@endif" href="{{route('invest.index', $lobby->slug)}}">{{$lobby->name}}</a>
                    </li>
                @endforeach
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('invest.index', '')}}">GILT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('invest.index', '')}}">PALE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('invest.index', '')}}">GEM</a>
                </li> --}}
            </ul>

        </div>
    </div>
@endsection
