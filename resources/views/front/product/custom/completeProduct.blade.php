@extends('front.layout')
@section('header')
    <link href="/front/frame/auth/loginRegister.css" rel="stylesheet">
@endsection
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/custom-shirt/fabric/class">Custom Shirts</a></li>
                    <li class="breadcrumb-item active"><a href="#">Product Created</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->
<div class="container">
    <div class="px-main-content-cover">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="px-auth-box-cover">
                    <div class="px-auth-box-head">
                        <div class="px-auth-box-head-title">PRODUCT CREATED</div>
                    </div>
                    <div class="px-auth-box-body">
                        <div class="product-message-cover">
                            <h3>Congratulations!</h3>
                            <div class="product-message-text-cover">
                                <p>
                                    You have successfully created a shirt with the <span><a href="#">Supreme Sifu Smart Dresser Tool</a></span>.<br>
                                    We have added the product to the cart. You may view and edit the product from the <a href="/cart">cart</a>. 
                                </p>
                                <div id="product-message-save-name-cover">
                                    @if($measurementResponse > 0)
                                    <p>
                                        We have noticed that you have measured yourself for a perfect fitting shirt. You can save this measurement to your profile and use it again in the future. <br>
                                        <span><a href="#saveMsModal" data-toggle="modal" data-target="#saveMsModal">Save this measurement.</a></span>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row product-message-footer">
                            <div class="col-md-4">
                                <a href="/cart">Go to Cart</a>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <a href="/">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.modals.save-ms-profile')
@endsection
@section('script')
<script type="text/javascript" src="/front/code/js/shirt/saveMsProfile.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection