@extends('front.layout') 
@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/front/frame/auth/loginRegister.css" rel="stylesheet">
@endsection
@section('content')
	<div class="px-main-content-cover">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="px-auth-box-cover">

					<div class="px-auth-box-head">
						<div class="px-auth-box-head-title">Create your account</div>
					</div>
					<form method="POST" action="{{route('front.auth.user.store')}}">
                    {{ csrf_field() }}
					<div class="px-auth-box-body">
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname') }}" id="fname" name="fname" placeholder="Please enter your first name...">
							@error('fname') <p class="error-p">{{ $errors->first('fname') }}</p> @enderror
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname') }}" id="lname" name="lname" placeholder="Please enter your last name...">
							@error('lname') <p class="error-p">{{ $errors->first('lname') }}</p> @enderror
						</div>
						<div class="form-group">
							<label for="email">Email address</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="emai1" name="email" placeholder="Please enter your email...">
							@error('email') <p class="error-p">{{ $errors->first('email') }}</p> @enderror
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please enter your minimum 6-character password..">
							@error('password') <p class="error-p">{{ $errors->first('password') }}</p> @enderror
						</div>
						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation" placeholder="Re-Enter the password...">
						</div>
						<div class="px-atuh-box-check-cover">
							<div class="form-group form-check">
								<input type="checkbox" class="form-check-input" id="privacy" name="privacy">
								<label class="form-check-label" for="privacy">I agree to let my email to be processed in accordance with the <a href="#">Privacy Notice</a>.</label>
							</div>
							<div class="form-group form-check">
								<input type="checkbox" class="form-check-input" id="promotion" name="promotion">
								<label class="form-check-label" for="promotion">Please inform me about the promotions.</label>
							</div>
						</div>
					</div>
					<div class="px-auth-box-footer">
						<input type="Submit" value="Create Account" class="btn px-black-btn">
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('footer')

@endsection