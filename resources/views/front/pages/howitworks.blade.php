@extends('front.layout')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/about-us">About Us</a></li>
                        <li class="breadcrumb-item active">How It Works</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="about-info-wrapper pb--100">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- section-title start -->
                        <div class="section-title about-section-title">
                            <h2>How It <b>Works</b></h2>
                            <p>Its Simple - <b>Custom Clothing</b> Made <b>Easy</b> and <b>Affordable</b></p>
                        </div>
                        <!-- section-title end -->
                    </div>
                </div>
                <div class="how-item-cover">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="how-item-image">
                                <img src="/front/assets/images/how/how1.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-1">
                            <div class="how-step">STEP 1 </div>
                            <div class="how-item-title">
                                Choose your style
                            </div>
                            <div class="how-item-body">
                                <p>Use our unique designer tools to select from one of our existing designs to personalize the details of your dress. You can customize your collar, style & color, buttons, button threads, cuff style, adding your own initials(monograms).</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="how-item-cover">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="how-step">STEP 2 </div>
                            <div class="how-item-title">
                                Fabric Selection
                            </div>
                            <div class="how-item-body">
                                <p>The most important decision on designing your custom made garment is selecting the perfect fabric that brings out the best in you. Choose from our fine selection of fabrics and colors. </p>
                                <p>Our suit fabrics include Corduroy, Tweed, Wool, Cotton, Merino Wool, Velvet, and many more.</p>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <div class="how-item-image">
                                <img src="/front/assets/images/how/how2.jpg" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="how-item-cover">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="how-item-image">
                                <img src="/front/assets/images/how/how3.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-7 offset-md-1">
                            <div class="how-step">STEP 3 </div>
                            <div class="how-item-title">
                                Measure Your Self
                            </div>
                            <div class="how-item-body">
                                <p>Supreme Sifu teaches you to measure yourself FAST & EASY. You don’t need a tailor or fitter to make your measurement. Just follow our simple tutorial to measure yourself like a professional .</p>
                                <p>Our tailoring team will cut and sew a one-of-a-kind suit crafted to fit just one person – you! We save you measurement profile in your account so any future orders can be completed quickly and easily without the need for measuring again.  </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- content-wraper end -->
@endsection