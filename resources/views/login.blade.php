 @include('partials.unauth.header')

<div class="container">
    <div class="row">
        <div class="col-lg-8">
        </div>

        <div class="col-lg-4">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">Sign in to start your session</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="email">
                            <div class="input-group-append">
                                <div class="input-group-text rounded-0">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control rounded-0" placeholder="Password" data="req" data-key="password">
                            <div class="input-group-append">
                                <div class="input-group-text rounded-0">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-danger d-none" data-role="p-error-message"></p>

                        <button type="button" class="btn btn-outline-primary btn-block rounded-0" data-trigger="login">Sign In</button>
                        <hr />
                        <a class="btn btn-outline-info btn-block btn-flat" href="register">Register</a>
        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.terms_of_use')
@include('components.data_privacy_policy')
@include('partials.unauth.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/registration.js') }}"></script>