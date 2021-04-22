@extends('external.layout.main')

@section('page-css')
    <link rel="stylesheet" href="{{asset('/common/css/iziToast.min.css')}}">
    <link rel="stylesheet" href="{{asset('/external/account/css/login.css').'?v='.config('app.version')}}">
@endsection

@section('content')
    <div class="row no-gutters align-items-center content">
        <div class="container content-container">
            <div class="row no-gutters">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                    <div class="row no-gutters card signin loginForm">
                        <form class="col card-wrapper frmLogin" name="frmLogin">
                            @csrf
                            <div class="row no-gutters align-items-sm-start title">
                                <h4>Welcome Back</h4>
                            </div>
                            <div class="row no-gutters field">
                                <div class="col form-group">
                                    <label>Email Address <span class="red">*</span></label>
                                    <div class="row no-gutters form-group--wrapper">
                                        <input name="emailid" onkeydown="checkValidation($(this));" type="email" class="emailid form-control" placeholder="email@example.com" autocomplete="off" value="" >
                                        <div class="focusinput"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters field mb-30">
                                <div class="col form-group">
                                    <label>Password <span class="red">*</span></label>
                                    <div class="row no-gutters form-group--wrapper">
                                        <input name="password" onkeydown="checkValidation($(this));" type="password" class="password form-control" placeholder="Your password" autocomplete="off" value="">
                                        <div class="focusinput"></div>
                                        <div class="input-group-append">
                                            <span class="input-group-text symbol2"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters action">
                                <a id="login-btn" class="btn ls-btn">Submit</a>
                            </div>
                            <div class="row no-gutters align-items-center justify-content-center action">
                                <p class="signuplink mt-4">Don't have an account?&nbsp;<a href="{{route('register')}}">Register</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('/common/js/iziToast.min.js')}}"></script>
    <script src="{{asset('/external/account/js/login.js').'?v='.config('app.version')}}"></script>
    <script src="{{asset('/common/js/min/field-validations.min.js')}}"></script>
@endsection