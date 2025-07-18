 @include('partials.unauth.header')

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            
                    <div class="bootstrap-carousel">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('assets/images/announcement/1.png') }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('assets/images/announcement/2.png') }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('assets/images/announcement/3.png') }}" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('assets/images/announcement/4.png') }}" alt="Fourth slide">
                                </div>
                            </div><a class="carousel-control-prev" href="#carouselExampleControls" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carouselExampleControls" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
                        </div>
                    </div>
                
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
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="text-muted">
                                Forgot your password?
                            </a>
                        </div>
                        
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