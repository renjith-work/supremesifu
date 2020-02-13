@extends('front.layout') 
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/front/frame/auth/loginRegister.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
        <div class="px-main-content-cover">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="px-auth-box-cover">

                        <div class="px-auth-box-head">
                            <div class="px-auth-box-head-title">Login</div>
                        </div>
                        <div class="px-auth-box-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="emai1" name="email" placeholder="Please enter your email...">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br><br>
                                <div class="px-auth-login-button-cover">
                                    <input type="Submit" value="Send Password Reset Link" class="btn px-black-btn">
                                </div>
                            </form>
                        </div>
                            
                        
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
