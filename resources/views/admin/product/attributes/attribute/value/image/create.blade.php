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
            <li><a href="/admin/product/attribute/value/image/settings">Product Attribute Value Image Setting  Management</a></li>
            <li class="active">Create Product Attribute Value</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.product.attribute.value.image.settings.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
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
                                    <h3 class="box-title">Create Product Attribute Value Image Setting</h3>
                                </div>
                                <div class="gb-body">
                                    
                                    <div class="form-group">
                                        <label for="name">Image Property Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Image Property Code</label>
                                        <div class="form-instruction">The code should not have spaces.</div>
                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" maxlength="255" value="{{ old('code') }}">
                                        @error('code') <p class="error-p">{{$errors->first('code')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Image Property Height</label>
                                        <div class="form-instruction">Set the height of the image property.</div>
                                        <input type="number" name="height" class="form-control @error('height') is-invalid @enderror" id="height" maxlength="255" value="{{ old('height') }}">
                                        @error('height') <p class="error-p">{{$errors->first('height')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="width">Image Property Width</label>
                                        <div class="form-instruction">Set the width of the image property.</div>
                                        <input type="number" name="width" class="form-control @error('width') is-invalid @enderror" id="width" maxlength="255" value="{{ old('width') }}">
                                        @error('width') <p class="error-p">{{$errors->first('width')}}</p> @enderror
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