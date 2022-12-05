@extends('layouts.backend.app')

@section('title', __('Edit FAQ'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Edit FAQ'),
        'prev' => url()->previous()
    ])
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="ajaxform" action="{{ route('admin.website.faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $faq->lang }}">

                        <div class="form-group">
                            <label for="question" class="required">{{ __('Question') }}</label>
                            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="answer" class="required">{{ __('Answer') }}</label>
                            <textarea type="text" name="answer" id="answer" class="form-control" required>{{ $faq->other }}</textarea>
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
@endsection
