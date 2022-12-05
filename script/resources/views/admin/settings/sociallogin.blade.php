@extends('layouts.backend.app')

@section('title', __('Social Environment Settings'))

@section('head')
@include('layouts.backend.partials.headersection', ['title'=> __('Social Environment Settings')])
@endsection

@section('content')
<form action="{{ route('admin.env.update-social-login') }}" method="post" class="ajaxform_with_reload">
@csrf
@method('PUT')
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    {{ __('Google' )}}
                </h4>
                <div class="form-group mb-3">
                    <label for="google_client_api">{{ __('Google Client API Key') }}</label>
                    <input type="text" name="google_client_api" id="google_client_api" class="form-control" value="{{ config('services.google.client_id') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="google_client_secret">{{ __('Google Client Secret Key') }}</label>
                        <input type="text" name="google_client_secret" id="google_client_secret" class="form-control" value="{{ config('services.github.client_secret') }}" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="google" id="google" class="form-check-input"  value="" >
                    <label class="form-check-label" for="google">
                        {{ __('Enable / Disable') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    {{ __('Facebook' )}}
                </h4>
                <div class="form-group mb-3">
                    <label for="facebook_client_api">{{ __('Facebook Client API Key') }}</label>
                    <input type="text" name="google_client_api" id="google_client_api" class="form-control" value="{{ config('services.facebook.client_id') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="facebook_client_secret">{{ __('Facebook Client Secret Key') }}</label>
                    <input type="text" name="facebook_client_secret" id="facebook_client_secret" class="form-control" value="{{ config('services.facebook.client_secret') }}"  required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="facebook" id="facebook" class="form-check-input"  value="" >
                    <label class="form-check-label" for="facebook">
                        {{ __('Enable / Disable') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    {{ __('Twitter' )}}
                </h4>
                <div class="form-group mb-3">
                    <label for="twitter_client_api">{{ __('Twitter Client API Key') }}</label>
                    <input type="text" name="twitter_client_api" id="twitter_client_api" class="form-control" value="{{ config('services.twitter.client_id') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="twitter_client_secret">{{ __('Twitter Client Secret Key') }}</label>
                    <input type="text" name="twitter_client_secret" id="twitter_client_secret" class="form-control" value="{{ config('services.twitter.client_secret') }}" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="twitter" id="twitter" class="form-check-input"  value="" >
                    <label class="form-check-label" for="twitter">
                        {{ __('Enable / Disable') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100 basicbtn">{{ __('Update') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
