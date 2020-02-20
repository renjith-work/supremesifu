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
                <div class="fabric-listing-title">3. SIZE YOURSELF</div>
                <div class="measurement-cover pt--50">
                    <div class="measurement-item-cover">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="instruction-content pt--10 pb--40">
                                    <p>You can either select from the following standard options for your measurements or measure yourself using our tutorial.  </p>
                                </div>
                                <form action="{{route('custom-shirt.measurements')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$product}}" name="product">
                                <div id="mv_set_cover" class="regular-measure-cover pt--30">
                                    <div class="regular-measurement">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="measurement-head">
                                                    Select a standard size that best fits you -
                                                </div>
                                                <div class="measurement-body">
                                                    <select name="measurement_profile" id="measureProfile" >
                                                        <option>Select Measurement Profile</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mobile-measurement-set-cover pt--20 pb--50">
                                        <div class="row" id="measurement_attribute_cover"></div>
                                        <div class="direct-measure-cover">
                                            <div class="pt--40 pb--30">
                                                <p>For a better finish for you shirt, you can also provide measurement from your favorite shirt that fits you perfectly. </p>
                                            </div>
                                            <div class="row" id="measurement_ddattribute_cover"></div>
                                        </div>
                                    </div>
                                    <div class="measurement-submit-cover">
                                        <input type="submit" value="Submit Measurements" class="mob-next-button">
                                    </div>
                                </div>  
                                </form>                                          
                            </div>
                            <div class="col-md-6" style="margin-bottom: -50px;">
                                <div id="measure-instruction-cover">
                                    <div class="dd-measure-img shirt-page-measure-image pt--10">
                                        <img src="/front/assets/images/ss-shirt/shirt-measurement.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('front.modals.class-compare')
    @include('front.modals.load-design')
@endsection
@section('script')
    <script type="text/javascript" src="/front/code/js/shirt/selectMeasurement.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
@endsection