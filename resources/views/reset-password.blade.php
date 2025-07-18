@include('partials.unauth.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card rounded-0 shadow-lg">
                <div class="card-header">
                    <h5 class="card-title text-center">Reset Password</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted text-center mb-4">
                        Enter your new password below.
                    </p>
                    
                    <form>
                        <input type="hidden" data-key="token" value="{{ $token }}">
                        
                        <div class="input-group mb-3">
                            <input type="email" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="email">
                            <div class="input-group-append">
                                <div class="input-group-text rounded-0">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" class="form-control rounded-0" placeholder="New Password" data="req" data-key="password">
                            <div class="input-group-append">
                                <div class="input-group-text rounded-0">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" class="form-control rounded-0" placeholder="Confirm New Password" data="req" data-key="password_confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text rounded-0">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-danger d-none" data-role="p-error-message"></p>

                        <button type="button" class="btn btn-outline-primary btn-block rounded-0" data-trigger="reset-password">
                            Reset Password
                        </button>
                        
                        <hr />
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-muted">
                                <i class="fas fa-arrow-left"></i> Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.unauth.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/reset-password.js') }}"></script> 