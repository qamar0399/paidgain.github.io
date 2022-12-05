@extends('layouts.backend.app')

@section('title','Create PTC Ads')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Add PTC Ads','prev'=> route('admin.ptc-ads.index')])
@endsection
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <form class="ajaxform_with_reset" method="post" action="{{ route('admin.ptc-ads.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- left side --}}
                    <div class="col-lg-5">
                        <strong>{{ __('Description') }}</strong>
                        <p>{{ __('Add your PTC Ads details and necessary information from here') }}</p>
                    </div>
                    {{-- /left side --}}
                    {{-- right side --}}
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="from-group mb-2">
                                    <label for="title" class="required">{{ __('Title') }} </label>
                                    <input type="text" name="title" id="title" class="form-control"
                                            placeholder="{{ __('Title') }}" required>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="amount" class="required">{{ __('Amount') }} </label>
                                    <div class="input-group">
                                        <input type="number" name="amount" id="amount" step="any"
                                                class="form-control" placeholder="{{ __('Amount') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ defaultcurrency('currency') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="duration" class="required">{{ __('Duration') }} </label>
                                    <div class="input-group">
                                        <input type="number" name="duration" id="duration" class="form-control"
                                                placeholder="{{ __('Duration') }}" required >
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('Seconds') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="max_limit" class="required">{{ __('Maximum Limit') }} </label>
                                    <div class="input-group">
                                        <input type="number" name="max_limit" id="max_limit" class="form-control"
                                                placeholder="{{ __('Maximum Limit') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('Times') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="status" class="required">{{ __('Status') }} </label>
                                    <select name="status" class="form-control" id="status" data-control="select2" data-placeholder="{{ __('Select Status') }}" required>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="from-group mb-2">
                                    <label for="ads_type" class="required">{{ __('Advertisement Type') }} </label>
                                    <select name="ads_type" class="form-control" id="ads_type" data-control="select2" data-placeholder="{{ __('Select Advertisement Type') }}" required>
                                        <option></option>
                                        <option value="link_url">{{ __('Link / URL') }}</option>
                                        <option value="banner_image">{{ __('Banner / Image') }}</option>
                                        <option value="clickable_image">{{ __('Clikable Image') }}</option>
                                        <option value="script_code">{{ __('Script / Code') }}</option>
                                        <option value="embedded">{{ __('Embedded Code') }}</option>
                                        
                                        
                                    </select>
                                </div>

                                <div id="ads_type_body">

                                </div>

                                <div >
                                    <div class="from-group mb-2">
                                        <label for="image" class="required">{{ __('Image') }} </label>
                                        {{ mediasection(['input_name' => 'image', 'input_id' => 'image']) }}
                                    </div>
                                </div>

                                <div class="from-group mb-2">
                                    <label for="is_clickable" class="required">{{ __('Clickable') }} </label>
                                    <select name="is_clickable" class="form-control" id="is_clickable" data-control="select2" data-placeholder="{{ __('Select Clickable') }}" required>
                                        <option value="0">{{ __('No') }}</option>
                                        <option value="1">{{ __('Yes') }}</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary basicbtn" type="submit">
                                            <i class="fas fa-save"></i>
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
{{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/ptcads/create.js') }}"></script>
@endpush
