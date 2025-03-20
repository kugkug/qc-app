 @include('partials.unauth.header')

<div class="container">
    <div class="row">
        <div class="col-lg-6">
        </div>

        <div class="col-lg-6">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">Sign in to start your session</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="/execute/login">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Username" value="{{ old('email')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('message')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                        {{-- <button type="submit" class="btn btn-outline-primary btn-block rounded-0">Sign In</button> --}}
                        <a class="btn btn-outline-primary btn-block btn-flat" href="applicant/home">Sign In</a>
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