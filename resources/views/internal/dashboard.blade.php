@extends('internal.layout.blank')
@section('page-css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('/common/css/iziToast.min.css')}}">
@endsection

@section('content')
<section class="content product">
    <div class="row no-gutters main">
        <div class="container structure">
            <div class="row no-gutters">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="row no-gutters title">
                        <h3 class="top">Welcome</h3>
                    </div>
                    <div class="row no-gutters">
                        <a href="/profile?token={{$token}}">Update Profile</a>
                    </div>
                    <hr class="hr-class1">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content product">
    <div class="row no-gutters main">
        <div class="container structure">
            <div class="row no-gutters">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="row no-gutters second-title">
                        <h5>Search Exchange Rates</h5>
                    </div>
                    <div class="settings">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form name="frmProfile" class="row forms frmProfile">
                                    @csrf
                                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 inner-form">
                                        <div class="row no-gutters field combofield">
                                            <label>From Country <span class="red">*</span></label>
                                            <div class="col-12 select-content">
                                                <select name="from" id="from" class="profile-select js-states form-control" >

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row no-gutters field combofield pt-2">
                                            <label>To Country <span class="red">*</span></label>
                                            <div class="col-12 select-content">
                                                <select name="to" id="to" class="profile-select js-states form-control" >

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <a onclick="searchRate();" style="border: 1px solid #000; width: 150px; height: 40px;" id="search-btn" class="btn btn-filedbutton">Search</a>
                                    </div>

                                    <div class="" id="rates" style="padding-top: 20px; color: green">

                                    </div>
                                    <div class="d-none w-100" id="fav" style="padding-top: 20px; color: green">
                                        <a href="javascript:void(0);" onclick="favorite();">Favorite this Exchange</a>
                                    </div>
                                </form>

                                <div class="row billing pt-3" id="invoices">
                                    <div class="col-12">
                                        <label class="w-100" style="font-size: 18px;">My Favorite</label>
                                    </div>
                                    <div class="col-12 col-xs-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                                        <div class="d-flex  no-gutters billing-details">
                                            <div class="col invoices">
                                                <div class="row no-gutters field" id="favRate">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row no-gutters billing-forms">
                                    <div class="col-12">
                                        <label class="w-100">Your Plan</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
    <script src="{{asset('/common/js/iziToast.min.js')}}"></script>
    <script src="{{asset('/external/account/js/exchanger.js').'?v='.config('app.version')}}"></script>
    <script src="{{asset('/common/js/min/field-validations.min.js')}}"></script>
    <script>
        access_token = '{{$token}}';
        $( document ).ready(function() {
            getCountryList();
            myFavorite();
        });
    </script>
@endsection