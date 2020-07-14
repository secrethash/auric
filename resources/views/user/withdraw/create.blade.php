@extends('layouts.main')

@section('header')
    @component('partials.header.title', ['back' => route('user.withdraw.index')])
        Withdrawal Request
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <!-- Credit Card Info-->
            <div class="credit-card-info-wrapper">
                <h3 class="text-center">My Balance: <span class="text-danger">&#8377;{{$user->credits}}</span></h3>
                <div class="pay-credit-card-form">
                    <form action="{{route('user.withdraw.create')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="bank">Bank Details</label>
                        	<a href="{{route('user.withdraw.bank.create')}}" id="otp" class="btn btn-link text-primary float-right"><i class="lni-plus"></i> Add New</a>
                            <select name="bank" class="form-control custom-select custom-select-lg" id="bank">
                                    <option>Select Bank Details</option>
                                @foreach ($user->bank as $bank)
                                    <option value="{{$bank->id}}">{{$bank->short_name}}</option>
                                @endforeach
                            </select>

                            @error('bank')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount to Withdraw</label>
                            <input
                                class="form-control @error('amount') is-invalid @enderror"
                                type="number"
                                name="amount"
                                id="amount"
                                placeholder="Ex: 1000"
                                value="{{old('amount')}}"
                                max="{{$amountLimit}}"
                                step="100"
                            />
                            <small class="ml-1">
                                <i class="fa fa-info-circle mr-1"></i>
                                Amount < &#8377;1500, <strong>Fee: &#8377;30</strong> and if Amount > &#8377;1500, <strong>Fee: 2%</strong>
                            </small>
                            <br>
                            <small class="ml-1">
                                <i class="fa fa-question-circle mr-1"></i>
                                Maximum Withdraw Amount: <strong>&#8377;50,000</strong>
                            </small>

                            @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="note">Additional Note (optional):</label>
                            <textarea
                                class="form-control @error('note') is-invalid @enderror"
                                name="note"
                                id="note"
                                rows="3"
                                placeholder="If any Additional Notes, add them here."
                                value="{{old('note')}}"
                            ></textarea>

                            @error('note')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small class="ml-1">
                                <div class="row mt-0">
                                    <div class="col-12 ml-2">
                                        <i class="fa fa-question-circle mr-1"></i>
                                        <strong>Service Timings:</strong><br>
                                    </div>
                                    <div class="col-6">
                                        <span class="ml-3"><strong>Monday:</strong> 10:00 - 17:00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="ml-3"><strong>Tuesday:</strong> 10:00 - 17:00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="ml-3"><strong>Wednesday:</strong> 10:00 - 17:00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="ml-3"><strong>Thursday:</strong> 10:00 - 17:00</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="ml-3"><strong>Friday:</strong> 10:00 - 17:00</span>
                                    </div>
                                </div>
                            </small>
                        </div>

                        <button
                            class="btn btn-warning btn-lg w-100"
                            type="submit"
                        >
                            Request Withdrawal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

