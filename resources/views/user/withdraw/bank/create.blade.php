@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.withdraw.bank.index')])
        Add Bank Details
    @endcomponent
@endsection

@section('content')

    @if (!$type)
        @include('partials.user.bank.list', ['method'=>$method])
    @else
        @include('partials.user.bank.single', ['method' => $method])
    @endif
@endsection
