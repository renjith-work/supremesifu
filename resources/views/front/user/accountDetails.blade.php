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
                                    <li> <a href="/user/account-details" class="active">Account Details</a></li>
                                    <li> <a href="/user/password-reset">Password Reset</a></li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <h3>Account Details</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton">You can update your profile here. If you update your email address then we will require your to evrify your new email address.</div>
                                            <div class="px-customer-dashboard-form-cover">
                                                <form action="{{ route('user.account-details.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }} {{ method_field('PUT') }}
                                                   <div class="form-group">
                                                        <label for="fname">First Name *</label>
                                                        <input type="text" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname', $user->fname) }}" id="fname" name="fname" placeholder="Please enter your first name...">
                                                        @error('fname') <p class="error-p">{{ $errors->first('fname') }}</p> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lname">Last Name *</label>
                                                        <input type="text" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname', $user->lname) }}" id="lname" name="lname" placeholder="Please enter your last name...">
                                                        @error('lname') <p class="error-p">{{ $errors->first('lname') }}</p> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email address *</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" id="emai1" name="email" placeholder="Please enter your email...">
                                                        @error('email') <p class="error-p">{{ $errors->first('email') }}</p> @enderror
                                                    </div>
                                                    <div class="px-customer-dashboard-submit-cover">
                                                        <input type="Submit" value="Save Details" class="btn px-black-btn">
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