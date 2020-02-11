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
                                    <li><a href="/user/dashboard">Dashboard</a></li>
                                    <li> <a href="/user/account-details">Account Details</a></li>
                                    <li> <a href="/user/password-reset" class="active">Password Reset</a></li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <h3>Account Details</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton">To reset your password, please provide your current password followed by the new password. <br>
                                                    If you have forgotten your password, pleace proceede to logout and click on the forgot password link.
                                                </div>
                                                <div class="px-customer-dashboard-form-cover">
                                                <form action="{{ route('user.password-reset.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }} {{ method_field('PUT') }}
                                                   <div class="form-group">
                                                        <label for="current-password">Current Password *</label>
                                                        <input type="password" class="form-control @error('current-password') is-invalid @enderror" id="current-password" name="current-password" placeholder="Please enter your current password...">
                                                        @error('current-password') <p class="error-p">{{ $errors->first('current-password') }}</p> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please enter your minimum 6-character password..">
                                                        @error('password') <p class="error-p">{{ $errors->first('password') }}</p> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Enter the password...">
                                                    </div>
                                                    <div class="px-customer-dashboard-submit-cover">
                                                        <input type="Submit" value="Save Password" class="btn px-black-btn">
                                                    </div>
                                                </form>
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