@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        {{$page->page_title}}
    @endcomponent
@endsection

@section('content')

    @if(!$page->layout)
        @include('partials.pages.content', ['page'=>$page])
    @else
        @include($page->layout, ['page'=>$page])
    @endif

@endsection
