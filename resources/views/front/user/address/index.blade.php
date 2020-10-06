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
                                @include('front.user.dashboard_sidebar')
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <h3>Address Book</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton">You can add your addresses here. These addresses can be accessed to be used to send your products when you are making a purchase.</div>
                                        </div>
                                        @if (count($addresses) > 0)
                                        <div class="address-book-table-cover">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark add-tab-head">
                                                        <tr>
                                                        <th scope="col">Full Name</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Postcode</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Label</th>
                                                        <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($addresses as $address)
                                                        <tr class="add-tab-body">
                                                            <th><div class="add-tab-name">{{$address->first_name}} {{$address->last_name}}</div></th>
                                                            <td>{{$address->address}}, {{$address->city}}, {{$address->country->name}}.</td>
                                                            <td>{{$address->postcode}}</td>
                                                            <td>{{$address->phoneCode->value}}{{$address->phone}}</td>
                                                            <td>
                                                                @if($address->userAddressTypes)
                                                                @foreach($address->userAddressTypes as $addressType)
                                                                    @if($addressType->address_type_id == 1) <span class="badge badge-light">Default Billing Address</span> @endif
                                                                    @if($addressType->address_type_id == 2) <span class="badge badge-light">Default Shipping Address</span> @endif
                                                                @endforeach
                                                                @endif
                                                            </td>
                                                            <td><div class="add-tab-action"><a href="/user/address/{{$address->id}}/edit">Edit</a></div></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>   
                                        @endif
                                        <div class="add-address-cover row">
                                            <div class="col-md-4 offset-md-8"><a href="/user/address/create" class="btn pull-right">+ Add New Address</a></div>
                                            
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