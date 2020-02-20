@extends('front.layout')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Design</a></li>
                        <li class="breadcrumb-item active">Shirts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
     <!-- content-wraper start -->
    <div class="content-wraper pb--70">
        <div class="mobile-container">
            @include('front.flash.loginMessage')
            <div class="mobile-content-cover">
                <div class="fabric-listing-title">1. SELECT FABRIC</div>
                <div class="instruction-content custom-design-instruction">
                    <p><b>Supreme Sifu</b> brings you a unique opportunity to design your custom shirt. You can start designing your custom shirt by following the  <a href="/design-guides">Surpeme Sifu Design Guides</a>. </p>
                    <p>Keeping the design process simple, we let you start by picking the best fabric for your next custom tailored shirt. You may <b>choose from the fabric classes</b> below to get the fabric that best suits your taste and budget.</p>
                </div>
                <div id="mobile-load-class" class="row">
                     @foreach($classes as $class)
                        <div class="col-6 col-md-3">
                            <a href="/custom-shirt/fabric/{{$class->id}}/list">
                            <div class="class-item">
                                <div class="class-item-image">
                                    <img src="/images/product/fabric/{{$class->image}}" alt="{{$class->name}}">
                                </div>
                                <div class="class-item-content">
                                    <div class="class-item-name">{{$class->name}}</div>
                                    <div class="class-item-price">{{$class->price}}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div id="nextButtonCover">
                    <a href="#" id="saveFabric" class="mob-next-button">Next <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('front.modals.class-compare')
    @include('front.modals.load-fabric-details')
@endsection