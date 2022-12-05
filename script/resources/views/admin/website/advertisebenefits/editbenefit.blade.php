@extends('layouts.backend.app')

@section('title', __('Edit Advertise Benefit'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit Advertise Benefit'),
        'prev' => url()->previous()
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form class="ajaxform" action="{{ route('admin.website.heading.update-advertise-benefit', $benefit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="lang" value="{{ $benefit->lang }}">
            <div class="form-group">
                <label for="title" class="required">{{ __('Title') }} ({{ $benefit->lang }})</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $benefit->name }}" required>
            </div>
            <div class="form-group">
                <label for="description" class="required">{{ __('Description') }} ({{ $benefit->lang }})</label>
                <textarea name="description" id="description" class="form-control" required>{{ $benefit->other }}</textarea>
            </div>
            <div class="form-group">
                <label for="image" class="required">{{ __('Image') }} ({{ $benefit->lang }})</label>
                {{ mediasection([
                    'input_id' => 'image_'.$benefit->lang,
                    'input_name' => 'image_'.$benefit->lang,
                    'preview_class' => 'image_'.$benefit->lang,
                    'preview' => $meta->value['image'],
                    'value' => $meta->value['image']
                ]) }}
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="featured" id="featured" @checked($benefit->featured)>
                <label class="custom-control-label" for="featured">{{ __('Featured') }} ({{ $benefit->lang }})</label>
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
