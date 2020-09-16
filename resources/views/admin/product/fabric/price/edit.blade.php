@extends('admin.layout')
@section('header')
     <link rel="stylesheet" href="/cmadmin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    {!! Html::style('cmadmin/parsley/parsley.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=olg2smjmsqjy5ogdk1zogy9sj5qginfm4e5ozpvxrm5ecfek"></script>
    <link rel="stylesheet" href="/cmadmin/bower_components/select2/dist/css/select2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/product/fabric/{{$fabric_price}}/edit">Fabric</a></li>
            <li class="active">Edit Fabric Price</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="form-box-title">Create Fabric Price</h3> 
                    </div>
                    <div class="form-box-body">
                        <form action="{{ route('admin.product.fabric.price.update', $fabric_price->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            
                            <input type="hidden" id="fabric_id" name="fabric_id" value="{{$fabric_price->fabric_id}}">
                            <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control custom-select mt-15 @error('product_set') is-invalid @enderror" name="product_set">
                                    @foreach($attribute_sets as $set)
                                        <option value="{{$set->id}}" @if($set->id == $fabric_price->product_attribute_set_id) selected @endif>{{$set->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_set') <p class="error-p">{{$errors->first('product_set')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <div class="form-instruction">Enter your product price here.</div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price', $fabric_price->price) }}">
                                @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="splPrice">Product Special Price</label>
                                <div class="form-instruction">If you want to provide a special offer price for the product, please enter it here.</div>
                                <input type="number" name="splPrice" class="form-control @error('splPrice') is-invalid @enderror" id="splPrice" maxlength="255" value="{{ old('splPrice', $fabric_price->splPrice) }}">
                                @error('splPrice') <p class="error-p">{{$errors->first('splPrice')}}</p> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="startDate">Special Price - Begin Date</label>
                                        <input type="date" name="startDate" class="form-control @error('startDate') is-invalid @enderror" id="startDate" maxlength="255" value="{{ old('startDate', $fabric_price->startDate) }}">
                                        @error('startDate') <p class="error-p">{{$errors->first('startDate')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="endDate">Special Price - End Date</label>
                                        <input type="date" name="endDate" class="form-control @error('endDate') is-invalid @enderror" id="endDate" maxlength="255" value="{{ old('endDate', $fabric_price->endDate) }}">
                                        @error('endDate') <p class="error-p">{{$errors->first('endDate')}}</p> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="splPrice">Product Weight</label>
                                    <div class="form-instruction">Please provide the weight of the product.</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" maxlength="255" value="{{ old('weight', $fabric_price->weight) }}">
                                        @error('weight') <p class="error-p">{{$errors->first('weight')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weightUnit">Weight Unit</label>
                                        <select id="weightUnit" class="form-control custom-select mt-15 @error('weightUnit') is-invalid @enderror" name="weightUnit">
                                            <option disabled selected>Select an unit</option>
                                            @foreach($weightUnits as $unit)
                                                <option value="{{ $unit->id }}"  @if($unit->id == $fabric_price->inventory_unit_id) selected @endif> {{ $unit->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('weightUnit') <p class="error-p">{{$errors->first('weightUnit')}}</p> @enderror
                                    </div>  
                                </div>
                            </div>
                            <div class="box-footer">
                                <input id="submitTag" type="Submit" value="Submit" class="btn btn-success btn-lg pull-right submit-button btn-submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('footer')
    <script src="/cmadmin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script src="/cmadmin/code/js/fabric/fabricCRUD.js"></script>
@endsection