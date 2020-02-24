@extends('front.layout')
@section('content')
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Supreme Sifu - Dressing Guides</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content-wraper">
    <div class="container">
        <div class="about-info-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title about-section-title">
                        <h2>Guiding you to bring out the <b>best in you.</b></h2> </div>
                    <div class="title-section-content pb--100">
                        <p>Fashion trends are constantly changing. We all know how difficult it is to adapt to these changing trends for your unique body shapes. Supreme Sifu believes that fashion is all about looking good in what we love and feeling great in who we are. At the same time, we should follow certain guidelines for fashion. There are a lot of factors to consider when dressing up every day, that includes the weather, the occasion and most importantly your mood. But if you want outfits that highlight your best features, then you have come to the right place. We have created a handy set of guides to help you dress to your unique body shape.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wraper pb--100 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-wrapper">
                    <div class="row blog-wrap-col-3">
                        @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog-area single-guide-item mb--40">
                                <div class="blog-image">
                                    <a href="/guides/{{$post->slug}}"><img src="/images/post/{{$post->image}}" alt=""></a>
                                </div>
                                <div class="blog-contend">
                                    <h3><a href="/guides/{{$post->slug}}">{{$post->title}}</a></h3>
                                    <div class="blog-date-categori"><span>Category</span> - {{$post->category->name}}</div>
                                    <p>
                                         @if($post->bodyE)
                                            {!!  substr(strip_tags($post->bodyE), 0, 100) !!}...</td>
                                        @elseif($post->bodyH)
                                            {!!  substr(strip_tags($post->bodyH), 0, 100) !!}...</td>
                                        @endif
                                    </p>
                                    <div class="mt-30 blog-more-area"> <a href="/guides/{{$post->slug}}" class="blog-btn btn guide-list-button">Read more</a> </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection