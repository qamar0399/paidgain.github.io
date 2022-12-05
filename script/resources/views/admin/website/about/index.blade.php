@extends('layouts.backend.app')

@section('title', __('About Us'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('About Us'),
    ])
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($languages->value as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-tab" data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
                        </li>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="tab-content no-padding" id="myTab2Content">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($languages->value as $key => $value)
                        <div class="tab-pane fade {{ $i == 0 ? 'show active' : null }}" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                            <form class="ajaxform_with_reset" action="{{ route('admin.website.about.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="lang" value="{{ $key }}">
                                <div class="form-group">
                                    <label for="title_{{ $key }}" class="required">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="title_{{ $key }}" class="form-control" value="{{ $about[$key]->title ?? null }}" placeholder="{{ __('Enter title') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description_{{ $key }}" class="required">{{ __('Description') }}</label>
                                    <textarea name="description" id="description_{{ $key }}" class="summernote" placeholder="{{ __('Enter description') }}" required>{{ $about[$key]->description->value ?? null }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image_{{ $key }}}" class="required">{{ __('Image') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'image_'.$key,
                                        'input_name' => 'image',
                                        'preview_class' => 'image_'.$key,
                                        'preview' => $about[$key]->preview->value ?? null,
                                        'value' => $about[$key]->preview->value ?? null
                                    ]) }}
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right">
                                        <i class="fas fa-save"></i>
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </div>
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
    <script src="{{ asset('admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
@endpush
