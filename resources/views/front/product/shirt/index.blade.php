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
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane active">
                                <div class="shop-product-area">
                                    <div class="row">
                                        @foreach($products as $product)
                                        <div class="col-lg-3 col-md-3 col-sm-6 mt--30 mb--70">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap home-spwrap">
                                                <div class="product-image">
                                                    <a href="/product/shirt/{{$product->slug}}"><img src="/images/product/product/{{$product->p_image}}" alt=""></a>
                                                    <span class="label-product label-new">new</span>
                                                    <span class="label-product label-sale">-7%</span>
                                                    <div class="quick_view">
                                                        <a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-content home-sp-pc">
                                                    <h3><a href="/product/shirt/{{$product->slug}}">{{$product->name}}</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">{{$product->price}}</span>
                                                        <span class="old-price">{{$product->og_price}}</span>
                                                    </div>
                                                    <div class="product-action">
                                                        <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to cart</button>
                                                        <div class="star_content">
                                                            <ul class="d-flex">
                                                                <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection
