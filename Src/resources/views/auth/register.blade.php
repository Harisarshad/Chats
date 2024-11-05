@extends('layouts.master-without-nav')

@section('title'){{ __("Register") }} @endsection

@section('body')
<body>
@endsection

@section('content')

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center mb-4">
                    <a href="{{url('/')}}" class="auth-logo mb-5 d-block">
                        <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="30" class="logo logo-dark">
                        <img src="{{ URL::asset('/assets/images/logo-light.png')}}" alt="" height="30" class="logo logo-light">
                    </a>
                    <h4>{{ __("Sign up") }}</h4>
                    <p class="text-muted mb-4">{{ __("Get your CHAT account now.") }}</p>
                    
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="p-3">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>{{ __("Email") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-mail-line"></i>
                                            </span>
                                        </div>
                                        <input id="email" type="email" class="form-control bg-soft-light border-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __("Enter Email") }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Contact No.") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                        </div>
                                        <input id="phone" type="text" class="form-control bg-soft-light border-light @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="{{ __("Enter Contact No.") }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __("Username") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text" class="form-control bg-soft-light border-light @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __("Enter Username") }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>{{ __("Password") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                        </div>
                                        <input id="password" type="password" class="form-control bg-soft-light border-light @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __("Enter Password") }}">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>{{ __("Confirm Password") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-lock-2-line"></i>
                                            </span>
                                        </div>
                                        <input id="password-confirm" type="password" class="form-control bg-soft-light border-light" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __("Enter Confirm Password") }}">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="avatar">{{ __("Profile Picture") }}</label>
                                    <input type="file" class="form-control bg-soft-light border-light @error('avatar') is-invalid @enderror" name="avatar" required id="avatar">
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>{{ __("Location") }}</label>
                                    <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-light text-muted">
                                                <i class="ri-user-2-line"></i>
                                            </span>
                                        </div>
                                        <textarea id="location" type="text" class="form-control bg-soft-light border-light @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus></textarea>
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __("Sign up") }}</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <p class="text-muted mb-0">{{ __("By registering you agree to the CHAT") }} <a href="#" class="text-primary">{{ __("Terms of Use") }}</a></p>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>{{ __("Already have an account ?") }} <a href="{{url('login')}}" class="font-weight-medium text-primary"> {{ __("Signin") }} </a> </p>
                    <p>{{ __("© 2020 CHAT. Crafted with") }} <i class="mdi mdi-heart text-danger"></i> {{ __("by HarisArshad") }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
