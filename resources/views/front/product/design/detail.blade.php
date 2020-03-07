@extends('front.layout')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/shirts">Shirts</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->
<!-- content-wraper start -->
<div class="content-wraper pb--70">
    <div class="mobile-container">
        <div class="shirt-page-cover">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-5">
                   <!-- Product Details Left -->
                    <div class="product-details-left ssifu-sticky-top">
                        <div class="product-details-images slider-lg-image-1" id="product_detail_images"></div>
                        <div class="product-details-thumbs slider-thumbs-1" id="product_detail_thumbs"></div>
                    </div>
                    <!--// Product Details Left -->

                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="shirt-content-cover">
                        <div class="shirt-content-title" id="product_detail_title"></div>
                        <div class="shirt-content-price">
                            <div class="product_price" id="product_price"></div>
                            <div class="product_og_price" id="product_og_price"></div>
                            <br>
                        </div>
                        
                        <div class="product-detail-section">
                            <div class="product-details-section-head">FABRIC DETAILS</div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="fabric-details-body" id="fabric_details_body"></div>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <div class="product-detail-fabric-image" id="product_detail_fabric_image"></div>
                                </div>
                            </div>
                            <div class="product-detail-change-fabric">
                                <div class="row">
                                    <div class="col-md-6">
                                        <btn class="btn btn-lg pd-btn" id="loadFabricButton">CHANGE FABRIC</btn>  
                                    </div>
                                </div>
                                <div class="pd-btn-instr">Any change in the class of the fabric will reflect in the pricing of the product.</div>
                            </div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">MONOGRAMS</div>
                            <div class="row" id="monogram_cover"></div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">POCKETS</div>
                            <div class="row pocket-counter-cover" id="design_pocket"></div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">MEASUREMENTS</div>
                            <div class="measurement-save-cover alert alert-success"" id="measurement-save-cover">
                                <b>Congrats !!!</b>  You have measured yourself for a perfect fit.<br>
                                Would you like to <a id="ldSMeasurement" href="">save this measurement</a> for future refference. 
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="measurement-head">
                                        Select a size that best fits you -
                                    </div>
                                    <div class="measurement-body">
                                        <select name="measurement_profile" id="measureProfile" >
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="measurement-set-cover pt--20 pb--20">
                                <div class="row" id="measurement_attribute_cover"></div>
                                <div class="direct-measure-cover">
                                    <div class="pt--40 pb--30">
                                        <p>For a better finish for you shirt, you can also provide measurement from your favorite shirt that fits you perfectly. </p>
                                    </div>
                                    <div class="row" id="measurement_ddattribute_cover" class=""></div>
                                </div>
                            </div>
                        </div>  
                        <div class="row pt--20 pb--20">
                            <div class="col-md-6">
                                <div class="measurement-head">SELECT QUANTITY</div>
                                <div class="measurement-body">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" id="quantity" value="1" type="text">
                                        <div class="quantity-cover">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="measurement-error-instruction" class="hide_content">
                                    The measurement fields cannot be left empty. Please select a measurement proifle or enter custom measurements.
                                </div>
                            </div>
                        </div>
                        <div class="row shirt-content-place-order-cover pt--20">   
                            <div class="col-md-6">
                                <a id="confirmOrder" href="#" class="dress-content-place-order">BUY NOW</a>
                            </div>
                            <div class="col-md-6">
                                <a id="addToCart" href="#" class="dress-content-place-order">ADD To CART</a>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.modals.load-tutorial')
@include('front.modals.load-fabric')
@include('front.modals.save-measurement-profile')
@include('front.modals.add-to-cart')
@endsection
@section('script')
<script type="text/javascript">
    var fabric_id  = {!!json_encode($product->fabric->id)!!};
    var product_id  = {!!json_encode($product->id)!!};
    var product_name  = {!!json_encode($product->name)!!};
    var product_price = {!!json_encode($product->price)!!};
    var measurement_id  = {!!json_encode($product->u_mp_id)!!};
</script>
{{--     var mp_name  = {!!json_encode($product->umprofile->name)!!};
    var product_design_name  = {!!json_encode($product->design->name)!!}; --}}
<script type="text/javascript" src="/front/code/js/productDetail.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection