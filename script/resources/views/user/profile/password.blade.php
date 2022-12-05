@extends('layouts.user.app')

@section('title', __('Change Password'))

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @if(Auth::user()->password == null)
                            {{ __('Set Password') }}
                        @else
                            {{ __('Change Password') }}
                        @endif
                    </h4>
                    <form class="ajaxform_with_reload" action="{{ route('user.profile.password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        @if(Auth::user()->password != null)
                            <div class="form-group mb-3">
                                <label for="current_password" class="text-secondary">{{ __('Current Password') }}</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>
                            <hr>
                        @endif
                        <div class="form-group mb-3">
                            <label for="password" class="text-secondary">{{ __('New Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="text-secondary">{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <button class="float-end profile-button">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
