@extends('layouts.backend.app')

@section('title', __('Cron Job Settings'))

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> __('Cron Job Settings')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-circle"></i> {{ __('Schedule Command example') }} <code>Once/day</code></h4>
            </div>
            <div class="card-body">
                <div class="code"><p>/usr/local/bin/php /home/username/public_html/artisan schedule:run >> /dev/null 2>&1</p></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12">
                    <h4>{{ __('Customise Cron Jobs') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.cron.update', 'cron_option') }}" class="ajaxform">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Alert Message Before Expire The Plan') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="expirable_message" required="">{{ $option->expirable_message ?? '' }}</textarea>

                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Alert Message After Expire The Plan') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="expired_message" required="">{{ $option->expired_message ?? '' }}</textarea>

                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Alert Message After Expire The Trial') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="trial_expired_message" required="">{{ $option->trial_expired_message ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Sent Notification Before Expire ') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" name="days" value="{{ $option->days ?? '' }}" placeholder="Number of days" class="form-control" min="1" max="30">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary basicbtn">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

