@extends('front.layout') 
@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/front/frame/auth/loginRegister.css" rel="stylesheet">
@endsection
@section('content')
	<div class="px-main-content-cover">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="px-auth-box-cover">

					<div class="px-auth-box-head">
						<div class="px-auth-box-head-title">Login</div>
					</div>
					<form method="POST" action="{{route('front.auth.user.password.email')}}">
	                    {{ csrf_field() }}
						<div class="px-auth-box-body">
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="emai1" name="email" placeholder="Please enter your email...">
								@error('email') <p class="error-p">{{ $errors->first('email') }}</p> @enderror
							</div>
							<br><br>
							<div class="px-auth-login-button-cover">
								<input type="Submit" value="Send Password Reset Link" class="btn px-black-btn">
							</div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('footer')

@endsection