@extends('front.layout')
@section('header')
    <link rel="stylesheet" href="/front/assets/css/homePage.css">
@endsection
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
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two pb--40 text-center">
                        <h2>Men's <b>Dress Shirt</b> Collection</h2>
                        <div class="head-underline"></div>
                    </div>
                </div>
            </div>
            <div class="sps-home-product-cover">
            <div class="row pb--100">
                    @foreach($products as $product)
                    <div class="col-md-3 col-6">
                        <div class="sps-home-prd-cover">
                            <div class="sps-home-prd-item-image">
                                <a href="{{$product->slug}}">
                                    <img src="{{$product->primary_image}}" alt="{{$product->primary_image}}">
                                </a>
                            </div>
                            <div class="sps-home-prd-item-body">
                                <div class="sps-home-prd-item-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="sps-home-prd-item-head"><a href="{{$product->slug}}">{{$product->name}}</a></div>
                                <div class="sps-home-prd-item-price">{!! $product->price !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection
