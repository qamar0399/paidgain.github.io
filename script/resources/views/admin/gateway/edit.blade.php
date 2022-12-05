@extends('layouts.backend.app')

@section('title','Payment Gateway Edit')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Payment Gateway Edit','prev'=> route('admin.gateway.index')])
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Edit '. $gateway->name) }}</h4>
            </div>
            <form method="POST" action="{{ route('admin.gateway.update', $gateway->id) }}" class="ajaxform">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}<sup>*</sup></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="name" value="{{ $gateway->name }}">
                        </div>
                    </div>
                     <div class="row  mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Logo') }}</label>
                       <div class="col-sm-12 col-md-7">
                          {{mediasection(['preview'=>$gateway->logo,'value'=>$gateway->logo ])}}
                       </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Rate') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input type="text" class="form-control" name="rate" value="{{ $gateway->rate }}">
                        </div>
                    </div>
                    @if($gateway->is_auto == 1)
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Sandbox Mode') }}</label>
                        <div class="col-sm-12 col-md-7">

                            <select class="form-control selectric" name="test_mode">
                                <option value="1" {{ $gateway->test_mode == 1 ? 'selected' : '' }}>{{ __('Enable') }}</option>
                                <option value="0" {{ $gateway->test_mode == 0 ? 'selected' : '' }}>{{ __('Disable') }}</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Currency Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="currency_name" value="{{ $gateway->currency_name }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Charge') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="charge" value="{{ $gateway->charge }}">
                        </div>
                    </div>
                   
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                             <select class="form-control selectric" name="status">
                                    <option value="1" {{ $gateway->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="0" {{ $gateway->status == 0 ? 'selected' : '' }}>{{ __('Deactive') }}</option>
                              </select>
                        </div>
                    </div>
                    @if($gateway->is_auto == 0)
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Accept Attachment') }}</label>
                        <div class="col-sm-12 col-md-7">
                             <select class="form-control selectric" name="image_accept">
                                    <option value="1" {{ $gateway->image_accept == 1 ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    <option value="0" {{ $gateway->image_accept == 0 ? 'selected' : '' }}>{{ __('No') }}</option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Payment Instruction') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" required="" name="payment_instruction">{{ $gateway->data }}</textarea>
                        </div>
                    </div>
                    @else
                    @php $info = json_decode($gateway->data) @endphp
                     @foreach ($info ?? [] as $key => $cred)
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="data[{{ $key }}]" value="{{ $cred }}">
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Minimum Deposit Amount') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" step="any" class="form-control" name="min_amount" required value="{{ $gateway->min_amount }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Maximum Deposit Amount') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" step="any" class="form-control" name="max_amount" required value="{{ $gateway->max_amount }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
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
