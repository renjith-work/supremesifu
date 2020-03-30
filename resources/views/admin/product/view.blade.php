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
            <li><a href="/admin/product">Product Management</a></li>
            <li class="active">View Prodct</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="show-box-title">{{$product->name}}</h3> 
                    </div>
                    <div class="show-box-body">
                        <div class="post-show-image">
                            <img src="/images/product/product/{{$product->p_image}}" alt="">
                        </div>
                        <div class="post-show-slug">
                            {{-- <span>Post Slug Link - </span> <a href="">{{ url('')}}/blog/{{$product->slug}}</a> --}}
                        </div>
                        <div class="post-show-body">
                            {!!$product->description!!}                            
                        </div>
                        <div class="post-show-album row">
                            <div class="show-title">
                                <div class="col-md-12">Product Album</div>
                            </div>
                            <?php $images = json_decode($product->album); ?>
                            @if($images)
                                @foreach($images as $image)
                                    <div class="col-md-4 upload-multi-img">
                                        <img src="/images/product/product/{{$image}}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 ">
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
                                <span class="label label-success show-tag-label">{{$product->category->name}}</span>
                            </div>
                        </div>
                        <div class="show-group">
                            <div class="side-show-title">
                                Post Tags
                            </div>
                            <div class="show-group-body">
                                @foreach($product->tags as $tag)
                                    <span class="label label-primary show-tag-label">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="show-group">
                            <div class="side-show-title">
                                Post Meta Tags
                            </div>
                            <div class="show-group-body">
                                {!! $product->metatag !!}                                
                            </div>
                        </div>

                        <div class="show-group">
                            <div class="side-show-title">
                                Post Meta Description
                            </div>
                            <div class="show-group-body">
                                {!! $product->metadescp !!}                                
                            </div>
                        </div>
                        <div class="show-group">
                            <div class="side-show-title">
                                Post Status
                            </div>
                            <div class="show-group-body">
                                <span class="label label-warning show-tag-label">{{$product->status->name}}</span>   
                                <br>        
                                @if($product->featured == 0)                    
                                    <span class="label label-danger show-tag-label">Not Featued</span>                               
                                @elseif($product->featured == 1)
                                    <span class="label label-warning show-tag-label">Featured Post</span>                               
                                @endif
                            </div>
                        </div>
                        <div class="show-side-box-footer">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-show-page" href="/admin/post/{{$product->id}}/edit">Edit</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-danger btn-show-page" href="/admin/post/{{$product->id}}/delete">Delete</a>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-primary btn-show-page" href="/post">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
</div>
@endsection
@section('footer')
@endsection