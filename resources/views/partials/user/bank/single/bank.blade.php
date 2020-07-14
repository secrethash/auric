<div class="form-group">
    <label for="account-number">Account Number</label>
    <input
        class="form-control @error('account_number') is-invalid @enderror"
        type="text"
        name="account_number"
        id="account-number"
        placeholder="0034 ×××× ×××× ××××"
        value="{{old('account_number')}}"
    />
    <small class="ml-1">
        <i class="fa fa-lock mr-1"></i>
        Your payment info is stored securely.
        <a
            class="ml-1"
            href="#"
        >Learn More</a>
    </small>

    @error('account_number')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="account-ifsc">Bank IFSC Code</label>
    <input
        class="form-control text-uppercase @error('ifsc_code') is-invalid @enderror"
        type="text"
        name="ifsc_code"
        id="account-ifsc"
        placeholder="Ex: SBIN0054"
        value="{{old('ifsc_code')}}"
    />

    @error('ifsc_code')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="account-holder">Account Holder's Name</label>
    <input
        class="form-control @error('account_holder') is-invalid @enderror"
        type="text"
        name="account_holder"
        id="account-holder"
        placeholder="John Doe"
        value="{{old('account_holder')}}"
    />

    @error('account_holder')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
