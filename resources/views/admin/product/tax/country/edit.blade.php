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
            <li><a href="/admin/product/tax/country">Manufacturing Country Management</a></li>
            <li class="active">Edit Country</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{ route('admin.product.tax.country.update', $country->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <h3 class="box-title">Add Country</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Country Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name', $country->name) }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="iso_code2">Country Alpha Code 2 (iso_code2)</label>
                                        <input type="text" name="iso_code2" class="form-control @error('iso_code2') is-invalid @enderror" id="iso_code2" maxlength="255" value="{{ old('iso_code2', $country->iso_code2) }}">
                                        @error('iso_code2') <p class="error-p">{{$errors->first('iso_code2')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="iso_code3">Country Alpha Code 3 (iso_code3)</label>
                                        <input type="text" name="iso_code3" class="form-control @error('iso_code3') is-invalid @enderror" id="iso_code3" maxlength="255" value="{{ old('iso_code3', $country->iso_code3) }}">
                                        @error('iso_code3') <p class="error-p">{{$errors->first('iso_code3')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="numeric">Country Numeric Code</label>
                                        <input type="text" name="numeric" class="form-control @error('numeric') is-invalid @enderror" id="numeric" maxlength="255" value="{{ old('numeric', $country->numeric) }}">
                                        @error('numeric') <p class="error-p">{{$errors->first('numeric')}}</p> @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                            <option value="1"  @if($country->status == 1) selected @endif>Yes</option>
                                            <option value="0" @if($country->status == 0) selected @endif>No</option>
                                        </select>
                                        @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-12 text-right">
                                            <input class="btn btn-success" type="submit" value="Submit">
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
    @section('footer')
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});

            $('#image').change(function(){
                $('#image_preview').html("");
                $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

        });
    </script>
@endsection