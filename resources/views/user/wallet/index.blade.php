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
        <div class=""><a href="{{route('user.wallet.add')}}" class="btn btn-light text-dark"><i class="lni-plus"></i>&nbsp;Add Money</a></div>
        <!-- .status.offline We’ll be back soon // Use this code for "Offline" Status-->
    </div>

    <div class="container">
        <div class="checkout-wrapper-area py-3">

            @if(session('success') != NULL)
                <div id="a-success" class="alert @if(session('success')){{e('alert-success')}}@elseif(session('success')===false){{e('alert-danger')}}@endif alert-dismissible fade show mt-3 mb-3" role="alert">
                    <span id="a-content">{{session('message')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h3 class="text-center" style="color: #333;">Transactions</h3>
            <ul class="list-group mb-3">
                @foreach($transactions as $trans)

                    <li class="list-group-item justify-content-between align-items-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <span class="@if($trans->status==='processing'){{e('text-info')}}@else{{e('text-danger')}}@endif"><strong class="text-muted">Status:</strong> <i class="@if($trans->status==='processing'){{e('lni-spinner-arrow lni-spin-effect')}}@elseif($trans->status==='failed'){{e('lni-cross-circle')}}@endif"></i> @if($trans->status === 'processing' || $trans->status === 'failed'){{Str::ucfirst($trans->status)}}@endif</span>
                            </div>
                            <div class="col-6 mb-2">
                                <span class="text-muted float-right">{{$trans->created_at->toFormattedDateString()}}</span>
                            </div>
                            <div class="col-8">
                                <span class="font-weight-bold">{{$trans->order->description}} ({{$trans->order->name}})</span>
                            </div>
                            <div class="col-4">
                                @if($trans->order->method === 'plus')
                                    <span class="@if($trans->status==='success'){{e('text-success')}}@elseif($trans->status==='processing'){{e('text-info')}}@else{{e('text-danger')}}@endif float-right"><i class="@if($trans->status==='success'){{e('lni-plus')}}@elseif($trans->status==='processing'){{e('lni-spinner-arrow lni-spin-effect')}}@else{{e('lni-cross-circle')}}@endif"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @else
                                    <span class="text-danger float-right"><i class="lni-minus"></i>&nbsp;&#8377;{{$trans->amount}}</span>
                                @endif
                            </div>
                            @if($trans->note)
                            <div class="col-12 mt-3">
                                <p class="text-muted"><strong class="text-primary">Note:</strong> {{$trans->note}}</p>
                            </div>
                            @endif
                            <div class="col-12 mt-2">
                                <p class="text-muted">
                                    <span class="text-muted"><strong>ID:</strong> {{$trans->sign}}</span>
                                </p>
                            </div>
                        </div>
                    </li>

                @endforeach

            </ul>
            <div class="d-flex justify-content-between align-items-center">{{ $transactions->links() }}</div>
        </div>
    </div>

@endsection
