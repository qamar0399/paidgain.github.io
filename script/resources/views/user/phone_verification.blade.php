@extends('layouts.user.app')

@section('content')
<div class="verify-main-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="verfiy-main-content">
                    <div class="verify-main-logo text-center">
                        <img src="{{ asset('uploads/phone.png') }}" alt="">
                        @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                        @endif
                    </div>
                    <div class="verify-content text-center">
                        <h3>{{ __('Please Verify Your Phone Number.') }}</h3>
                        <p>{{ __("You're almost there! We send an otp to") }} {{ Auth::User()->phone }}</p>
                        <form action="{{ route('phone.verification.check') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label for="">{{ __('OTP') }}</label>
                                    <input type="text" name="otp" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                 <button type="submit" class="btn btn-custom basicbtn">{{ __('Submit') }}</button>
                             </div>
                         </div>
                     </form>
                     <form method="post" action="{{ route('phone.verification.resend') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 text-end mt-3">
                                <input type="hidden" value=1 name="resend">
                                <input type="submit" value="Re-send OTP" class="basicbtn btn btn-link text-center">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
