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
            <div class="mobile-content-cover">
                <div class="fabric-listing-title">1. SELECT FABRIC</div>
                <div class="instruction-content custom-design-instruction">
                    <p>Start building your <b>Supreme Sifu</b> custom shirt by selecting from our collection of fabrics. The color of the fabric may be slightly different from what you see because of the difference in screen resolutions and brightness. The price of the finished product depends on the price of the fabric you have selected.</p>
                </div>
                {{-- <div id="load-class-dropdown">
                    <div class="measurement-body">
                        <select id="classSelect" name="classSelect" class="col-12 col-md-6">
                            <option value="">Select Class</option>
                        </select>
                    </div>
                </div> --}}
                <div id="mobile-load-class" class="row">
                    @foreach($fabrics as $fabric)
                        <div class="col-md-3"> 
                            <a href="{{$fabric->id}}" class="load-fabric-modal"> 
                                <div class="single-fabric-cover"> 
                                    <div class="single-fabric-image">
                                        <img src="/images/product/fabric/{{$fabric->image}}" alt="{{$fabric->name}}"> 
                                    </div>
                                    <div class="single-fabric-content"> 
                                        <div class="single-fabric-name">{{$fabric->name}}</div>
                                        <div class="single-fabric-price">
                                            MYR {{$fabric->price->price}}/Shirt 
                                            @if($fabric->price->old_price != null)
                                            <span>MYR {{$fabric->price->old_price}}</span>
                                            @endif
                                        </div>
                                        <div class="single-fabric-details">
                                            
                                            @foreach($fabric->attributes as $attribute)
                                                {{$attribute }},
                                            @endforeach
                                        </div>
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
@section('script')
    <script type="text/javascript">
        var class_id  = {!! json_encode($class->id) !!};
        var class_name  = {!! json_encode($class->name) !!};
    </script>
    <script type="text/javascript" src="/front/code/js/shirt/selectFabric.js"></script>
@endsection