@extends('front.layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/front/frame/auth/userDashboard.css" rel="stylesheet">
@endsection
@section('content')   
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    
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
                              @include('front.user.dashboard_sidebar')
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <h3>Add Address</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton"></div>
                                            <div class="px-customer-dashboard-form-cover">
                                                <form action="{{ route('front.user.address.store') }}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }} 
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                                   
                                                                <label for="name">Full Name *</label>
                                                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="Please enter your full name...">
                                                                @error('name') <p class="error-p">{{ $errors->first('name') }}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email address *</label>
                                                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="emai1" name="email" placeholder="Please enter an email...">
                                                                @error('email') <p class="error-p">{{ $errors->first('email') }}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone Number *</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <select class="form-control @error('phone') is-invalid @enderror" id="phoneCode" name="phoneCode">
                                                                            @foreach($phoneCodes as $phoneCode)
                                                                            <option value="{{$phoneCode->id}}">{{$phoneCode->code}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Please enter a phone number...">
                                                                    </div>
                                                                </div>
                                                                @error('phone') <p class="error-p">{{ $errors->first('phone') }}</p> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Select Country</label>
                                                                <select class="form-control @error('country') is-invalid @enderror" id="country" name="country">
                                                                    <option disabled selected>Select Country</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('country') <p class="error-p">{{ $errors->first('country') }}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="zone">Select Zone</label>
                                                                <select class="form-control @error('zone') is-invalid @enderror" id="zone" name="zone">
                                                                    <option disabled selected>Please select a country for the zones..</option>
                                                                </select>
                                                                @error('zone') <p class="error-p">{{ $errors->first('zone') }}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror" rows="5">{{ old('address') }}</textarea>
                                                                @error('address') <p class="error-p">{{$errors->first('address')}}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="city">City *</label>
                                                                <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" id="city" name="city" placeholder="Please enter the city...">
                                                                @error('city') <p class="error-p">{{ $errors->first('city') }}</p> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="postcode">Post Code *</label>
                                                                <input type="text" class="form-control @error('postcode') is-invalid @enderror" value="{{ old('postcode') }}" id="postcode" name="postcode" placeholder="Please enter the post code...">
                                                                @error('postcode') <p class="error-p">{{ $errors->first('postcode') }}</p> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="adb-label-cover">
                                                        <div class="adb-label-head">Address Label</div>
                                                        <div class="adb-label-instruction">
                                                            You can set an address as default billing and shipping address. At a time you can have only one default billing address and one default shipping address. You may save the same address as default billing and shipping address.
                                                        </div>
                                                        <div class="adb-label-body-cover">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-check adb-radio-cover">
                                                                        <input class="form-check-input adb-radio-input" type="checkbox" name="billing_address" id="billing_address" value="1">
                                                                        <label class="form-check-label adb-radio-label" for="billing_address">Default Billing Address</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check adb-radio-cover">
                                                                        <input class="form-check-input adb-radio-input" type="checkbox" name="shipping_address" id="shipping_address" value="1">
                                                                        <label class="form-check-label adb-radio-label" for="shipping_address">Default Shipping Address</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="adb-label-instruction">
                                                            *if you have previouly set another address as default billing or shipping address, the default status of that address will be removed and the current address will be set as default.
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="px-customer-dashboard-submit-cover">
                                                        <input type="Submit" value="Save Address" class="btn px-black-btn">
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
@section('footer')
    <script type="text/javascript">
        var country_id  = '';
        var zone_id  = '';
    </script>
    <script type="text/javascript" src="/front/code/js/user/address-book/address-book.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection