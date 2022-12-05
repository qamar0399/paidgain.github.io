@extends('layouts.backend.app')

@section('title', __('App Settings'))

@section('head')
@include('layouts.backend.partials.headersection', ['title'=> __('App Settings')])
@endsection

@section('content')

<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <form action="{{ route('admin.option.update','currency_info') }}" method="post" class="ajaxform">
                @csrf
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('Currency Settings' )}}
                    </h4>
                </div>
                @php
                $currency_info=get_option('currency_info',true);
                @endphp
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="icon">{{ __('Currency Icon') }}</label>
                        <input type="text" name="option[icon]" id="icon" class="form-control" value="{{ $currency_info->icon ?? '' }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{ __('Currency Name') }}</label>
                        <input type="text" name="option[name]"  class="form-control" value="{{ $currency_info->name ?? '' }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{ __('Currency Position') }}</label>
                        <select name="option[position]"  class="form-control">
                            <option value="left" @if($currency_info->position == 'left') selected  @endif>{{ __('Left') }}</option>
                            <option value="right" @if($currency_info->position == 'right') selected  @endif>{{ __('Right') }}</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <form action="{{ route('admin.option.update','twilio_info') }}" method="post" class="ajaxform">
                @csrf
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('Twilio api settings' )}}
                    </h4>
                </div>
                @php
                $twilio_info=get_option('twilio_info',true);
                @endphp
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="twilio_sid">{{ __('Twilio Sid') }}</label>
                        <input type="text" name="option[twilio_sid]" id="twilio_sid" class="form-control" value="{{ $twilio_info->twilio_sid ?? '' }}" required>
                    </div>

                     <div class="form-group mb-3">
                        <label for="twilio_auth_token">{{ __('Twilio Auth Token') }}</label>
                        <input type="text" name="option[twilio_auth_token]" id="twilio_auth_token" class="form-control" value="{{ $twilio_info->twilio_auth_token ?? '' }}" required>
                    </div>

                     <div class="form-group mb-3">
                        <label for="twilio_auth_token">{{ __('Twilio Auth Token') }}</label>
                        <input type="text" name="option[twilio_auth_token]" id="twilio_auth_token" class="form-control" value="{{ $twilio_info->twilio_auth_token ?? '' }}" required>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <form action="{{ route('admin.referral-commission.update.config') }}" class="ajaxform">
                @csrf
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('Referral Commission Settings' )}}
                    </h4>
                </div>
               
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label>{{ __('Referral Commsion For Per Deposit') }}</label>
                        
                        <select name="deposit"  class="form-control">
                            <option value="1" @if($referralCommissionConfig['deposit'] == 1) selected  @endif>{{ __('Yes') }}</option>
                            <option value="0" @if($referralCommissionConfig['deposit'] == 0) selected  @endif>{{ __('No') }}</option>
                        </select>
                    </div>
                  
                    <div class="form-group mb-3">
                        <label>{{ __('Referral Commsion For When Purchase a Plan') }}</label>
                        
                        <select name="membership_upgrade"  class="form-control">
                            <option value="1" @if($referralCommissionConfig['membership_upgrade'] == 1) selected  @endif>{{ __('Yes') }}</option>
                            <option value="0" @if($referralCommissionConfig['membership_upgrade'] == 0) selected  @endif>{{ __('No') }}</option>
                        </select>
                    </div>

                    
                    <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection
