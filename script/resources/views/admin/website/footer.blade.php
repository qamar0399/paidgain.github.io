@extends('layouts.backend.app')

@section('title', __('Footer Settings'))

@section('head')
    @include('layouts.backend.partials.headersection', ['title'=> __('Footer Settings')])
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <form action="{{ route('admin.website.footer.store') }}" class="ajaxform" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Footer Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ $footer->address ?? null }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ $footer->email ?? null}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="phone">{{ __('Phone Number') }}</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $footer->phone ?? null }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="copyright">{{ __('Copyright Content') }}</label>
                                    <input type="text" id="copyright" name="copyright" class="form-control" value="{{ $footer->copyright ?? null }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>{{ __('Footer Social Links') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group field_wrapper">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">{{ __('Icon Class') }}</label> <br>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">{{ __('Link') }}</label><br>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:" class="add_button text-xxs mr-2 btn btn-primary mb-0 btn-sm  text-xxs">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @foreach ($footer->social ?? [] as $key => $social)
                                                        <div class="row">
                                                            <div class="col-md-5"><br>
                                                                <div class="input-group">
                                                                    <input type="text"  class="form-control icon_class" value="{{ $social->icon }}" name="social[{{$key}}][icon]" placeholder="icon here">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="{{ $social->icon }}"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"><br>
                                                                <input type="text" class="form-control" name="social[{{$key}}][link]" placeholder="link here" value="{{ $social->link }}" aria-label="link">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-sm  text-xxs mt-4" title="Remove">
                                                                    <i class="fas fa-times-circle"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Save & Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
