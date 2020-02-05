@extends('admin.layout')
@section('header')
    <link rel="stylesheet" href="/cmadmin/parsley/parsley.css">
    <link rel="stylesheet" href="/cmadmin/bower_components/select2/dist/css/select2.min.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=olg2smjmsqjy5ogdk1zogy9sj5qginfm4e5ozpvxrm5ecfek"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/auth/users">User Management</a></li>
            <li class="active">Edit User</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
        	<div class="col-md-9 col-md-offset-2">
        		<div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="form-box-title">Edit User</h3> 
                    </div>
                    <div class="form-box-body">
                    	{{-- {{ Form::model($user, array('route' => array('admin.auth.users.update', $user->id), 'method' => 'PUT')) }} --}}
                        <form action="{{ route('admin.auth.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                    		<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname', $user->fname) }}" maxlength="255" required="required" >
                                        @error('fname') <p class="error-p">{{ $errors->first('fname') }}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname', $user->lname) }}" maxlength="255" required="required" >
                                        @error('lname') <p class="error-p">{{ $errors->first('lname') }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required="required" >
                                @error('email') <p class="error-p">{{ $errors->first('email') }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">User Status</label>
                                <select class="form-control" name="active">

                                    <option value="1" {{ $user->active == '1' ? 'selected': ''}}>Active</option>
                                    <option value="0" {{ $user->active == '0' ? 'selected': ''}}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach ($roles as $role)
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if($user->roles->contains($role)) checked @endif>
                                                <label>{{ ucfirst($role->name) }}</label>
                                                <br>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" >
                                @error('password') <p class="error-p">{{ $errors->first('password') }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" >
                                @error('password_confirmation') <p class="error-p">{{ $errors->first('password_confirmation') }}</p> @enderror
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