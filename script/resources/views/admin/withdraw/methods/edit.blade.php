@extends('layouts.backend.app')

@section('title', __('Edit Withdrawal Method'))

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> __('Edit Withdrawal Method'),'prev'=> route('admin.withdraw-methods.index')])
@endsection

@push('css')
<!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <form class="ajaxform" method="post" action="{{ route('admin.withdraw-methods.update', $method->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Method Name') }}</label>
                            <input type="text" class="form-control" placeholder="Method Name"  value="{{$method->name}}" required="" name="name">
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Select Currency') }}</label>
                                    <input type="text" class="form-control" placeholder="Currency Name" required="" value="{{$method->currency}}" name="currency">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Minimum Amount') }}</label>
                                    <input type="number" class="form-control" value="{{$method->min_limit}}" placeholder="Minimum Amount" required="" name="min_limit">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Maximum Amount') }}</label>
                                    <input type="number" class="form-control" value="{{$method->max_limit}}" placeholder="Maximum Amount" required="" name="max_limit">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="transaction_fixed col-lg-6 col-md-6 col-sm-12"  >
                                <div class="form-group">
                                    <label>{{ __('Delay') }}</label>
                                    <input type="number" class="form-control" value="{{$method->delay}}" name="delay" placeholder="Delay">
                                </div>
                            </div>
                            <!--- Transaction Charge percentage --->
                            <div class="transaction_percentage col-lg-6 col-md-6 col-sm-12"  >
                                <div class="form-group">
                                    <label>{{ __('Rate') }}</label>
                                    <input type="number" class="form-control"  value="{{$method->rate}}" name="rate" placeholder="Rate" step=".01">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Charge Type') }}</label>
                            <select name="charge_type" class="form-control" id="charge_type">
                                <option value="">{{ __('Select charge type') }}</option>
                                <option {{ $method->fixed_charge != null ? 'selected' : '' }}  value="fixed">{{ __('Fixed') }}  </option>
                                <option {{ $method->percent_charge != null ? 'selected' : '' }} value="percentage">{{ __('Percentage') }}  </option>
                            </select>
                        </div>
                        <!--- Transaction Charge Fixed --->
                        <div class="form-row">
                            <div class="transaction_fixed col-sm-12 d-none">
                                <div class="form-group">
                                    <label>{{ __('Fixed Amount') }}</label>
                                    <input type="number" class="form-control" value="{{$method->fixed_charge}}" name="fixed_charge" placeholder="{{ __('Fixed Amount') }}">
                                </div>
                            </div>
                            <!--- Transaction Charge percentage --->
                            <div class="transaction_percentage col-sm-12 d-none">
                                <div class="form-group">
                                    <label>{{ __('Percentage Amount') }}</label>
                                    <input type="number" class="form-control" value="{{$method->percent_charge}}" name="percent_charge" placeholder="Percentage Amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Currency Image') }}</label>
                                    {{ mediasection(['input_name' => 'image', 'input_id' => 'image', 'preview' => $method->image, 'value' => $method->image]) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ __('Instruction') }}</label>
                                    <textarea name="instruction" class="summernote">{{ $method->instruction }}</textarea>
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
                                <button type="submit" class="btn btn-primary col-12"><i class="fa fa-save"></i> {{ __('Save') }}
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
                                    <option {{ $method->status == 1 ? 'selected' : '' }} value="1">{{ __('Active') }}</option>
                                    <option {{ $method->status == 0 ? 'selected' : '' }}  value="0">{{ __('Inactive') }}</option>
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

