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
            <li><a href="/admin/product/attribute">Product Attribute Management</a></li>
            <li class="active">Create Product Attribute</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{ route('admin.product.attribute.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PUT') }}
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
                                    <h3 class="box-title">Create Product Attribute</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Attribute Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name', $attribute->name) }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Attribute Code</label>
                                        <div class="form-instruction">The attribute code should be unique.</div>
                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" maxlength="255" value="{{ old('name', $attribute->code) }}">
                                        @error('code') <p class="error-p">{{$errors->first('code')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="attributeSet">Attribute Set</label>
                                        <select id="attributeSet" class="form-control custom-select mt-15 @error('attributeSet') is-invalid @enderror" name="attributeSet">
                                            <option disabled>Select a product attribute set</option>
                                            @foreach($attributeSets as $set)
                                                <option value="{{$set->id}}" @if($attribute->product_attribute_set_id == $set->id) selected @endif>{{$set->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('attributeSet') <p class="error-p">{{$errors->first('attributeSet')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="frontend_type">Display Type</label>
                                        <div class="form-instruction">How do you want this attribute to be displayed (select will be set as default)</div>
                                        <select id="frontend_type" class="form-control custom-select mt-15 @error('frontend_type') is-invalid @enderror" name="frontend_type">
                                            <option disabled>Select a display type</option>
                                            <option value="select" @if($attribute->frontend_type == 'select') selected @endif>Select</option>
                                            <option value="radio" @if($attribute->frontend_type == 'radio') selected @endif>Radio</option>
                                            <option value="text" @if($attribute->frontend_type == 'text') selected @endif>Text</option>
                                            <option value="text_area" @if($attribute->frontend_type == 'text_area') selected @endif>Text Area</option>
                                        </select>
                                        @error('frontend_type') <p class="error-p">{{$errors->first('frontend_type')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_filterable">Filterable</label>
                                        <div class="form-instruction">Do you want the attribute to be filterable.</div>
                                        <select id="is_filterable" class="form-control custom-select mt-15 @error('is_filterable') is-invalid @enderror" name="is_filterable">
                                            <option value="1" @if($attribute->is_filterable == 1) selected @endif>Yes</option>
                                            <option value="0" @if($attribute->is_filterable == 0) selected @endif>No</option>
                                        </select>
                                        @error('is_filterable') <p class="error-p">{{$errors->first('is_filterable')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_required">Required</label>
                                        <div class="form-instruction">Do you want the attribute to be required compulsorily.</div>
                                        <select id="is_required" class="form-control custom-select mt-15 @error('is_required') is-invalid @enderror" name="is_required">
                                            <option value="1" @if($attribute->is_required == 1) selected @endif>Yes</option>
                                            <option value="0" @if($attribute->is_required == 0) selected @endif>No</option>
                                        </select>
                                        @error('is_required') <p class="error-p">{{$errors->first('is_required')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_configurable">Configurable</label>
                                        <div class="form-instruction">Do you want the attribute to be configurable from the front end.</div>
                                        <select id="is_configurable" class="form-control custom-select mt-15 @error('is_configurable') is-invalid @enderror" name="is_configurable">
                                            <option value="1" @if($attribute->is_configurable == 1) selected @endif>Yes</option>
                                            <option value="0" @if($attribute->is_configurable == 0) selected @endif>No</option>
                                        </select>
                                        @error('is_configurable') <p class="error-p">{{$errors->first('is_configurable')}}</p> @enderror
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
@endsection