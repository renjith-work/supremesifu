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
        <div id="login-check-message" class="hide_content">
            <div style="padding: 5px;">
                <div class="alert alert-sifu alert-dismissible" role="alert">
                    <div class="login-message-body-sps">
                        <b><i class="fa fa-exclamation-triangle"></i> WARNING!! - </b> You must be <a href="/login">logged in</a> to continue creating a custom shirt design. If you dont have an account please <a href="/register">Register</a> here.
                        <button class="close" type="button" data-dismiss="alert">×</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="shirt-page-cover">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-5">
                   <!-- Product Details Left -->
                    <div class="product-details-left ssifu-sticky-top">
                        <div class="product-details-images slider-lg-image-1" id="product_detail_images">
                        @foreach ($design->images as $image)
                            @if($image->position_id == 1) 
                                <div class="lg-image"><a href="/images/product/design/{{$image->name}}" class="img-poppu"><img src="/images/product/design/{{$image->name}}" alt="{{$image->name}}"></a></div>
                            @elseif ($image->position_id == 2)
                                <div class="lg-image"><a href="/images/product/design/{{$image->name}}" class="img-poppu"><img src="/images/product/design/{{$image->name}}" alt="{{$image->name}}"></a></div>
                            @else
                                <div class="lg-image"><a href="/images/product/design/{{$image->name}}" class="img-poppu"><img src="/images/product/design/{{$image->name}}" alt="{{$image->name}}"></a></div>
                            @endif
                        @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1" id="product_detail_thumbs">
                            @foreach ($design->images as $image)
                            @if($image->position_id == 1) 
                                <div class="sm-image"><img src="/images/product/design/{{$image->name}}" alt="product image thumb"></div>
                            @elseif ($image->position_id == 2)
                                <div class="sm-image"><img src="/images/product/design/{{$image->name}}" alt="product image thumb"></div>
                            @else
                                <div class="sm-image"><img src="/images/product/design/{{$image->name}}" alt="product image thumb"></div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <!--// Product Details Left -->

                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="shirt-content-cover">
                    <div class="shirt-content-title" id="product_detail_title">{{$product->name}}</div>
                        <div class="shirt-content-price">
                        <div class="product_price" id="product_price">@if(isset($productPrice->price)) MYR {{$productPrice->price}} @endif</div>
                            <div class="product_og_price" id="product_og_price">@if(isset($productPrice->old_price)) MYR {{$productPrice->old_price}} @endif</div>
                            <br>
                            <div class="pd-btn-instr">**The displayed image is not of the final product but a representation of the design of the product.</div>
                        </div>
                        
                        <div class="product-detail-section">
                            <div class="product-details-section-head">FABRIC DETAILS</div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="fabric-details-body" id="fabric_details_body">
                                        <div class="row fabric-detail-item">
                                            <div class="col-md-5 fabric-detail-head">Name</div>
                                            <div class="col-md-7 fabric-detail-body">{{$product->fabric->name}}</div>
                                        </div>
                                        <div class="row fabric-detail-item">
                                            <div class="col-md-5 fabric-detail-head">Class</div>
                                            <div class="col-md-7 fabric-detail-body">{{$product->fabric->class->name}}</div>
                                        </div>
                                        @foreach($product->fabric->fabricAttributeValues as $attributeValue)
                                        <div class="row fabric-detail-item">
                                        <div class="col-md-5 fabric-detail-head">{{$attributeValue->fabricAttribute->name}}</div>
                                            <div class="col-md-7 fabric-detail-body">{{$attributeValue->value}}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <div class="product-detail-fabric-image" id="product_detail_fabric_image">
                                    <img src="/images/product/fabric/{{$product->fabric->image}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-change-fabric">
                                <div class="row">
                                    <div class="col-md-6">
                                        <btn class="btn btn-lg pd-btn" id="loadFabricButton">CHANGE FABRIC</btn>  
                                    </div>
                                </div>
                                <div class="pd-btn-instr">**Any change in the class of the fabric will reflect in the pricing of the product.</div>
                            </div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">MONOGRAMS</div>
                            <div class="row" id="monogram_cover">
                                @foreach($monograms as $monogram)
                                <div class="col-md-6">
                                    <div class="monogram-item">
                                        <div class="measurement-head">
                                            <div class="modal-input-label">{{$monogram->name}} </div> 
                                            <div class="modal-input-instruction">
                                            <a href="{{$monogram->tutorial_id}}" class="mt-link"><span>instruction</span> <i class="fa fa-info-circle"></i></a>
                                            </div>
                                        </div>
                                        <div class="monogram-body mt--5">
                                        <input type="text" id="{{$monogram->code}}" name="{{$monogram->code}}" class="monogram-input" placeholder="Maximum Of {{$monogram->letter}} Letters" value="{{$monogram->value}}">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">POCKETS</div>
                            <div class="row pocket-counter-cover" id="design_pocket">
                                @foreach($shirtPockets as $pocket)
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="shirt-pocket" id="pocket_{{$pocket->id}}" value="{{$pocket->id}}" checked="checked">
                                        <label class="form-check-label">{{$pocket->value}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product-detail-section">
                            <div class="product-details-section-head">MEASUREMENTS</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="measurement-head">
                                        Select a size that best fits you -
                                    </div>
                                    <div class="measurement-body">
                                        <select name="measurement_profile" id="measureProfile" >
                                            @if(!empty($defaultMeasurementProfile))
                                            <option selected="true" disabled="disabled">Standard Measurement Profiles</option>
                                            @foreach($defaultMeasurementProfile as $profile)
                                            <option value="{{$profile->id}}" @if($profile->id == $productMeasurementProfile) selected @endif>{{$profile->name}}</option>
                                            @endforeach
                                            @endif
                                            @if(!empty($userMeasurementProfile))
                                            <option selected="true" disabled="disabled">User saved Profiles</option>
                                            @foreach($userMeasurementProfile as $profile)
                                            <option value="{{$profile->id}}" @if($profile->id == $productMeasurementProfile) selected @endif>{{$profile->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="measurement-set-cover pt--20 pb--20">
                                <div class="row" id="measurement_attribute_cover">
                                    @foreach($productMeasurements as $measurement)
                                        @if($measurement->category == 1)
                                        <div class="col-6 col-md-6">
                                            <div class="measurement-head">
                                                <div class="modal-input-label">{{$measurement->name}}</div> 
                                                <div class="modal-input-instruction">
                                                    <a href="{{$measurement->tutorial_id}}" class="mt-link"><span>instruction</span> <i class="fa fa-info-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="measurement-body">
                                            <input type="number" name="{{$measurement->code}}" id="{{$measurement->code}}" step="any" class="measurement-input" placeholder="..inches" value="{{$measurement->value}}">
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="direct-measure-cover">
                                    <div class="pt--40 pb--30">
                                        <p>For a better finish for you shirt, you can also provide measurement from your favorite shirt that fits you perfectly. </p>
                                    </div>
                                    <div class="row" id="measurement_ddattribute_cover" class="">
                                        @foreach($productMeasurements as $measurement)
                                            @if($measurement->category == 2)
                                                <div class="col-6 col-md-6">
                                                    <div class="measurement-head">
                                                        <div class="modal-input-label">{{$measurement->name}}</div> 
                                                        <div class="modal-input-instruction">
                                                            <a href="{{$measurement->tutorial_id}}" class="mt-link"><span>instruction</span> <i class="fa fa-info-circle"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="measurement-body">
                                                    <input type="number" name="{{$measurement->code}}" id="{{$measurement->code}}" step="any" class="measurement-input" placeholder="..inches" value="{{$measurement->value}}">
                                                    </div>
                                                </div>
                                            @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="row pt--20 pb--20">
                            <div class="col-md-6">
                                <div class="measurement-head">SELECT QUANTITY</div>
                                <div class="measurement-body">
                                    <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" id="quantity" value="{{$quantity}}" type="text">
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
                                <div id="measurement-error-instruction" class="custom-sp-error-messages hide_content">
                                    The measurement fields cannot be left empty. Please select a measurement proifle or enter custom measurements.
                                </div>
                                <div id="login-error-instruction" class="custom-sp-error-messages hide_content">
                                    You have to be logged in to proceede further. Please <a href="/login">Login Here</a> and design your shirt.
                                </div>
                            </div>
                        </div>
                        <div class="row shirt-content-place-order-cover pt--20">   
                            <div class="col-md-12">
                                <a id="addToCart" href="#" class="dress-content-place-order">UPDATE CART</a>
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
    // var product_id  = {!!json_encode($product->id)!!};
    var product_attr_set_id  = {!!json_encode($product->product_attribute_set_id)!!};
    var currentProduct_id = {!!json_encode($product->id)!!};
    var currentProduct_fabric_id  = {!!json_encode($product->fabric->id)!!};
    var currentProduct_price  = {!!json_encode($productPrice->price)!!};
    var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
</script>
{{--     var mp_name  = {!!json_encode($product->umprofile->name)!!};
    var product_design_name  = {!!json_encode($product->design->name)!!}; --}}
<script type="text/javascript" src="/front/code/js/shirt/shirtDetailEdit.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection