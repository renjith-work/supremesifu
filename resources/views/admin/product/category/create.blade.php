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
            <li><a href="/admin/product/category">Product Category Management</a></li>
            <li class="active">Create Product Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.product.category.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
                {{ csrf_field() }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Create Product Category</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parent">Parent Category</label>
                                        <div class="form-instruction">Leave this blank if this is a parent category.</div>
                                        <select id="parent" class="form-control custom-select mt-15 @error('parent') is-invalid @enderror" name="parent">
                                            <option selected disabled="">Select a parent category.</option>
                                            @foreach($parents as $parent)
                                                @if($parent->id != 1)
                                                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent') <p class="error-p">{{$errors->first('parent')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description</label>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="featured">Featured</label>
                                        <div class="form-instruction">Do you want the category to be a featued.</div>
                                        <select id="featured" class="form-control custom-select mt-15 @error('featured') is-invalid @enderror" name="featured">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('featured') <p class="error-p">{{$errors->first('featured')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Menu</label>
                                        <div class="form-instruction">Do you want the category to be listed in the menu.</div>
                                        <select id="menu" class="form-control custom-select mt-15 @error('menu') is-invalid @enderror" name="menu">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('menu') <p class="error-p">{{$errors->first('menu')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_filterable">Filterable</label>
                                        <div class="form-instruction">Do you want the category to be filterable.</div>
                                        <select id="is_filterable" class="form-control custom-select mt-15 @error('is_filterable') is-invalid @enderror" name="is_filterable">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('is_filterable') <p class="error-p">{{$errors->first('is_filterable')}}</p> @enderror
                                    </div>
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
                                    <div class="form-group">
                                        <label for="image">Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the attribute.( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                        @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                        <div id="image_preview" class="row"></div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-12 text-right">
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
    <script src="/cmadmin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script src="/cmadmin/code/crud.js"></script>
    <script src="/cmadmin/code/js/productCategoryCRUD.js"></script>
@endsection