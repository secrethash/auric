@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.account')])
        Bank Details
    @endcomponent
@endsection

@section('content')

<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area py-3">
        <div class="credit-card-info-wrapper">
            <div class="row py-3">
                <div class="col-8">
                    <h3>My Bank Details</h3>
                </div>
                <div class="col-4">
                    <a href="{{route('user.withdraw.bank.create')}}" class="btn btn-link text-danger mt-0 pt-2 btn-lg float-right"><i class="lni-plus"></i> Add New</a>
                </div>
            </div>
            @foreach ($banks as $bank)
                <div class="bank-ac-info">
                    <div class="row">
                        <div class="col-7">
                            <h6 class="pl-1">{{$bank->short_name}}</h6>
                        </div>
                        <div class="col-5 text-right">
                            <a href="{{route('user.withdraw.bank.destroy', encrypt($bank->id))}}" class="btn btn-link text-danger"><i class="lni-cross-circle"></i> Delete Record</a>
                        </div>
                    </div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">Account Type<span class="font-weight-bolder">{{$bank->type->name}}</span></li>
                        @if(is_null($bank->account_number))
                            <li class="list-group-item d-flex justify-content-between align-items-center">Payment Address<span class="font-weight-bolder">{{$bank->payment_address}}</span></li>
                        @else
                            <li class="list-group-item d-flex justify-content-between align-items-center">Account Holder's Name<span class="font-weight-bolder">{{$bank->holder_name}}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Account Number<span class="font-weight-bolder">{{$bank->account_number}}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Bank IFSC Code<span class="font-weight-bolder">{{$bank->ifsc}}</span></li>
                        @endif
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
