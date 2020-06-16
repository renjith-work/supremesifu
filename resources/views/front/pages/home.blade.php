@extends('front.layout')
@section('header')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endsection
@section('content')
    <!-- Hero Slider start -->
    <div class="hero-slider-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="hero-slider hero-slider-one">
                        <div class="single-slide" style="background-image: url(/front/assets/images/slider/slider-3.jpg)">
                            <!-- Hero Content One Start -->
                            <div class="hero-content-one container">
                                <div class="row">
                                    <div class="col"> 
                                        
                                        <div class="slider-text-info text-black">
                                            <h1>NO MORE <b>EXCUSES</b> </h1>
                                            <h2>SAY <b>GOODBYE</b> TO <b>STANDARD SIZES</b> FOREVER</h2>
                                            <p>Stop wearing shirts designed for hangers and mannequins. <br> Design and wear shirts that fit your personality, your emotions and your body perfectly.</p>
                                            <a href="/custom-shirt/fabric/class" class="btn slider-btn uppercase"><span><i class="fa fa-plus"></i> START DESIGNING</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hero Content One End -->
                        </div>
                        <div class="single-slide" style="background-image: url(/front/assets/images/slider/slider-2.jpg)">
                            <!-- Hero Content One Start -->
                            <div class="hero-content-one container">
                                <div class="row">
                                    <div class="col"> 
                                        <div class="slider-text-info text-black">
                                            <h1 class="white-text"><b>Aggrandizing</b> Traditional tailoring.</h1>
                                            <p class="white-text">Combining expert craftsmanship with advanced machine learning concepts, we bring to you a powerful yet simple system to help you design your custom clothing.</p>
                                            <a href="/custom-shirt/fabric/class" class="btn slider-btn uppercase white-btn"><span><i class="fa fa-plus"></i> START DESIGNING</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hero Content One End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Slider end -->
    
    <div class="slider-bottom-inner">
        <!-- Banner area start -->
        <div class="banner-area ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-area-inner-tp">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="/custom-shirt/fabric/class"><img src="/front/assets/images/banner/b1.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="/custom-shirt/fabric/class"><img src="/front/assets/images/banner/b2.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="/custom-shirt/fabric/class"><img src="/front/assets/images/banner/b3.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner area end -->
    </div>
    <div class="product-area section-pb-20 home-mob-step">
        <div class="top-container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title-two pb--50 pt--60 text-center">
                        <h3>The <b>three step design</b> process</h3>
                        <div class="head-underline"></div>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper">
                <div class="row variable-width home-step-cover">
                    <div>
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap home-mob-stepWrap">
                            <div class="product-image">
                                <img src="/front/assets/images/how/fabric.jpg" alt="">
                                <span class="label-product label-new">STEP 1</span>
                            </div>
                            <div class="product-content h-mob-stepc">
                                <h3><span>SELECT FABRIC</span></h3>
                                <div class="h-step-content">Choose from our collection of finest fabrics that fits your budget.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap home-mob-stepWrap">
                            <div class="product-image">
                                <img src="/front/assets/images/how/customize.jpg" alt="">
                                <span class="label-product label-new">STEP 2</span>
                            </div>
                            <div class="product-content h-mob-stepc">
                                <h3><span>CUSTOMIZE STYLE</span></h3>
                                <div class="h-step-content">Customize your dress by selecting from a variety of styles.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap home-mob-stepWrap">
                            <div class="product-image">
                                <img src="/front/assets/images/how/measure.jpg" alt="">
                                <span class="label-product label-new">STEP 3</span>
                            </div>
                            <div class="product-content h-mob-stepc">
                                <h3><span>SIZE ME</span></h3>
                                <div class="h-step-content">Follow our simple tutorial to measure yourself.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
    <div class="home-dstep-cover pt--50 pb--50">
        <div class="container">
            <div class="home-step-content">
                <div class="section-title-two pb--70 pt--100 text-center">
                    <h2>The <b>three step design</b> process</h2>
                    <div class="head-underline"></div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-4">
                        <div class="home-step-item">
                            <div class="home-step-item-background">
                                <div class="home-step-item-image"><img src="/front/assets/images/how/fabric.jpg" alt=""></div>
                                <div class="home-step-item-number">01.</div>
                                <div class="home-step-item-content">
                                    <div class="home-step-item-title">Select Fabric </div>
                                    <div class="home-step-vline"></div>
                                    <div class="home-step-item-text">Choose from our collection of finest fabrics that fits your budget.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-step-item">
                            <div class="home-step-item-background">
                                <div class="home-step-item-image"><img src="/front/assets/images/how/customize.jpg" alt=""></div>
                                <div class="home-step-item-number">02.</div>
                                <div class="home-step-item-content">
                                    <div class="home-step-item-title">Choose Style </div>
                                    <div class="home-step-vline"></div>
                                    <div class="home-step-item-text">Customize your dress by selecting from a variety of styles.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-step-item">
                            <div class="home-step-item-background">
                                <div class="home-step-item-image"><img src="/front/assets/images/how/measure.jpg" alt=""></div>
                                <div class="home-step-item-number">03.</div>
                                <div class="home-step-item-content">
                                    <div class="home-step-item-title">Size Me </div>
                                    <div class="home-step-vline"></div>
                                    <div class="home-step-item-text">Follow our simple tutorial to measure yourself.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End -->
    <div class="product-area section-pb-20 home-mob-designs">
        <div class="top-container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title-two pb--50 pt--60 text-center">
                        <h3>Men's <b>Dress Shirt</b> Collection</h3>
                        <div class="head-underline"></div>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="product-wrapper">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3 col-6">
                        <div class="single-product-wrap ss-p-wrap">
                            <div class="product-image">
                                <a href="/product/shirt/{{$product->id}}/details">
                                    @foreach($product->images as $image) @if($image->position_id == 1)
                                    <img src="/images/product/product/{{$image->name}}" alt="{{$image->name}}">
                                    @endif @endforeach
                                </a>
                                <span class="label-product label-new">new</span>
                            </div>
                            <div class="product-content">
                                <h3><a href="/product/shirt/{{$product->id}}/details">{{$product->name}}</a></h3>
                                <div class="home-price-box">
                                    <span class="new-price">{{$product->price->price}}</span>
                                    <span class="old-price">{{$product->og_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>    
                    @endforeach                                    
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area Start -->
    <div class="product-area home-section-design section-pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two pb--40 pt--100 text-center">
                        <h2>Men's <b>Dress Shirt</b> Collection</h2>
                        <div class="head-underline"></div>
                    </div>
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper pt--30">
                <div class="row product-slider">
                    @foreach($products as $product)
                    <div class="col-md-3 col-6">
                        <div class="single-product-wrap home-spwrap">
                            <div class="product-image">
                                <a href="/product/shirt/{{$product->slug}}">
                                    @foreach($product->images as $image) @if($image->position_id == 1)
                                    <img src="/images/product/product/{{$image->name}}" alt="{{$image->name}}">
                                    @endif @endforeach
                                </a>
                                <span class="label-product label-new">new</span>
                            </div>
                            <div class="product-content home-sp-pc">
                                <h3 class="home-sp-h3"><a href="/product/shirt/{{$product->slug}}">{{$product->name}}</a></h3>
                                <div class="home-price-box">
                                    <span class="new-price">{{$product->price->price}}</span>
                                    {{-- <span class="old-price">{{$product->og_price}}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                    
                </div>
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
    <!-- Product Area End -->
        <!-- Product Area Start -->

{{--     <div class="home-promotion-cover">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="promotion-content">
                        <h1 class="promotion-head">Custom Men's <b>Suit</b></h1>
                        <h2 class="promotion-sub-head">DESIGNED BY YOU & MADE TO MEASURE</h2>
                        <div class="home-promotion-price">
                            <span>&nbsp;RM 1500 </span> RM 999
                        </div>
                        <div class="promotion-product-title">
                            Supreme Sifu Men's suit package.
                        </div>
                        <div class="promotion-product-descp">
                            The Perfect Suit!  Your choice of Classic or Contemporary Slim Fit, Cobalt Blue Vested Suit plus all the accessories.  Supreme Sifu makes dressing easy.  Choose the right shade and we’ll take care of the rest!
                        </div>
                        <div class="promotion-dress-size">
                            <div class="dress-size-item row">
                                <div class="col-md-4"><div class="dress-size-item-title">Shirt Size</div></div>
                                <div class="col-md-1">-</div>
                                <div class="col-md-7">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="">S - 32</option>
                                        <option value="">M - 34</option>
                                        <option value="">L - 36</option>
                                        <option value="">XL - 38</option>
                                        <option value="">XXL - 40</option>
                                        <option value="">XXXL - 42</option>
                                    </select>
                                </div>
                            </div>
                            <div class="dress-size-item row">
                                <div class="col-md-4"><div class="dress-size-item-title">Suit Jacket Size</div></div>
                                <div class="col-md-1">-</div>
                                <div class="col-md-7">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="">S - 32</option>
                                        <option value="">M - 34</option>
                                        <option value="">L - 36</option>
                                        <option value="">XL - 38</option>
                                        <option value="">XXL - 40</option>
                                        <option value="">XXXL - 40</option>
                                    </select>
                                </div>
                            </div>
                            <div class="dress-size-item row">
                                <div class="col-md-4"><div class="dress-size-item-title">Suit Trouser Size</div></div>
                                <div class="col-md-1">-</div>
                                <div class="col-md-7">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="">S - 30</option>
                                        <option value="">S - 31</option>
                                        <option value="">S - 32</option>
                                        <option value="">S - 33</option>
                                        <option value="">S - 34</option>
                                        <option value="">S - 35</option>
                                        <option value="">S - 36</option>
                                        <option value="">S - 37</option>
                                        <option value="">S - 38</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="promotion-add-cart-cover">
                            <a href="" class="promotion-add-cart-button">ADD TO CART</a>
                        </div>
                        <div class="promotion-instruction">
                            *You can customize the sizes and fabric for the products in the promotion once you add it to the cart. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="home-info-area-cover">
        <div class="top-container"></div>
            <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <div class="home-info-item">
                        <div class="home-info-item-image">
                            <img src="/front/assets/images/home/4.jpg" alt="Our Story"/>
                        </div>
                        <div class="home-info-item-content">
                            <div class="home-info-item-head">Our <b>Story</b></div>
                            <div class="home-info-item-body">Rethinking custom clothing we came up with a revolutionary approach to combine traditional tailoring with modern technology.</div>
                            <div class="home-info-item-more"><a href="/about-us/our-history">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 no-padding">
                    <div class="home-info-item">
                        <div class="home-info-item-image">
                            <img src="/front/assets/images/home/2.jpg" alt="Our Story"/>
                        </div>
                        <div class="home-info-item-content">
                            <div class="home-info-item-head">Our <b>Fabric</b></div>
                            <div class="home-info-item-body">Our multitude of quality fabrics is destined to make you spellbound through the kaleidoscope of textures and colors. We offer fabrics for all tastes and budgets.</div>
                            <div class="home-info-item-more"><a href="/custom-shirt/fabric/class">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 no-padding">
                    <div class="home-info-item">
                        <div class="home-info-item-image">
                            <img src="/front/assets/images/home/1.jpg" alt="Our Story"/>
                        </div>
                        <div class="home-info-item-content">
                            <div class="home-info-item-head">Our <b>Shop</b></div>
                            <div class="home-info-item-body">Your cloths are stitched with upmost dedication with best materials by skilled craftsmen.</div>
                            <div class="home-info-item-more"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-story-cover pt--100">
        <div class="row no-margin">
            <div class="col-md-4 no-padding">
                <div class="story-main-image grid">
                    <figure class="effect-ming">
                        <img src="/front/assets/images/home/start-customizing.jpg" alt="img09"/>
                        <figcaption>
                            <h2>Start <span> Designing</span></h2>
                            <p style="text-align: justify;">Clothing made to make you Look Great & Feel Good. Here, the finest quality natural fabrics meet skillful artisans backed by cutting edge technology. All products are responsibly made in our in-house facilities following the strictest quality norms, safety standards & happy working conditions.</p>
                            <br>
                            <p><a class="home-hover-design" href="/custom-shirt/fabric/class">Start Designing</a></p>
                        </figcaption>           
                    </figure>
                </div>
            </div>
            <div class="col-md-8 no-padding">
                <div class="row story-top no-margin" style="margin-bottom: -16px;">
                    <div class="col-md-8 no-padding">
                        <div class="story-image grid">
                            <figure class="effect-ming">
                                <img src="/front/assets/images/home/story.jpg" alt="img09"/>
                                <figcaption>
                                    <h2>Our <span> Story</span></h2>
                                    <p style="text-align: justify;">Combining six generations of tradition with the modern technologies.</p>
                                    <p><a style="text-align: right" href="/about-us/our-history">Read More</a></p>
                                </figcaption>           
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-4 no-padding">
                        <div class="story-image grid">
                            <figure class="effect-ming">
                                <img src="/front/assets/images/home/shop.jpg" alt="img09"/>
                                <figcaption>
                                    <h2>Our <span> Shop</span></h2>
                                    <p style="text-align: justify;">Your cloths are stitched with upmost dedication with best materials by skilled craftsmen.</p>
                                    <p><a style="text-align: right" href="#">Read More</a></p>
                                </figcaption>           
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="row story-top no-margin">
                    <div class="col-md-4 no-padding">
                        <div class="story-image grid">
                            <figure class="effect-ming">
                                <img src="/front/assets/images/home/fabric.jpg" alt="img09"/>
                                <figcaption>
                                    <h2>Quality <span> Fabric</span></h2>
                                    <p style="text-align: justify;">Fabrics that inspore to create dazzling cloths.</p>
                                    <p><a style="text-align: right" href="/custom-shirt/fabric/class">Read More</a></p>
                                </figcaption>           
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="story-image grid">
                            <figure class="effect-ming">
                                <img src="/front/assets/images/home/payment.jpg" alt="img09"/>
                                <figcaption>
                                    <h2>Affordable <span> Pricing</span></h2>
                                    <p style="text-align: justify;">By eliminating all the costs of a retail business, we bring your the best prices.</p>
                                    <p><a style="text-align: right" href="/about-us">Read More</a></p>
                                </figcaption>           
                            </figure>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    

    <!-- Latest Blog Posts Area start -->
    <div class="latest-blog-post-area home-mob-designs home-mobile-blog">
        <div class="top-container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title-two pb--40 pt--20 text-center section-title-regular">
                        <h2>LATEST FROM <b>OUR BLOG</b></h2>
                        <div class="head-underline"></div>
                    </div>
                    <!-- section-title end -->
                     <div class="section-title-two pb--20 pt--20 text-center section-title-mobile">
                        <h3>LATEST FROM <b>OUR BLOG</b></h3>
                        <div class="head-underline"></div>
                    </div>
                </div>
            </div>
            <div class="row latest-blog-slider">
                @foreach($posts as $post)
                <div class="col-lg-4">
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="/blog/posts/{{$post->slug}}">
                                <img src="/images/post/{{$post->image}}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4><a href="/blog/posts/{{$post->slug}}">{{$post->title}}</a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>{{$post->created_at}}</span>
                                <span class="meta_author"><span></span>{{$post->user->fname}} {{$post->user->lname}}</span>
                            </div>
                            <div class="home-post-body">
                                @if($post->bodyE)
                                    {!!  substr(strip_tags($post->bodyE), 0, 100) !!}...</td>
                                @elseif($post->bodyH)
                                    {!!  substr(strip_tags($post->bodyH), 0, 100) !!}...</td>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest Blog Posts Area End -->
    <div class="latest-blog-post-area home-blog-section pt--10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title-two pb--40 pt--100 text-center">
                        <h2>LATEST FROM <b>OUR BLOG</b></h2>
                        <div class="head-underline"></div>
                    </div>
                </div>
            </div>
            <div class="row latest-blog-slider">
                @foreach($posts as $post)
                <div class="col-lg-4">
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="/blog/posts/{{$post->slug}}">
                                <img src="/images/post/{{$post->image}}" alt="">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h4 class="home-blog-title"><a href="/blog/posts/{{$post->slug}}">{{$post->title}}</a></h4>
                            <div class="post_meta">
                                <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>{{ Carbon\Carbon::parse($post->created_at)->isoFormat('MMM Do, YYYY') }}</span>
                                <span class="meta_author"><span></span>{{$post->user->fname}} {{$post->user->lname}}</span>
                            </div>
                            <div class="home-blog-body">
                                @if($post->bodyE)
                                    {!!  substr(strip_tags($post->bodyE), 0, 150) !!}...</td>
                                @elseif($post->bodyH)
                                    {!!  substr(strip_tags($post->bodyH), 0, 150) !!}...</td>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest Blog Posts Area End -->

        <!-- Our Brand Area Start -->
    <div class="our-brand-area pb--60">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="pt--60 border-t-one"></div>
                    <div class="row our-brand-active text-center">
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/1.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/2.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/3.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/4.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/5.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-brand">
                                <a href="#"><img src="/front/assets/images/brand/6.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Brand Area End -->
@endsection
@section('footer')
<script src="/front/code/js/home.js?version=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
<script type="text/javascript">
    $('.variable-width').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      centerMode: true,
      variableWidth: true
    });
  </script>
  <script>
    $(document).ready(function(){
        $(".home-step-cover .slick-next").html('<i class="fa fa-angle-right"></i>');
        $(".home-step-cover .slick-prev").html('<i class="fa fa-angle-left"></i>');
    });
</script>

@endsection