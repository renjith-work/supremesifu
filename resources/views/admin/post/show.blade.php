@extends('admin.layout')
@section('header')
    <link rel="stylesheet" type="text/css" href="/cmadmin/parsley/parsley.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=olg2smjmsqjy5ogdk1zogy9sj5qginfm4e5ozpvxrm5ecfek"></script>
    <link rel="stylesheet" href="/cmadmin/bower_components/select2/dist/css/select2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/post">Post Management</a></li>
            <li class="active">Show Post</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="show-box-title">{{$post->title}}</h3> 
                    </div>
                    <div class="show-box-body">
                        <div class="post-show-image">
                            <img src="/images/post/{{$post->folder}}/{{$post->image}}" alt="">
                        </div>
                        <div class="post-show-slug">
                            <span>Post Slug Link - </span> <a href="">{{ url('')}}/blog/{{$post->slug}}</a>
                        </div>
                        <div class="post-show-body">
                            @if($post->bodyH)
                                {!!$post->bodyH!!}
                            @else
                                {{ $post->bodyE }}
                            @endif
                        </div>
                        <div class="post-show-album row">
                            <div class="show-title">
                                <div class="col-md-12">Post Album</div>
                            </div>
                            <?php $images = json_decode($post->album); ?>
                            @foreach($images as $image)
                                <div class="col-md-4 upload-multi-img">
                                    <img src="/images/post/{{$post->folder}}/{{$image}}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="show-box-title">Additional Info</h3> 
                    </div>
                    <div class="show-box-body">
                        <div class="show-group">
                            <div class="side-show-title">
                                Post Category
                            </div>
                            <div class="show-group-body">
                                <span class="label label-success show-tag-label">{{$post->category->name}}</span>
                            </div>
                        </div>
                        <div class="show-group">
                            <div class="side-show-title">
                                Post Tags
                            </div>
                            <div class="show-group-body">
                                @foreach($post->tags as $tag)
                                    <span class="label label-primary show-tag-label">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="show-group">
                            <div class="side-show-title">
                                Post Meta Tags
                            </div>
                            <div class="show-group-body">
                                {!! $post->metatag !!}                                
                            </div>
                        </div>

                        <div class="show-group">
                            <div class="side-show-title">
                                Post Meta Description
                            </div>
                            <div class="show-group-body">
                                {!! $post->metadescp !!}                                
                            </div>
                        </div>
                        <div class="show-group">
                            <div class="side-show-title">
                                Post Status
                            </div>
                            <div class="show-group-body">
                                <span class="label label-warning show-tag-label">{{$post->status->name}}</span>   
                                <br>        
                                @if($post->featured == 0)                    
                                    <span class="label label-danger show-tag-label">Not Featued</span>                               
                                @elseif($post->featured == 1)
                                    <span class="label label-warning show-tag-label">Featured Post</span>                               
                                @endif
                            </div>
                        </div>
                        <div class="show-side-box-footer">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-show-page" href="/admin/post/{{$post->id}}/edit">Edit</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-show-page" href="/admin/post/{{$post->id}}/delete">Delete</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-primary btn-show-page" href="/post">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('footer')
@endsection