@extends('layouts.backend.app')

@section('title','Create New User')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Create New User','prev'=> url()->previous()])
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <form class="ajaxform_with_reset" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5">
                            <strong>{{ __('Description') }}</strong>
                            <p>{{ __('Add your customer details and necessary information from here') }}</p>
                        </div>
                        <div class="col-lg-7">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="font-weight-bold required">{{ __('Full Name') }}</label>
                                                <input class="form-control" type="text" name="name" id="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="font-weight-bold required">{{ __('Email') }}</label>
                                                <input class="form-control" type="email" name="email" id="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username" class="font-weight-bold required">{{ __('Username') }}</label>
                                                <input class="form-control" type="text" name="username" id="username" required>
                                                <div id="message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone" class="font-weight-bold required">{{ __('Phone') }}</label>
                                                <input class="form-control" type="tel" name="phone" id="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password" class="font-weight-bold required">{{ __('Password') }}</label>
                                                <input class="form-control" type="password" name="password" id="password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="balance" class="font-weight-bold required">{{ __('Balance') }}</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="number" name="balance" id="balance" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ defaultcurrency('currency') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address" class="font-weight-bold">{{ __('Address') }}</label>
                                                <textarea class="form-control" type="tel" name="address" id="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city" class="font-weight-bold">{{ __('City') }}</label>
                                                <input class="form-control" type="text" name="city" id="city">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="state" class="font-weight-bold">{{ __('State') }}</label>
                                                <input class="form-control" type="text" name="state" id="state">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="zip" class="font-weight-bold">{{ __('Zip / Postal') }}</label>
                                                <input class="form-control" type="text" name="zip" id="zip">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="country" class="font-weight-bold">{{ __('Country') }}</label>
                                                <select class="form-control" name="country" id="country" data-control="select2" data-placeholder="{{ __('Select Country') }}">
                                                    <option ></option>
                                                    @foreach(\App\Lib\Data::getCountriesList() as $country)
                                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group col custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="status" name="status">
                                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group col custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="email_verification" name="email_verification">
                                                <label class="custom-control-label" for="email_verification">{{ __('Email Verification') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group col custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="sms_verification" name="sms_verification">
                                                <label class="custom-control-label" for="sms_verification">{{ __('SMS Verification') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary mt-3 basicbtn float-right">
                                        <i class="fas fa-save"></i>
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/users/create.js') }}"></script>
@endpush
