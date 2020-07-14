<div class="form-group">
    <label for="account-address">Payment Address</label>
    <input
        class="form-control @error('account_address') is-invalid @enderror"
        type="text"
        name="account_address"
        id="account-address"
        placeholder="Ex: @if($method->slug === 'paytm'){{'9876543210'}}@elseif($method->slug === 'upi'){{'example.auric@sbi'}}@endif"
        value="{{old('account_address')}}"
    />
    <small class="ml-1">
        <i class="fa fa-lock mr-1"></i>
        Your payment info is stored securely.
        <a
            class="ml-1"
            href="#"
        >Learn More</a>
    </small>

    @error('account_address')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
