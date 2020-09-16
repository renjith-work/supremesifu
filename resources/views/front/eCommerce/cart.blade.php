@extends('front.layout')
@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-container">
        <div class="cart-spsifu-content-cover pb--100">
        <div class="row">
            <div class="col-md-8">
                @if (\Cart::isEmpty())
                    <p class="alert alert-warning">Your shopping cart is empty.</p>
                @else
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
                                <div class="col-3 ssifu-table-border">
                                    <h3>PRODUCT</h3>
                                </div>
                                <div class="col-1 ssifu-table-border">
                                    <h3>PRICE</h3>
                                </div>
                                <div class="col-2 ssifu-table-border">
                                    <h3>QTY</h3>
                                </div>
                                <div class="col-2 ssifu-table-border bd-right-non">
                                    <h3>TOTAL</h3>
                                </div>
                                <div class="col-1 ssifu-table-border bd-left-non">
                                    {{-- <h3>REMOVE</h3> --}}
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
                                <div class="col-3 col-md-3 scol-right-border">
                                    <div class="product-content-left">
                                        <div class="product-content-name"><a href="/cart/product/{{$item->id}}/edit/qty/{{ $item->quantity }}">{{ Str::words($item->name,20) }}</a></div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-1 scol-right-border">
                                    <div class="product-content-center pcd-dktp wd-cart-margin"><span class="amount">{{ config('settings.currency_symbol')}} {{$item->price}}</span></div>
                                </div>
                                <div class="col-4 col-md-2 scol-right-border">
                                    <div class="cart-mobile-quantity-cover">
                                        <div class="wd-qty-cover">
                                            <button class="wide-cart-qty-button wd-c-dec mobile-qty-decrease">-</button>
                                            <input class="cart-qty-input-value" id="{{ $item->id }}" value="{{ $item->quantity }}" type="text">
                                            <button class="wide-cart-qty-button wd-c-inc mobile-qty-increase">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2 scol-right-border">
                                    <div class="product-content-center pcd-dktp wd-cart-margin"><span class="amount">{{ config('settings.currency_symbol')}} {{$item->getPriceSum()}} </span></div>
                                </div>
                                <div class="col-12 col-md-1">
                                    <div class="wd-cart-cancel"><a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn"><i class="fa fa-close"></i> </a></div>
                                </div>
                            </div>
                            @if($item->attributes->user != 1)
                                    <div class="cart-image-alert">**This image is a refference for the design selected and not the actual product.</div>
                                @endif
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
                                    <div class="cart-mobile-quantity-cover">
                                        <button class="mobile-cart-qty-button mobile-qty-increase"><i class="fa fa-angle-up"></i></button>
                                        <input class="cart-qty-input-value" id="{{ $item->id }}" value="{{ $item->quantity }}" type="text">
                                        <button class="mobile-cart-qty-button mobile-qty-decrease"><i class="fa fa-angle-down"></i></button>
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
                @endif
            </div>
            <div class="col-md-4">
                <div class="ssifu-cart-summary-cover">
                    <h3 class="sifu-summary-title">Cart Total</h3><!-- End .summary-title -->
                    <table class="table table-summary">
                        <tbody>
                            <tr class="summary-subtotal">
                                <td>Subtotal: <br>
                                    <span>Inclusive of all Taxes</span>
                                </td>
                                <td>{{ config('settings.currency_symbol') }} <span id="cartSubTotal">{{ \Cart::getSubTotal() }}</span></td>
                            </tr><!-- End .summary-subtotal -->
                            {{-- <tr class="summary-shipping">
                                <td>Shipping:</td>
                                <td>MYR 10</td>
                            </tr> --}}

                            <tr class="summary-total">
                                <td>Total:</td>
                                <td>{{ config('settings.currency_symbol') }} <span id="cartTotal">{{ \Cart::getSubTotal() }}</span></td>
                            </tr><!-- End .summary-total -->
                        </tbody>
                    </table><!-- End .table table-summary -->
                    <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                </div><!-- End .summary -->
            </div>
        </div>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript" src="/front/code/js/eCommerce/cart.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection