@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('invest.index', $lobby->slug)])
        My {{$lobby->name}} Records
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
                <h4 class="text-center">My {{$lobby->name}} Records</h4>
            </div>
        </div>

        <ul class="list-group mb-3">
        @foreach ($records as $record)
            @php
                $color = App\Color::find($record->pivot->color_id);
                $number = App\Number::find($record->pivot->number_id);
            @endphp
            <li class="list-group-item justify-content-between align-items-center @if($record->pivot->result){{e('border-success')}}@elseif($record->pivot->result===0){{e('border-danger')}}@else{{e('border-primary')}}@endif">
                <div class="row">
                    <div class="col-6">
                        <span class="text-muted">Period</span>
                        <h6 class="text-dark">{{Str::of($record->uid)->trim($lobby->slug.'-')}}</h6>
                    </div>
                    <div class="col-6 text-right">
                        <span class="text-muted text-right">Created On</span>
                        <h6 class="text-muted text-right">{{$record->pivot->created_at->format('Y-m-d H:i')}}</h6>
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
                        <h6 class="text-right @if($record->pivot->result){{e('text-success')}}@elseif($record->pivot->result===0){{e('text-danger')}}@else{{e('text-primary')}}@endif">@if($record->pivot->result){{e('WIN')}}@elseif($record->pivot->result===0){{e('LOOSE')}}@else{{e('ON-GOING')}}@endif</h6>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-4 text-left">
                        <span class="text-muted text-left">Contract</span>
                        <h6 class="text-dark text-left">&#8377; {{$record->pivot->amount + $record->pivot->fees}}</h6>
                    </div>
                    <div class="col-4 text-center">
                        <span class="text-muted text-center">Fees</span>
                        <h6 class="text-dark text-center">&#8377;{{$record->pivot->fees}}</h6>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-muted text-right">Delivery</span>
                        <h6 class="@if($record->pivot->result){{e('text-success')}}@elseif($record->pivot->result===0){{e('text-danger')}}@else{{e('text-primary')}}@endif text-right">@if($record->pivot->result){!!e('+ ').'&#8377;'.$record->pivot->delivery!!}@elseif($record->pivot->result===0){!!e('- ').'&#8377;'.$record->pivot->amount!!}@else{!!'&mdash;'!!}@endif</h6>
                    </div>
                </div>
            </li>

        @endforeach

        </ul>

        <div class="row clearfix mt-2 mb-3">
            <div class="col-12 mx-auto px-auto">
                {{$records->onEachSide(0)->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
