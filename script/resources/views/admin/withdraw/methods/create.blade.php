@extends('layouts.backend.app')

@section('title', __('New Withdrawal Method'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title' => __('New Withdrawal Method'),
        'prev' => route('admin.withdraw-methods.index'),
    ])
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <form method="post" action="{{ route('admin.withdraw-methods.store') }}" class="ajaxform_with_reset" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('Method Name') }}</label>
                            <input type="text" class="form-control" placeholder="{{ trans('Method Name') }}" required="" name="name">
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Select Currency') }}</label>
                                    <input type="text" class="form-control" placeholder="Currency Name" required=""
                                        name="currency">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Minimum Amount') }}</label>
                                    <input type="number" class="form-control" placeholder="Minimum Amount" required=""
                                        name="min_limit">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Maximum Amount') }}</label>
                                    <input type="number" class="form-control" placeholder="Maximum Amount" required=""
                                        name="max_limit">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="transaction_fixed col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Delay') }}</label>
                                    <input type="number" class="form-control" name="delay" placeholder="Delay">
                                </div>
                            </div>
                            <!--- Transaction Charge percentage --->
                            <div class="transaction_percentage col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Rate') }}</label>
                                    <input type="number" class="form-control" name="rate" placeholder="Rate" step="any">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('Charge Type') }}</label>
                            <select name="charge_type" class="form-control" id="charge_type">
                                <option value="">{{ trans('Select charge type') }}</option>
                                <option value="fixed">{{ trans('Fixed') }}</option>
                                <option value="percentage">{{ trans('Percentage') }}</option>
                            </select>
                        </div>
                        <!--- Transaction Charge Fixed --->
                        <div class="form-row">
                            <div class="transaction_fixed col-sm-12 d-none">
                                <div class="form-group">
                                    <label>{{ __('Fixed Amount') }}</label>
                                    <input type="number" class="form-control" name="fixed_charge"
                                        placeholder="Fixed Amount">
                                </div>
                            </div>
                            <!--- Transaction Charge percentage --->
                            <div class="transaction_percentage col-sm-12 d-none">
                                <div class="form-group">
                                    <label>{{ __('Percentage Amount') }}</label>
                                    <input type="number" class="form-control" name="percent_charge"
                                        placeholder="Percentage Amount">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Currency Image') }}</label>
                                    {{ mediasection(['input_name' => 'image', 'input_id' => 'image']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('Instruction') }}</label>
                                    <textarea name="instruction" class="summernote"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-area">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-publish">
                                <button type="submit" class="btn btn-primary col-12"><i class="fa fa-save"></i> {{ trans('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="btn-publish">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select name="status" class="form-control ">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

{{ mediasingle() }}
@endsection

@push('script')
    <!-- JS Libraies -->
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
    <script>
        "use strict";
        $(document).on('click',function() {
            let charge_type = $('#charge_type').val()
            if (charge_type == 'fixed') {
                $('.transaction_fixed').addClass('d-block')
                $('.transaction_percentage').removeClass('d-block')
            }
            if (charge_type == 'percentage') {
                $('.transaction_fixed').removeClass('d-block')
                $('.transaction_percentage').addClass('d-block')
            }
        });
    </script>
@endpush
