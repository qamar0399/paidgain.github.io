@extends('layouts.backend.app')

@section('title', __('Create Team Member'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Add New Team Member'),
        'prev'=> route('admin.website.team-members.index')
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
                    <form class="ajaxform_with_reset" action="{{ route('admin.website.team-members.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="position" class="required">{{ __('Position') }}</label>
                            <input type="text" name="position" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="required">{{ __('Photo') }}</label>
                            {{ mediasection(['input_name'=> 'image', 'input_id' => 'image']) }}
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
