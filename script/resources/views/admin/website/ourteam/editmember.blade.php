@extends('layouts.backend.app')

@section('title', __('Edit Team Member'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit Team Member'),
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
                    <form class="ajaxform_with_reload" action="{{ route('admin.website.home.update-team-member', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $member->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="position" class="required">{{ __('Position') }}</label>
                            <input type="text" name="position" id="position" class="form-control" value="{{ $member->other }}" required>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="required">{{ __('Photo') }}</label>
                            {{ mediasection(['input_name' => 'image', 'input_id' => 'image', 'preview' => $meta->value['image'], 'value' => $meta->value['image']]) }}
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="featured" id="featured" @checked($member->featured)>
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

