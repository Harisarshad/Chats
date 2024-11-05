@extends('layouts.master-without-nav')

@section('title'){{ __("Reset Password") }} @endsection

@section('body')
<body>
@endsection

@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <a href="{{ url('/') }}" class="auth-logo mb-5 d-block">
                            <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="30"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="30"
                                class="logo logo-light">
                        </a>

                        <h4>{{ __("Reset Password") }}</h4>
                        <p class="text-muted mb-4">{{ __("Reset Password With CHAT.") }}</p>

                    </div>
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group mb-4">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-light text-muted">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                                            </div>
                                            <input id="email" type="email"
                                                class="form-control bg-soft-light border-light @error('email') is-invalid @enderror"
                                                placeholder="{{ __("Enter Email") }}" name="email" value="{{ old('email') }}"
                                                required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password">{{ __('Password') }}</label>
                                        <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-light text-muted">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                            </div>
                                            <input id="password" type="password"
                                                class="form-control bg-soft-light border-light @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="{{ __("Enter Password") }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <div class="input-group mb-3 bg-soft-light input-group-lg rounded-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-light text-muted">
                                                    <i class="ri-lock-2-line"></i>
                                                </span>
                                            </div>
                                            <input id="password-confirm" type="password"
                                                class="form-control bg-soft-light border-light"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="{{ __("Enter Password") }}">

                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit"
                                            class="btn btn-primary btn-block waves-effect waves-light">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>{{ __("Remember It ?") }} <a href="{{ url('auth-login') }}" class="font-weight-medium text-primary">
                            {{ __("Signin") }} </a> </p>
                        <p>{{ __("© 2020 CHAT. Crafted with") }} <i class="mdi mdi-heart text-danger"></i> {{ __("by HarisArshad") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
