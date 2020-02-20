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
    <!-- breadcrumb-area end -->
    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="mobile-container pb--70">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row pb--90">
                <div class="col-12 col-md-8">
                <form action="#" class="cart-table">
                    @if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty.</p>
                    @else
                    <div class="sifu-cart-table-cover">
                        <div class="sifu-cart-table-head">
                            <div class="row">
                                <div class="col-2 ssifu-table-border">
                                    <h3>IMAGE</h3>
                                </div>
                                <div class="col-3 ssifu-table-border">
                                    <h3>PRODUCT</h3>
                                </div>
                                <div class="col-2 ssifu-table-border">
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
                            @foreach(\Cart::getContent() as $item)
                            <div class="row">
                                <div class="col-4 col-md-2">
                                    <div class="product-content-center"><a href="#"><img src="/images/product/design/{{$item->attributes->folder}}/{{$item->attributes->image}}" alt="product image"></a></div>
                                </div>
                                <div class="col-8 col-md-3">
                                    <div class="product-content-left">
                                        <div class="product-content-name"><a href="#">{{ Str::words($item->name,20) }}</a></div>
                                        <div class="product-content-details">
                                            <div class="product-content-details-item row">
                                                <div class="col-4"><span>Price</span></div>
                                                <div class="col-1"><span>-</span></div>
                                                <div class="col-6">{{ config('settings.currency_symbol')}} {{$item->price}}</div>
                                            </div>
                                            <div class="product-content-details-item row">
                                                <div class="col-4"><span>Qty</span></div>
                                                <div class="col-1"><span>-</span></div>
                                                <div class="col-6">{{ $item->quantity }}</div>
                                            </div>
                                            <div class="product-content-details-item row">
                                                <div class="col-4"><span>Total</span></div>
                                                <div class="col-1"><span>-</span></div>
                                                <div class="col-6">{{ config('settings.currency_symbol')}} {{$item->getPriceSum()}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="product-content-center pcd-dktp"><span class="amount">{{ config('settings.currency_symbol')}} {{$item->price}}</span></div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="product-content-center pcd-dktp">{{ $item->quantity }}</div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="product-content-center pcd-dktp"><span class="amount">{{ config('settings.currency_symbol')}} {{$item->getPriceSum()}} </span></div>
                                </div>
                                <div class="col-12 col-md-1">
                                    <div class="product-content-center"><a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn"><i class="fa fa-close"></i> </a></div>
                                </div>
                            </div>
                            <div class="pdc-border"></div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </form>
                </div>
                <aside class="col-sm-4">
                    <div class="ssifu-cart-summary-cover">
                        <h3 class="sifu-summary-title">Cart Total</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal: <br>
                                        <span>Inclusive of all Taxes</span>
                                    </td>
                                    <td>{{ config('settings.currency_symbol') }} {{ \Cart::getSubTotal() }}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>MYR 10</td>
                                </tr>

                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>{{ config('settings.currency_symbol') }} {{ \Cart::getSubTotal() }}</td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                    </div><!-- End .summary -->

                    <a href="/" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                </aside>
            </div>
        </div>
    </div>
@endsection