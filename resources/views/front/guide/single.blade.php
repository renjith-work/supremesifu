@extends('front.layout')
@section('content')
<div class="breadcrumb-area bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/blog/posts">Supreme Sifu Blogs</a></li>
                    <li class="breadcrumb-item"><a href="/blogs/categories/{{$post->category->slug}}">{{$post->category->name}}</a></li>
                    <li class="breadcrumb-item active">{{$post->title}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 order-2 order-lg-2">
                    <!-- shop-sidebar-wrap start -->
                    <div class="blog-sidebar-wrap">
                        
                        <!-- shop-sidebar start -->

                        <div class="sidbar-product mb--30">
                            <!-- sidbar-product-inner start -->
                            <div class="blog-sidebar-header">{{$post->category->name}} Posts</div>
                            <div class="sidebar-guides-list">
                                @foreach($posts as $item)
                                <div class="sidebar-posts-inner row">
                                    <div class="sidebar-post-inner-image col-4">
                                        <a href="/guides/{{$item->slug}}"><img src="/images/post/{{$item->image}}" alt=""></a>
                                    </div>
                                    <div class="sidebar-post-inner-content col-8">
                                        <h3><a href="/guides/{{$item->slug}}">{{$item->title}}</a></h3>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if($post->tags)
                        <!-- shop-sidebar start -->
                        <div class="blog-sidebar mb--30">
                            <div class="blog-sidebar-header">Tags</div>
                            <div class="blog-sidebar-category-body">
                                <div class="sidebar-tag">
                                 @foreach($post->tags as $tag)
                                    <a href="/blog/posts/tag/{{$tag->slug}}">{{$tag->name}}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- shop-sidebar end -->
                        @endif
                    </div>
                    <!-- shop-sidebar-wrap end -->
                </div>
                <div class="col-lg-8 order-1 order-lg-1">
                    <!-- blog-details-wrapper start -->
                    <div class="blog-details-wrapper">
                        <div class="blog-details-head"><h1>{{$post->title}}</h1></div>
                        <div class="blog-details-meta">
                            <ul>
                                <li>{{ Carbon\Carbon::parse($post->created_at)->isoFormat('MMM Do, YYYY') }}</li>
                                <li>0 Comments</li>
                                <li>in <a href=#>{{$post->category->name}}</a></li>
                                <li>by <a href="#">{{$post->user->fname}} {{$post->user->lname}}</a></li>
                            </ul>
                            {{-- <span class="blog-details-matea-date">{{ Carbon\Carbon::parse($post->created_at)->isoFormat('MMM Do, YYYY') }}</span> <b>/</b>
                            <span class="blog-details-matea-author">{{$post->user->fname}} {{$post->user->lname}}</span> <b>/</b>     --}}                                                                 
                        </div>
                        @if($post->video != null)
                        <div class="blog-details-video">
                            <iframe width="100%" height="" src="{{$post->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @else
                        <div class="blog-details-image">
                            <img src="/images/post/{{$post->image}}" alt="">
                        </div>
                        @endif
                        <div class="postinfo-wrapper blog-post-content-cover">
                            <div class="post-info">
                                @if($post->bodyE)
                                    {!!  $post->bodyE !!}</td>
                                @elseif($post->bodyH)
                                    {!!  $post->bodyH !!}</td>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- blog-details-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection
@section('footer')
    <script src="/front/code/js/postSingle.js"></script>
@endsection