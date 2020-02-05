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
            <li><a href="/admin/auth/permissions">Permissions Management</a></li>
            <li class="active">Create Permissions</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="form-box-title">Create Permissions</h3> 
                    </div>

                    <div class="form-box-body">
                        <form action="{{route('admin.auth.permissions.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Permissions Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                            @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                        </div>
                        <div class="box-footer">
                            <input id="submit" type="Submit" value="Create Role" class="btn btn-success btn-lg pull-right submit-button btn-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection