@extends('layouts.backend.app')

@section('title', __('Edit Feature'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit Feature'),
        'prev' => url('admin/website/heading')
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="ajaxform" action="{{ route('admin.website.heading.update-feature', $feature->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="lang" value="{{ $feature->lang }}">
                <div class="form-group">
                    <label for="title" class="required">{{ __('Title') }} ({{ $feature->lang }})</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $feature->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="required">{{ __('Description') }} ({{ $feature->lang }})</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $feature->other }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image" class="required">{{ __('Image') }} ({{ $feature->lang }})</label>
                    {{ mediasection([
                        'input_id' => 'image_'.$feature->lang,
                        'input_name' => 'image_'.$feature->lang,
                        'preview_class' => 'image_'.$feature->lang,
                        'preview' => $meta->value['image'],
                        'value' => $meta->value['image']
                    ]) }}
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="featured" id="featured" @checked($feature->featured)>
                    <label class="custom-control-label" for="featured">{{ __('Featured') }} ({{ $feature->lang }})</label>
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
    {{ mediasingle() }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpush
