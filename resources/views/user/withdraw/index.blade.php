@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Withdrawals
    @endcomponent
@endsection

@section('content')
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

        <div class="row py-3">
            <div class="col-8">
                <h3>Created Requests</h3>
            </div>
            <div class="col-4">
                <a href="{{route('user.withdraw.create')}}" class="btn btn-link text-danger mt-0 pt-2 btn-lg float-right"><i class="lni-plus"></i> Add New</a>
            </div>
        </div>
        <ul class="list-group mb-3">
            @foreach($withdrawals as $withdrawal)

                <li class="list-group-item justify-content-between align-items-center @if(!$withdrawal->hasVerifiedPhone()) border-danger @endif">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <strong class="text-muted">Status:</strong>&nbsp;
                            @if($withdrawal->hasVerifiedPhone())
                                <span
                                    class="@if($withdrawal->status==='accepted'){{e('text-success')}}@elseif($withdrawal->status==='rejected'){{e('text-danger')}}@else{{e('text-info')}}@endif"
                                >
                                    <i
                                        class="@if($withdrawal->status==='processing'){{e('lni-spinner-arrow lni-spin-effect')}}@elseif($withdrawal->status==='rejected'){{e('lni-cross-circle')}}@endif"
                                    ></i>&nbsp;
                                    {{Str::ucfirst($withdrawal->status)}}
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="lni-close"></i>&nbsp;Not Verified
                                </span>
                            @endif
                        </div>
                        <div class="col-6 mb-2">
                            <span class="text-muted float-right">{{$withdrawal->created_at->toFormattedDateString()}}</span>
                        </div>
                        <div class="col-8">
                            <span class="font-weight-bold">Transfer To:</span>
                        </div>
                        <div class="col-4">
                            <span class="text-info float-right font-weight-bold">{{$withdrawal->bank->short_name}}</span>
                        </div>

                        <div class="col-12">
                            <hr>

                            <div class="row">
                                <div class="col-6 text-center">
                                    <h6>Amount</h6>
                                    <span class="text-info font-weight-bold">&nbsp;&#8377;{{$withdrawal->amount - $withdrawal->fee}}</span>
                                </div>
                                <div class="col-6 text-center">
                                    <h6>Fee</h6>
                                    <span class="text-danger font-weight-bold">&nbsp;&#8377;{{$withdrawal->fee}}</span>
                                </div>
                            </div>

                            <hr>
                        </div>

                        @if($withdrawal->note)
                        <div class="col-12 mt-3">
                            <p class="text-muted"><strong class="text-primary">Note:</strong> {{$withdrawal->note}}</p>
                        </div>
                        @endif
                        <div class="col-6 mt-3">
                            <p class="text-muted">
                                <span class="text-muted"><strong>Request Verification:</strong> @if($withdrawal->hasVerifiedPhone()) <span class="text-success"><i class="lni-check-mark-circle"></i></span> @else <span class="text-danger"><i class="lni-cross-circle"></i></span> @endif</span>
                            </p>
                        </div>
                        @if(!$withdrawal->hasVerifiedPhone())
                        <div class="col-6 mt-3">
                            <a href="{{route('user.withdraw.verify', encrypt($withdrawal->id))}}" class="btn btn-primary btn-sm float-right">Verify Request</a>
                        </div>
                        @endif
                    </div>
                </li>

            @endforeach

        </ul>
        <div class="d-flex justify-content-between align-items-center">{{ $withdrawals->links() }}</div>
    </div>
</div>
@endsection
