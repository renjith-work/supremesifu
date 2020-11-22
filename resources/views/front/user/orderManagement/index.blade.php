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
                                        <h3>Order Management</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="px-dashboard-instruciton">You can add your addresses here. These addresses can be accessed to be used to send your products when you are making a purchase.</div>
                                        </div>
                                        <div class="address-book-table-cover">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark add-tab-head">
                                                        <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Order</th>
                                                        <th scope="col">Items</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count = 1;?>
                                                        @foreach($orders as $order)
                                                        <tr class="add-tab-body">
                                                            <th>{{$count}}</th>
                                                            <td><div class="add-tab-name">{{$order->detail->order_number}}</div></td>
                                                            <td>
                                                                {{-- {{$order->items}} --}}
                                                                @foreach($order->detail->items as $item)
                                                                    {{$item->product->name}} <br>
                                                                @endforeach
                                                            </td>
                                                            {{-- <td>
                                                                <div class="ordm-list-add">
                                                                    <strong>Name -</strong> {{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}} <br>
                                                                    <strong>Email -</strong> {{$order->shippingAddress->email }}<br>
                                                                    <strong>Phone -</strong> {{$order->shippingAddress->phoneCode->value }} {{$order->shippingAddress->phone }}<br>
                                                                    <strong>Address -</strong> {{$order->shippingAddress->address}}, {{$order->shippingAddress->city}}, {{$order->shippingAddress->postcode}}, {{$order->shippingAddress->zone->country->name}}.
                                                                </div>
                                                            </td> --}}
                                                            <td><span>RM {{$order->detail->payment->total}}</span></td>
                                                            <td>{{$order->detail->status->name}}</td>
                                                        <td><div class="ordm-view"><a href="/user/order-management/{{$order->detail->order_number}}/details">Order Details</a></div></td>
                                                        </tr>
                                                        <?php $count++; ?>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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