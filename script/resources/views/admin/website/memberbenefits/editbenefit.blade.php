@extends('layouts.backend.app')

@section('title', __('Edit Member Benefit'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit Member Benefit'),
        'prev' => url()->previous()
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="ajaxform" action="{{ route('admin.website.heading.update-member-benefit', $benefit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="lang" value="{{ $benefit->lang }}">

                <div class="form-group">
                    <label for="title" class="required">{{ __('Title') }} ({{ $benefit->lang }})</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $benefit->name }}" required>
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
