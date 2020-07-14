<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area pt-3">
        <!-- Choose Payment Method-->
        <div class="choose-payment-method">
            <h6 class="mb-3 text-center">Choose a Method</h6>
            <div class="row justify-content-center">
                @foreach ($method as $mt)

                <!-- Single Payment Method-->
                <div class="col-6 col-md-5">
                    <div class="single-payment-method">
                        <a
                            class="bank"
                            href="{{route('user.withdraw.bank.create', $mt->slug)}}"
                            ><i class="{{$mt->icon}}"></i>
                            <h6>{{$mt->name}}</h6></a
                        >
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</div>
