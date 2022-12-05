@extends('layouts.backend.app')

@section('title', __('Add New Top Investor'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Add New Top Investor'),
        'prev' => url()->previous()
    ])
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform_with_reset" action="{{ route('admin.website.top-investors.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="total_invest" class="required">{{ __('Total Invest') }}</label>
                            <input type="number" name="total_invest" id="total_invest" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="required">{{ __('Photo') }}</label>
                            {{ mediasection(['input_name' => 'photo', 'input_id' => 'photo']) }}
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="featured" id="featured">
                            <label class="custom-control-label" for="featured">{{ __('Featured') }}</label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{ mediasingle() }}
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpush

