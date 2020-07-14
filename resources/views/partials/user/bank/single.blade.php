<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area py-3">
        <!-- Credit Card Info-->
        <div class="credit-card-info-wrapper">
            <img
                class="d-block mb-4"
                src="{{asset('images/bg-img/12.png')}}"
                alt=""
            />
            <div class="pay-credit-card-form">
                <form action="{{route('user.withdraw.bank.create', encrypt($method->id))}}" method="POST">
                    @csrf

                    @if($method->slug === 'bank')
                        @include('partials.user.bank.single.bank', ['method' => $method])
                    @elseif ($method->slug === 'upi' || $method->slug === 'paytm')
                        @include('partials.user.bank.single.address', ['method' => $method])
                    @endif

                    <button
                        class="btn btn-warning btn-lg w-100"
                        type="submit"
                    >
                        Add Details
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
