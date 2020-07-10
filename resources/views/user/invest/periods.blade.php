@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('invest.index', $lobby->slug)])
        All {{$lobby->name}} Periods
    @endcomponent
@endsection

@section('style')
    <style>
        .text-violet {
            color: #FF26D3;
        }
    </style>
@endsection

@section('content')
<div class="container mt-2">
    <div class="checkout-wrapper-area py-3">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center">{{$lobby->name}} Periods</h4>
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
                @foreach ($periods as $period)
                    @php
                        $color = App\Color::find($period->color_id);
                        $number = App\Number::find($period->number_id);
                    @endphp
                    <tr>
                        <th class="font-weight-normal">{{Str::of($period->uid)->trim($lobby->slug.'-')}}</th>
                        <td class="font-weight-normal">&#8377;&nbsp;{{$period->price}}{{$number->number}}</td>
                        <td class="font-weight-normal text-center">{{$number->number}}</td>
                        <td class="font-weight-normal text-center">
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
        <div class="row clearfix mt-2 mb-3">
            <div class="col-12 mx-auto px-auto">
                {{$periods->onEachSide(0)->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
