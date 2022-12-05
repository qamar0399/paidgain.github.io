@extends('layouts.user.app')

@section('title', __('Create Support'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-container">
                <div class="header-section">
                    <h4>{{ __('Support') }}</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                       <form action="{{ route('user.support.store') }}" method="post" class="ajaxform_with_reset" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark">{{ __('Title') }}</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror form-control" placeholder="{{ __('Enter Request Name') }}">
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark">{{ __('Explain Your Question') }}</label>
                                        <textarea name="comment" cols="30" rows="5" class="@error('description') is-invalid @enderror form-control" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center mt-3">
                                    <div class="button-btn">
                                        <button type="submit" class="basicbtn w-100 btn btn-success">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
