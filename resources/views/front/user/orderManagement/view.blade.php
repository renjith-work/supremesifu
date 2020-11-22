@extends('front.layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/front/frame/auth/userDashboard.css" rel="stylesheet">
    <link href="/front/frame/auth/userDashboardOrder.css" rel="stylesheet">
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
                                        <h3>Order Details</h3>
                                        <div class="px-customer-dasboard-body">
                                            <div class="order-status-cover">
                                                <div class="order-status-image">
                                                    @if($order->status->id == 1)
                                                        <img src="/front/assets/images/order-status/pending.png" alt="">
                                                    @elseif($order->status->id == 2)
                                                        <img src="/front/assets/images/order-status/processing.png" alt="">
                                                    @elseif($order->status->id == 3)
                                                        <img src="/front/assets/images/order-status/shipped.png" alt="">
                                                    @elseif($order->status->id == 4)
                                                        <img src="/front/assets/images/order-status/transit.png" alt="">
                                                    @elseif($order->status->id == 5)
                                                        <img src="/front/assets/images/order-status/delivered.png" alt="">
                                                    @elseif($order->status->id == 6)
                                                        <img src="/front/assets/images/order-status/pending.png" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="invoice-cover" id="invoice-div">
                                                <div class="invoice-sub-header">
                                                    <div class="invsh-details-cover">
                                                        <div class="invsh-details-head">ORDER ID : {{$order->order_number}}</div>
                                                        <div class="invsh-details-body"><span>Order Date</span> - {{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
                                                    </div>
                                                    <div class="invsh-add-cover">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="invsh-add-head">BILLING ADDRESS</div>
                                                                <div class="invsh-add-detail-section">
                                                                    <div class="invsh-adds-name">{{$order->billingAddress->first_name}} {{$order->billingAddress->last_name}}</div>
                                                                    <div class="invsh-adds-section">{{$order->billingAddress->address}}, {{$order->billingAddress->city}}, {{$order->billingAddress->postcode}} {{$order->billingAddress->zone->name}}, {{$order->billingAddress->country->name}}</div>
                                                                    <div class="invsh-adds-csection">
                                                                        <ul>
                                                                            <li><span>Phone : </span>{{$order->billingAddress->phoneCode->value}} {{$order->billingAddress->phone}} </li>
                                                                            <li><span>Email : </span>{{$order->billingAddress->email}}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 offset-md-4">
                                                                <div class="invsh-add-head">SHIPPING ADDRESS</div>
                                                                <div class="invsh-add-detail-section">
                                                                    <div class="invsh-adds-name">{{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}}</div>
                                                                    <div class="invsh-adds-section">{{$order->shippingAddress->address}}, {{$order->shippingAddress->city}}, {{$order->shippingAddress->postcode}} {{$order->shippingAddress->zone->name}}, {{$order->shippingAddress->country->name}}</div>
                                                                    <div class="invsh-adds-csection">
                                                                        <ul>
                                                                            <li><span>Phone : </span>{{$order->shippingAddress->phoneCode->value}} {{$order->shippingAddress->phone}} </li>
                                                                            <li><span>Email : </span>{{$order->shippingAddress->email}}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-sub-details">
                                                    <div class="inv-table-cover">
                                                        <table class="table table-striped">
                                                            <thead class="thead-black">
                                                                <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">Qty</th>
                                                                <th scope="col">Total</th>
                                                                <th scope="col">Details</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $count = 1; ?>
                                                                @foreach($order->items as $item)
                                                                <tr>
                                                                    <th scope="row">{{$count}}</th>
                                                                    <td>{{$item->product->name}}</td>
                                                                    <td>{{sprintf('%0.2f',$item->price)}}</td>
                                                                    <td>{{$item->quantity}}</td>
                                                                    <td>{{sprintf('%0.2f',$item->total_price)}}</td>
                                                                <td><div class="ord-dt-a"><a href="/user/order-management/{{$order->id}}/product/{{$item->id}}">View Details</a></div></td>
                                                                </tr>
                                                                <?php $count++; ?>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                    <div class="inv-total-cover">
                                                        <div class="row">
                                                            <div class="col-md-6 offset-md-6">
                                                                <div class="inv-total-item row">
                                                                    <div class="col-md-8"><span>Sub Total ({{$order->item_count}} Items) - </span></div>
                                                                    <div class="col-md-4">RM {{sprintf('%0.2f',$order->payment->grand_total)}}</div>
                                                                </div>
                                                                <div class="inv-total-item row">
                                                                    <div class="col-md-8"><span>Tax - </span></div>
                                                                    <div class="col-md-4">RM 0.00</div>
                                                                </div>
                                                                <div class="inv-total-item row">
                                                                    <div class="col-md-8"><span>Shipping - </span></div>
                                                                    <div class="col-md-4">RM 10.00</div>
                                                                </div>
                                                                <div class="inv-total-item row">
                                                                    <div class="col-md-8"><span>Discount - </span></div>
                                                                    <div class="col-md-4">RM 0.00</div>
                                                                </div>
                                                                <div class="inv-total-item row inv-tit">
                                                                    <div class="col-md-8"><span class="invt-total">Total - </span></div>
                                                                    <div class="col-md-4">RM {{sprintf('%0.2f',$order->payment->total)}}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invoice-sub-footer">
                                                    <div class="inv-footer-head">PAYMENT DETAILS</div>
                                                    <div class="inv-footer-payment-body"><span>Payment Refference - </span>{{$order->payment_method}}</div>
                                                    <div class="inv-print-cover">
                                                    <a href="/checkout/order/{{$order->id}}/generate/invoice-pdf"><span><i class="fa fa-print" aria-hidden="true"></i></span>Print Invoice</a>
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
        </div>
    </div>
    <!-- content-wraper end -->
@endsection