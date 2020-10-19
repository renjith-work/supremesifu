@extends('front.layout')
@section('header')
    <link rel="stylesheet" href="/front/assets/css/checkout.css">
@endsection
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/cart">Cart</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- content-wraper start -->
    <div class="mobile-container">
            <!-- checkout-details-wrapper start -->
            @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <div class="sp-checkout-cover">
                <div class="row">
                    <div class="col-md-7">
                        <h3 class="shoping-checkboxt-title">Item Details</h3>
                        <div class="cart-table-wide">
                            <div class="sifu-cart-table-cover">
                            <div class="sifu-cart-table-head">
                                <div class="row">
                                    <div class="col-1 ssifu-table-border">
                                        <h3>#</h3>
                                    </div>
                                    <div class="col-2 ssifu-table-border">
                                        <h3>IMAGE</h3>
                                    </div>
                                    <div class="col-4 ssifu-table-border">
                                        <h3>PRODUCT</h3>
                                    </div>
                                    <div class="col-3 ssifu-table-border">
                                        <h3>PRICE</h3>
                                    </div>
                                    <div class="col-2 ssifu-table-border">
                                        <h3>QTY</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="sifu-cart-table-body">
                                <?php $cartNo = 1; ?>
                                @foreach(\Cart::getContent() as $item)
                                <div class="row">
                                    <div class="col-1 col-md-1 scol-right-border">
                                        <div class="product-content-center pcd-dktp">{{$cartNo}}</div>
                                    </div>
                                    <div class="col-4 col-md-2 scol-right-border">
                                        @if($item->attributes->user == 1)
                                            @foreach($item->attributes->images as $image)
                                                @if($image->position_id == 1)
                                                    <img src="/images/product/design/{{$image->name}}">
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($item->attributes->images as $image)
                                                @if($image->position_id == 1)
                                                    <img src="/images/product/design/{{$image->name}}"> 
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-4 col-md-4 scol-right-border">
                                        <div class="product-content-left">
                                            <div class="product-content-name"><a href="/cart/product/{{$item->id}}/edit/qty/{{ $item->quantity }}">{{ Str::words($item->name,20) }}</a></div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-3 scol-right-border">
                                        <div class="product-content-center pcd-dktp wd-cart-margin">
                                            <span class="amount">{{ config('settings.currency_symbol')}} {{$item->getPriceSum()}}</span>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <div class="product-content-center pcd-dktp wd-cart-margin"><span class="amount">{{ $item->quantity }}</span></div>
                                    </div>
                                </div>
                                <div class="pdc-border"></div>
                                <?php $cartNo++; ?>
                                @endforeach
                            </div>
                            </div>
                        </div>
                        <div class="cart-table-mobile">
                            <div class="sifu-cart-table-cover">
                                <a href="#" class="cart-mobile-top-checkout">CHECKOUT</a>
                            </div>
                            <div class="sifu-cart-table-mobile-body">
                                @foreach(\Cart::getContent() as $item)
                                <div class="cart-product-item">
                                    <div class="row">
                                        <div class="col-4 col-md-4 scol-right-border no-padding-right">
                                            <div class="cart-product-image">
                                                @if($item->attributes->user == 1)
                                                    @foreach($item->attributes->images as $image)
                                                        @if($image->position_id == 1)
                                                            <img src="/images/product/design/{{$image->name}}">
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($item->attributes->images as $image)
                                                        @if($image->position_id == 1)
                                                            <img src="/images/product/design/{{$image->name}}"> 
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-5 col-md-5 scol-right-border">
                                            <div class="mobile-cart-product-name cart-product-name">
                                                <a href="/cart/product/{{$item->id}}/edit/qty/{{ $item->quantity }}">{{ Str::words($item->name,20) }}</a>
                                            </div>
                                            <div class="mobile-cart-unit-price">
                                                {{ config('settings.currency_symbol')}} {{$item->price}} / Unit
                                            </div>                                
                                        </div>
                                        <div class="col-3 col-md-3 no-padding-left">
                                            <div class="mobile-cart-product-item-total">
                                            {{ config('settings.currency_symbol')}} <span id="cart-product-total-price-{{$item->id}}">{{$item->getPriceSum()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($item->attributes->user == 1)
                                        <div class="mobile-cart-image-alert">**This image is a refference for the design selected and not of the final product.</div>
                                    @endif
                                    <div class="pdc-border"></div>
                                </div>
                                
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h3 class="shoping-checkboxt-title">Shipping Details</h3>
                        <div class="spc-shpd-cover">
                            <div class="your-order-wrapper">
                                <div class="your-order-wrap">
                                    <div class="spc-shpd-item-wrap">
                                        <div class="spc-shpd-item-cover">
                                            <div class="spc-shpd-item-head">
                                                <div class="spc-shpd-item-title">Shipping Address</div>
                                            </div>

                                            @if($shipping_address != NULL)
                                            <div class="spc-shpd-item-body" id="spc-shipping-address-body">
                                                <div class="shpd-add-name">{{$shipping_address->name}}</div>
                                                <div class="shpd-add-add">{{$shipping_address->address}}, {{$shipping_address->city}}, {{$shipping_address->postcode}}, {{$shipping_address->zone->country->name}}.</div>
                                            </div>
                                            <div class="spc-shpd-edit-link"><a href="2" class="spc-add-edit-a">Edit</a> </div>
                                            @else
                                            <div class="spc-add-address-cover"><div class="spc-shpd-edit-link"><a href="2" class="spc-add-address">Add Shipping Address</a></div></div>
                                            @endif
                                        </div>
                                        <a href="2" class="spc-add-edit-a">Edit</a>
                                        <div class="spc-shpd-item-cover">
                                            <div class="spc-shpd-item-head">
                                                <div class="spc-shpd-item-title">Billing Address</div>
                                            </div>
                                            @if($billing_address != NULL)
                                            <div class="spc-shpd-item-body" id="spc-billing-address-body">
                                                <div class="shpd-add-name">{{$billing_address->name}}</div>
                                                <div class="shpd-add-add">{{$billing_address->address}}, {{$billing_address->city}}, {{$billing_address->postcode}}, {{$billing_address->zone->country->name}}.</div>
                                            </div>
                                            <div class="spc-shpd-edit-link"><a href="1" class="spc-add-edit-a">Edit</a></div>
                                             @else
                                            <div class="spc-add-address-cover"><div class="spc-shpd-edit-link"><a href="1" class="spc-add-address">Add Billing Address</a></div></div>
                                            @endif
                                        </div>
                                        <div class="spc-shpd-item-cover">
                                            <div class="spc-shpd-item-head">
                                                <div class="spc-shpd-item-title">Order Summary</div>
                                            </div>
                                            <div class="spc-shpd-item-body">
                                                <div class="shpd-ods-cover">
                                                    <div class="shpd-ods-item">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-title">Subtotal <span> ( {{ \Cart::getTotalQuantity() }} items)</span></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-price">{{ config('settings.currency_symbol') }} {{ \Cart::getSubTotal() }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shpd-ods-item">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-title">Shipping Fee <span></span></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-price">22.00 MYR</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="spc-shpd-ods-border"></div>
                                                     <div class="shpd-ods-item shpd-ods-item-total">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-title">Total <span></span></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="spc-shpd-ods-price spc-shpd-ods-price-total">{{ config('settings.currency_symbol') }} {{ \Cart::getTotal() }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- your-order-wrap end -->
                                    <div class="payment-method">
                                        <div class="payment-accordion">
                                            <!-- ACCORDION START -->
                                            <h3>PayPal <img src="/front/assets/images/icon/4.png" alt="" /></h3>
                                            <div class="payment-content">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                            <!-- ACCORDION END -->                                  
                                        </div>
                                        <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                                            @csrf
                                            <div class="fomt-hidden-input">
                                                <input type ="hidden" name="billing_address" id="form_billing_address" value="@if($billing_address != NULL){{$billing_address->id}} @endif">
                                                <input type ="hidden" name="shipping_address" id="form_shipping_address" value="@if($shipping_address != NULL) {{$shipping_address->id}} @endif">
                                            </div>
                                            <div class="order-button-payment">
                                                <input type="submit" value="Place order" />
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
    <!-- content-wraper end -->
    @include('front.modals.change-address-modal')
    @include('front.modals.add-address-modal')
@endsection
@section('script')
    <script type="text/javascript">
        var billing_address  = @if($billing_address != NULL){!! json_encode($billing_address->id) !!} @endif;
        var shipping_name  = @if($shipping_address != NULL) {!! json_encode($shipping_address->id) !!} @endif;
    </script>
    <script type="text/javascript" src="/front/code/js/eCommerce/checkout.js"></script>
@endsection
