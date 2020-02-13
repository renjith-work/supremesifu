@extends('front.layout')
@section('header')
    <link href="/front/frame/auth/loginRegister.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="px-main-content-cover">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="px-auth-box-cover">
                    <div class="px-auth-box-head">
                        <div class="px-auth-box-head-title">Verify Your Email Address</div>
                    </div>
                    <div class="px-auth-box-body">
                        <div class="email-verify-body">
                            <h3>Welcome to Supreme Sifu.</h3>
                            <p class="email-verify-first-line">Thank you for sigining up with us.</p>
                            <p>Before proceeding, please check your email for a verification link. If you did not receive the email, <a href="{{ route('verification.resend') }}">{{ __('click here to request another email.') }}</a></p>
                        </div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
