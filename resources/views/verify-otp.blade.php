@include('partials.unauth.header')

<section class="container">
    <form action="">
        <input type="hidden" id="token" value="{{ $token }}">
    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h5 class="card-title text-red font-weight-bold">Verify OTP</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-12">
                    <input 
                        type="text" 
                        class="form-control rounded-0" 
                        placeholder="Please enter the OTP sent to your email" 
                        data="req" 
                        data-key="Otp"
                        id="txtOtp"
                    >
                </div>
                <div class="form-group col-lg-12">
                    <button class="btn btn-outline-primary btn-flat btn-block" data-trigger="verify-otp-submit">
                        Verify
                    </button>
                    <p class="text-center text-muted mt-2">
                        Resend OTP in <span id="expiry-countdown" class="text-muted">05:00</span>
                    </p>
                </div>
                
            </div>
        </div> 
    </div>
    </form>
</section>

@include('partials.unauth.footer')  

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/verify.js') }}"></script>