@extends('front.layout')
@section('title', 'Order Completed')
@section('header')
    <link rel="stylesheet" href="/front/assets/css/invoice.css">
    <link rel="stylesheet" href="/front/assets/css/print/orderCompletePrint.css">
@endsection
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">Order</li>
                        <li class="breadcrumb-item active">Order Complete</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-container">
        <div class="tankyou-cover">
            <div class="thankyou-icon"><i class="fa fa-check-circle-o" aria-hidden="true"></i></div>
            <div class="thankyou-head">We have received your order.</div>
            <div class="thankyou-sub-head">Order No: <span>{{$order->order_number}}</span></div>
            <div class="thankyou-body">A copy of your receipt has been sent to: <span>{{$order->user->email}}</span>. <br> If the email hasn't arrived within a few minutes, please check your spam folder to see if the email was routed there.</div>
            <div class="thankyou-print-invoice"><a href="/checkout/order/8/generate/invoice-pdf"><span><i class="fa fa-print" aria-hidden="true"></i></span>PRINT PDF</a></div>
        </div>
        <div class="invoice-cover" id="invoice-div">
            <div class="invoice-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="invoice-logo"><img src="/front/assets/images/logo/logo_footer.png" alt=""></div>
                    </div>
                    <div class="col-md-4 offset-md-4">
                        <div class="invh-add-cover">
                            <div class="inv-add-tittle">ADDRESS</div>
                            <div class="inv-add-section">26-G, Jalan Tiara 2D, Bandar Baru Klang, 41150 Klang, Selangor, Malaysia.</div>
                            <div class="inv-add-section">
                                <ul>
                                    <li><span>Phone : </span> +60 11-1070 3163</li>
                                    <li><span>Email : </span> support@supremesifu.com</li>
                                    <li><span>Web : </span> support@supremesifu.com</li>
                                </ul>
                            </div>
                            <div class="inv-add-section"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-sub-header">
                <div class="invsh-details-cover">
                    <div class="invsh-details-head">INVOICE : {{$order->order_number}}</div>
                    <div class="invsh-details-body"><span>Date</span> - {{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
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
            </div>
        </div>
    </div>
@stop