@extends('admin.layout')
@section('header')
    <link rel="stylesheet" type="text/css" href="/cmadmin/parsley/parsley.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/post/category">Post Category Management</a></li>
            <li class="active">Create Post Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.post.category.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
                {{ csrf_field() }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                                <li class="nav-item" id="liImage"><a class="nav-link active" href="#imagePane" id="imageTab" data-toggle="tab">IMAGE UPLOAD</a></li>
                                <li class="nav-item" id="liSeo"><a class="nav-link" href="#seoPane" id="seoTab" data-toggle="tab">SEO</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Create Category</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Parent Category</label>
                                        <select id="parent_id" class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                                            <option disabled selected>Select a parent category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id') <p class="error-p">{{$errors->first('parent_id')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="metadescp" class="form-control @error('metadescp') is-invalid @enderror" rows="5">{{ old('metadescp') }}</textarea>
                                        @error('metadescp') <p class="error-p">{{$errors->first('metadescp')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Show in Menu</label>
                                        <select id="menu" class="form-control custom-select mt-15 @error('menu') is-invalid @enderror" name="menu">
                                            <option value="0"> No </option>
                                            <option value="1"> Yes </option>
                                        </select>
                                        @error('menu') <p class="error-p">{{$errors->first('menu')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="featured">Show as featured</label>
                                        <select id="featured" class="form-control custom-select mt-15 @error('featured') is-invalid @enderror" name="featured">
                                            <option value="0"> No </option>
                                            <option value="1"> Yes </option>
                                        </select>
                                        @error('featured') <p class="error-p">{{$errors->first('featured')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-12 text-right">
                                            <a class="btn btn-success" href="#" id="section1N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="imagePane">
                                <div class="box-header">
                                    <h3 class="box-title">Image Upload</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="image">Category Cover Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the category. Preferred Image size is - ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                        @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                        <div id="image_preview" class="row"></div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section2P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-success" href="#" id="section2N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="seoPane">
                                <div class="box-header">
                                    <h3 class="box-title">SEO Content</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="metatag">Meta Tags</label>
                                        <textarea name="metatag" id="metatag" class="form-control @error('metatag') is-invalid @enderror" rows="5">{{ old('metatag') }}</textarea>
                                        @error('metatag') <p class="error-p">{{$errors->first('metatag')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Meta Description</label>
                                        <textarea name="metadescp" id="metadescp" class="form-control @error('metadescp') is-invalid @enderror" rows="5">{{ old('metadescp') }}</textarea>
                                        @error('metadescp') <p class="error-p">{{$errors->first('metadescp')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section3P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</div>
@endsection
@section('footer')
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});

            $('#section1N').click(function(e){
                e.preventDefault();
                $('#mainPane').removeClass("active");
                $('#imagePane').addClass("active");

                $('#mainTab').removeClass("active");
                $('#imageTab').addClass("active");

                $('#liMain').removeClass("active");
                $('#liImage').addClass("active");
            });

            $('#section2P').click(function(e){
                e.preventDefault();
                $('#imagePane').removeClass("active");
                $('#mainPane').addClass("active");

                $('#imageTab').removeClass("active");
                $('#mainTab').addClass("active");

                $('#liImage').removeClass("active");
                $('#liMain').addClass("active");
            });

            $('#section2N').click(function(e){
                e.preventDefault();
                $('#imagePane').removeClass("active");
                $('#seoPane').addClass("active");

                $('#imageTab').removeClass("active");
                $('#seoTab').addClass("active");

                $('#liImage').removeClass("active");
                $('#liSeo').addClass("active");
            });

            $('#section3P').click(function(e){
                e.preventDefault();
                $('#seoPane').removeClass("active");
                $('#imagePane').addClass("active");

                $('#seoTab').removeClass("active");
                $('#imageTab').addClass("active");

                $('#liSeo').removeClass("active");
                $('#liImage').addClass("active");
            });

            $('#image').change(function(){
                $('#image_preview').html("");
                $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

        });
    </script>
@endsection