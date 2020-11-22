@extends('front.layout')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/front/frame/auth/userDashboard.css" rel="stylesheet">
    <link href="/front/frame/auth/userDashboardOrder.css" rel="stylesheet">
@endsection
@section('content')    
    
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="px-account-dashboard">
                        @if(Session::has('success'))
                          <div class="alert alert-success" role="alert">
                            <strong>Success :</strong> {{ Session::get('success') }}
                          </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                               @include('front.user.dashboard_sidebar')
                            </div>
                            <div class="col-md-12 col-lg-9">
                                <!-- Tab panes -->
                                <div class="px-dashboard-content">
                                    <div class="" id="px-dashboard">
                                        <div class="px-dashboard-head-cover">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="ordm-head">Order Details</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="ordm-head-back"><a class="ordm-back-button" href="/user/order-management/{{$product->order}}/details">Back</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="px-customer-dasboard-body">
                                            <div class="shirt-page-cover">
                                                <div class="row single-product-area">
                                                    <div class="col-lg-5 col-md-5">
                                                    <!-- Product Details Left -->
                                                        <div class="product-details-left ssifu-sticky-top">
                                                            <div class="product-details-images slider-lg-image-1" id="product_detail_images">
                                                            @foreach ($product->images as $image)
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
                                                                @foreach ($product->images as $image)
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
                                                            <div class="orm-prd-price">RM {{ (sprintf('%0.2f',$product->price->price))}}</div>
                                                            
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
                                                            </div>
                                                            @if($product->monograms)
                                                            <div class="product-detail-section">
                                                                <div class="product-details-section-head">MONOGRAMS</div>
                                                                @foreach($product->monograms as $monogram)
                                                                    <div class="row monogram_content_cover">
                                                                        <div class="col-md-8">
                                                                            <div class="ord-monogram-head">{{$monogram->name}}</div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="ord-monogram-body">- {{$monogram->value}}</div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                            <div class="product-detail-section">
                                                                <div class="product-details-section-head">MEASUREMENTS</div>

                                                                <div class="ordm-measurements-cover">
                                                                    @foreach($product->measurements as $measurement)
                                                                        <div class="row ordm-measurement-item">
                                                                            <div class="col-md-7">
                                                                                <div class="ordm-meas-head">{{$measurement->name}}</div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="ordm-meas-value"><span> - </span>{{$measurement->value}}</div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection