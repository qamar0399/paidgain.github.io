@extends('layouts.backend.app')

@section('title','Manage Users')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Manage Users'])
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <h6 class="text-primary">{{ __('Send Email To All Users') }}</h6>
                </div>

                <form class="ajaxform_with_reset" action="{{ route('admin.users.queue') }}" method="POST">
                    @csrf

                    <div class="clearfix mb-3"></div>
                    <div class="from-group mb-2">

                        <label for="subject">{{ __('Subject') }} </label>
                        <input type="text" class="form-control" placeholder="{{ __('Subject') }}"
                                required name="subject" id="subject">
                    </div>
                    <div class="from-group mb-2">
                        <label for="body">{{ __('Message') }}</label>
                        <textarea class="summernote" required name="body" id="body"></textarea>
                    </div>

                    <div class="clearfix mb-3"></div>

                    <button type="submit" class="btn btn-primary qw-100 basicbtn">
                        <i class="fas fa-hand-paper"></i>
                        {{ __('Send Email') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
@endpush
