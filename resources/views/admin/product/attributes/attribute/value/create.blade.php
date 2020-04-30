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
            <li><a href="/admin/product/attribute/value">Product Attribute Value Management</a></li>
            <li class="active">Create Product Attribute Value</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.product.attribute.value.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
                {{ csrf_field() }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                                <li class="nav-item" id="liImage"><a class="nav-link active" href="#imagePane" id="imageTab" data-toggle="tab">MEDIA CONTENT</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Create Product Attribute Value</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="attributeSet">Product Attribute Set</label>
                                        <div class="form-instruction">Please select a product attribute set to get all the attributes of the product.</div>
                                        <select id="attributeSet" class="form-control custom-select mt-15 @error('attributeSet') is-invalid @enderror" name="attributeSet">
                                            <option disabled selected>Select a attribute set</option>
                                            @foreach($attributeSets as $set)
                                                <option value="{{$set->id}}">{{$set->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('attributeSet') <p class="error-p">{{$errors->first('attributeSet')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="attribute">Attribute</label>
                                        <select id="attribute" class="form-control custom-select mt-15 @error('attribute') is-invalid @enderror" name="attribute">
                                            <option disabled selected>Select product attribute</option>
                                            <option disabled>Select a product category</option>
                                        </select>
                                        @error('attribute') <p class="error-p">{{$errors->first('attribute')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="value">Attribute Value</label>
                                        <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" id="value" maxlength="255" value="{{ old('value') }}">
                                        @error('value') <p class="error-p">{{$errors->first('value')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Attribute Description</label>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Attribute Price</label>
                                        <div class="form-instruction">If implementing this attribute requires extra cost, you can specify the extra amount here. This will be added to the cost of the product.</div>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price') }}">
                                        @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
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
                                    <h3 class="box-title">MEDIA CONTENT</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="d_image">Display Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the attribute. Preferred Image size is - 250px x 250px. ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="d_image" class="form-control  @error('d_image') is-invalid @enderror" id="d_image">
                                        @error('d_image') <p class="error-p">{{$errors->first('d_image')}}</p> @enderror
                                        <div id="d_image_preview" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="d_drawing">Display Drawing - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display drawing for the attribute. Preferred Image size is - 250px x 250px. ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="d_drawing" class="form-control  @error('d_drawing') is-invalid @enderror" id="d_drawing">
                                        @error('d_drawing') <p class="error-p">{{$errors->first('d_drawing')}}</p> @enderror
                                        <div id="d_drawing_preview" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_image">Cover Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the attribute. Preferred Image size is - 250px x 250px. ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="c_image" class="form-control  @error('c_image') is-invalid @enderror" id="c_image">
                                        @error('c_image') <p class="error-p">{{$errors->first('c_image')}}</p> @enderror
                                        <div id="c_image_preview" class="row"></div>
                                    </div>
                                </div>

                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section2P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
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
    <script src="/cmadmin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script src="/cmadmin/code/attributeValueCRUD.js"></script>
    <script src="/cmadmin/code/crud.js"></script>
@endsection