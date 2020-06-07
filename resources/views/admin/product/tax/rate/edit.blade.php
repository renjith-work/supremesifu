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
            <li><a href="/admin/product/tax/rate">Tax Rate Management</a></li>
            <li class="active">Edit Tax Rate </li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{ route('admin.product.tax.rate.update', $rate->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <h3 class="box-title">Edit Tax Rate </h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="class">Tax Class</label>
                                        <select id="class" class="form-control custom-select mt-15 @error('class') is-invalid @enderror" name="class">
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}" @if($class->id == $rate->tax_class_id) selected @endif>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('class') <p class="error-p">{{$errors->first('class')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Countries</label>
                                        <select id="country" class="form-control custom-select mt-15 @error('country') is-invalid @enderror" name="country">
                                                <option disabled selected>Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if($country->id == $rate->zone->country_id) selected @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country') <p class="error-p">{{$errors->first('country')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="zone">Tax Zone</label>
                                        <select id="zone" class="form-control custom-select mt-15 @error('zone') is-invalid @enderror" name="zone">
                                            <option value=""></option>
                                        </select>
                                        @error('zone') <p class="error-p">{{$errors->first('zone')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Tax Rate</label>
                                        <div class="form-instruction">Please provide the tax rate in percentage.</div>
                                        <input type="number" name="rate" class="form-control @error('rate') is-invalid @enderror" id="rate" maxlength="255" value="{{ old('rate', $rate->rate) }}">
                                        @error('rate') <p class="error-p">{{$errors->first('rate')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Tax Rate Description</label>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description', $rate->description) }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
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
    <script type="text/javascript">
        var country_id  = {!! json_encode($rate->zone->country_id) !!};
        var zone_id  = {!! json_encode($rate->tax_zone_id) !!};
    </script>
    <script src="/cmadmin/code/crud.js"></script>
    <script src="/cmadmin/code/js/taxRateCRUD.js"></script>
@endsection