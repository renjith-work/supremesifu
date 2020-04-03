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
            <li><a href="/admin/brand">Brand Management</a></li>
            <li class="active">Create brand</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
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
                                    <h3 class="box-title">Create Brand</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Brand Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Brand Description</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Active Status</label>
                                        <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                            @foreach($statuses as $status)
                                                <option value="{{$status->id}}"> {{$status->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Brand Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the brand. Preferred Image size is - ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                        @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                        <div id="image_preview" class="row"></div>
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