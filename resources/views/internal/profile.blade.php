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
                    <div class="row no-gutters card signup signupForm">
                        <form class="col card-wrapper frmSignup" name="frmSignup" enctype="multipart/form-data">
                            @csrf
                            <div class="row no-gutters align-items-sm-start title">
                                <h4>Profile</h4>
                            </div>
                            <div class="row no-gutters field combofield">
                                <label>Full Name <span class="red">*</span></label>
                                <div class="col form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="First name & Last name" data-name="Full Name" autocomplete="off">
                                </div>
                            </div>
                            <div class="row no-gutters field">
                                <div class="col form-group">
                                    <label>Email Address <span class="red">*</span></label>
                                    <div class="row no-gutters form-group--wrapper">
                                        <input type="email" name="emailid" id="emailid" class="emailid form-control" placeholder="email@example.com" data-name="Email" autocomplete="off" value="">
                                        <div class="focusinput"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters field combofield">
                                <label>Mobile No. (Optional)</label>
                                <div class="col form-group">
                                    <input type="text" data-skip="1" name="mobile_no" id="mobile_no" class="form-control" placeholder="Your Mobile No." autocomplete="off">
                                </div>
                            </div>
                            <div class="row no-gutters field">
                                <div class="col form-group">
                                    <label>Upload an age/Id proof document</label>
                                    <input data-skip="1" type="file" name="document" class="file form-control" data-name="Age/Id Proof"  style="height: auto; padding: 20px;">
                                    <a href="" id="document_name" target="_blank">View Document</a>
                                </div>
                            </div>

                            <div class="row no-gutters align-items-center action">
                                <a id="signup-btn" class="btn ls-btn">Update</a>
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
    <script src="{{asset('/external/account/js/profile.js').'?v='.config('app.version')}}"></script>
    <script src="{{asset('/common/js/min/field-validations.min.js')}}"></script>
    <script>
        access_token = '{{Auth::user()->access_token}}';
    </script>
@endsection