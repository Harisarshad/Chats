@extends('layouts.master-without-nav')

@section('title'){{ __("Un authorized!") }} @endsection

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
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="display-2 fw-medium">404</h1>
                                <h4 class="text-uppercase">{{ __("Sorry, You are not authorized to view that page!") }}</h4>
                                <div class="mt-5 text-center">
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ url('/') }}">{{ __("Back to Home") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
            </div>
        </div>
    </div>
</div>
@endsection
