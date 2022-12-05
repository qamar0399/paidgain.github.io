@extends('layouts.backend.app')

@section('title', __('Add New Feature'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Add New Feature'),
        'prev' => url()->previous()
    ])
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
                                <form class="ajaxform_with_reset" action="{{ route('admin.website.heading.store-feature') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="lang" value="{{ $key }}">

                                    <div class="form-group">
                                        <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                                        <textarea name="description" id="description" class="form-control" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="required">{{ __('Image') }} ({{ $key }})</label>
                                        {{ mediasection([
                                            'input_id' => 'image_'.$key,
                                            'input_name' => 'image_'.$key,
                                            'preview_class' => 'image_'.$key,
                                        ]) }}
                                    </div>

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="featured" id="featured{{ $key }}">
                                        <label class="custom-control-label" for="featured{{ $key }}">{{ __('Featured') }} ({{ $key }})</label>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary float-right">
                                            <i class="fas fa-save"></i>
                                            {{ __('Save') }}
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

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpush
