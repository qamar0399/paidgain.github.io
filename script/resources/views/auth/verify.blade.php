@extends('layouts.user.app')

@section('content')
<div class="verify-main-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="verfiy-main-content">
                    <div class="verify-main-logo text-center">
                        <img src="{{ asset('uploads/email.png') }}" alt="">
                    </div>
                    <div class="verify-content text-center">
                        <h3>{{ __('Please Verify Your Email') }}.</h3>
                        <p>{{ __("You're almost there! We send an email to") }} <strong class="text-dark">{{ Auth::User()->email }}</strong></p>
                        <p>{{ __("Just click on the link that email to complete your signup. If you don't see it, you may need to check your spam folder.") }}</p>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <h6>{{ __("Still can't find the email?") }}</h6>
                        <form class="d-inline" method="POST" action="{{ url('email/resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-custom basicbtn">{{ __('Resend Email') }}</button>
                        </form>
                        <p>{{ __('Need Help?') }} <a href="{{ url('contact') }}">{{ __('Contact Us') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

