@extends('front.layout')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout Page</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <!-- checkout-details-wrapper start -->
            @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <div class="checkout-details-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <!-- billing-details-wrap start -->
                        <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                        @csrf
                        <div class="billing-details-wrap">
                                <h3 class="shoping-checkboxt-title">Billing Details</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>First name</label>
                                            <input type="text" class="form-control" name="first_name">
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>Last name</label>
                                            <input type="text" class="form-control" name="last_name">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address">
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Country</label>
                                        <div class="nice-select wide">
                                            <select class="form-control" name="country">
                                                <option value="Malaysia" selected="true">Malaysia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12"><div class="address-form-devider"></div></div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Postcode / ZIP <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="post_code">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone_number">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Order Notes</label>
                                            <textarea class="form-control" name="notes" rows="6"></textarea>
                                        </p>
                                    </div>
                                </div>
                            
                        </div>
                        <!-- billing-details-wrap end -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- your-order-wrapper start -->
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Your Order</h3>
                            <!-- your-order-wrap start-->
                            <div class="your-order-wrap">
                                <!-- your-order-table start -->
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>                           
                                        </thead>
                                        <tbody>
                                            @foreach(\Cart::getContent() as $item)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ Str::words($item->name,20) }} <strong class="product-quantity"> × {{ $item->quantity }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">{{ config('settings.currency_symbol')}} {{$item->getPriceSum()}}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }}</span></td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Shipping</th>
                                                <td>
                                                    Free
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">{{ config('settings.currency_symbol') }}{{ \Cart::getTotal() }}</span></strong>
                                                </td>
                                            </tr>                               
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- your-order-table end -->
                                
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
                                    <div class="order-button-payment">
                                        <input type="submit" value="Place order" />
                                    </div>
                                </div>
                                <!-- your-order-wrapper start -->
                                
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- checkout-details-wrapper end -->
        </div>
    </div>
    <!-- content-wraper end -->
@endsection