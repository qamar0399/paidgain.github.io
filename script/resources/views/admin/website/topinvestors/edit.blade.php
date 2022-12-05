@extends('layouts.backend.app')

@section('title', __('Edit Top Investor'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit Top Investor'),
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
                    <form class="ajaxform" action="{{ route('admin.website.top-investors.update', $investor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $investor->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total_invest" class="required">{{ __('Total Invest') }}</label>
                            <input type="number" name="total_invest" id="total_invest" class="form-control" value="{{ $investor->other }}" required>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="required">{{ __('Photo') }}</label>
                            {{ mediasection(['input_name' => 'photo', 'input_id' => 'photo', 'preview' => $meta->value['photo'], 'value' => $meta->value['photo']]) }}
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="featured" id="featured">
                            <label class="custom-control-label" for="featured">{{ __('Featured') }}</label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">
                                <i class="fas fa-save"></i>
                                {{ __('Update') }}
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

