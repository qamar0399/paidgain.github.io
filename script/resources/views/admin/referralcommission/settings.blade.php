@extends('layouts.backend.app')

@section('title','Manage Referral Commission')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Referral Commission Settings'])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Referral Commission Settings') }}</h4>
            </div>
            <div class="card-body">
                <div class="clearfix mb-3"></div>
                <form action="{{ route('admin.referral-commission.update.config') }}" id="ajaxform">
                    <div class="d-flex justify-content-between px-5">
                        <div class="form-group col custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="deposit" id="deposit" @checked($referralCommissionConfig['deposit'])>
                            <label class="custom-control-label" for="deposit">{{ __('Deposit') }}</label>
                        </div>
                        <div class="form-group col custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="membership_upgrade" id="membership_upgrade"  @checked($referralCommissionConfig['membership_upgrade'])>
                            <label class="custom-control-label" for="membership_upgrade">{{ __('Membership Upgrade') }}</label>
                        </div>
                       
                    </div>
                    <div class="clearfix mb-3"></div>
                    <button class="btn btn-primary w-100">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection