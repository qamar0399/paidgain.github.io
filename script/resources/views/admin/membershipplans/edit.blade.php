@extends('layouts.backend.app')

@section('title','Edit Membership Plan')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Edit Membership Plan','prev'=> route('admin.membership-plans.index')])
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="row">
            {{-- left side --}}
            <div class="col-lg-5">
                <strong>{{ __('Description') }}</strong>
                <p>{{ __('Edit Membership plan details and necessary information from here') }}</p>
            </div>
            {{-- /left side --}}
            {{-- right side --}}
            <div class="col-lg-7">
                <form class="ajaxform" method="post"
                      action="{{ route('admin.membership-plans.update', $membershipPlan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="from-group mb-2">
                                <label for="name" class="required">{{ __('Name') }} </label>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}"
                                       value="{{ $membershipPlan->name }}" required name="name" id="name">
                            </div>
                            <div class="from-group mb-2">
                                <label for="price" class="required">{{ __('Price') }} </label>
                                <input type="number" class="form-control" placeholder="{{ __('Price') }}"
                                       value="{{ $membershipPlan->price }}" required name="price" id="price">
                            </div>
                            <div class="from-group mb-2">
                                <label for="ad_limit" class="required">{{ __('Daily Ad Limit') }} </label>
                                <input type="number" class="form-control" placeholder="{{ __('Daily Ad Limit') }}"
                                       value="{{ $membershipPlan->ad_limit }}" required name="ad_limit" id="ad_limit">
                            </div>
                            <div class="from-group mb-2">
                                <label for="days" class="required">{{ __('Days') }} </label>
                                <input type="number" class="form-control" placeholder="{{ __('Days') }}"
                                       value="{{ $membershipPlan->days }}" required name="days" id="days">
                            </div>
                            <div class="from-group mb-2">
                                <label for="commission"
                                class="required">{{ __('Referral Commission Rate (%)') }} </label>
                                <input type="number" step="any" name="commission_rate" value="{{ $membershipPlan->commission_rate ?? 0 }}" class="form-control">
                            </div>
                            

                            <div class="from-group mb-2">
                                <label for="status" class="required">{{ __('Status') }} </label>
                                <select name="status" class="form-control" id="status" data-control="select2">
                                    <option
                                        value="1" @selected($membershipPlan->status == 1)>{{ __('Active') }}</option>
                                    <option
                                        value="0" @selected($membershipPlan->status == 0)>{{ __('Inactive') }}</option>
                                </select>
                            </div>

                            <div class="from-group mb-2">
                                <label for="is_trial" class="required">{{ __('Is Trial') }} </label>
                                <select name="is_trial" class="form-control" id="is_trial" data-control="select2"
                                        required>
                                    <option value="0" @selected($membershipPlan->is_trial == 0)>{{ __('No') }}</option>
                                    <option value="1" @selected($membershipPlan->is_trial == 1)>{{ __('Yes') }}</option>
                                </select>
                            </div>

                           

                            <button class="btn btn-primary float-right basicbtn" type="submit">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
@endpush
