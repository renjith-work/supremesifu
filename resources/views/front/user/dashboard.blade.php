@extends('front.layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/front/frame/auth/userDashboard.css" rel="stylesheet">
@endsection
@section('content')    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="px-account-dashboard">
                        @if(Session::has('success'))
                          <div class="alert alert-success" role="alert">
                            <strong>Success :</strong> {{ Session::get('success') }}
                          </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                                <!-- Nav tabs -->
                                <ul class="nav flex-column px-dashboard-list">
                                    <li><a href="/user/dashboard" class="active">Dashboard</a></li>
                                    <li> <a href="/user/account-details">Account Details</a></li>
                                    <li> <a href="/user/password-reset">Password Reset</a></li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <h3>Customer Dashboard </h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton">
                                                From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection