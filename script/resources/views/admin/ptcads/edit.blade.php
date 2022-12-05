@extends('layouts.backend.app')

@section('title', __('Edit PTC Ads'))

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> __('Edit PTC Ads'), 'prev'=> route('admin.ptc-ads.index')])
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <form class="ajaxform" method="post" action="{{ route('admin.ptc-ads.update', $ptcAd->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- left side --}}
                    <div class="col-lg-5">
                        <strong>{{ __('Description') }}</strong>
                        <p>{{ __('Edit your PTC Ads plan details and necessary information from here') }}</p>
                        <div class="clearfix mb-3"></div>

                        <div class="card">
                            <div class="card-header">
                                <h4 >{{ ucwords(str($ptcAd->ads_type)->replace(['-', '_'], ' ')) }}</h4>
                            </div>
                            <div class="card-body overflow-auto">
                                @if($ptcAd->ads_type == 'script_code')
                                    <code>
                                        {{ $ptcAd->ads_body }}
                                    </code>
                                @elseif($ptcAd->ads_type == 'embedded')
                                    {{ $ptcAd->ads_body }}
                                @elseif($ptcAd->ads_type == 'banner_image')
                                    <img src="{{ asset($ptcAd->ads_body) }}" alt="{{ $ptcAd->title }}" class="w-100">
                                @elseif($ptcAd->ads_type == 'clickable_image')
                                    <img src="{{ asset($ptcAd->getMeta('image')) }}" alt="{{ $ptcAd->title }}" class="w-100">
                                @elseif(in_array($ptcAd->ads_type, ['link_url', 'youtube_subscriber', 'facebook_follower', 'twitter_follower', 'instagram_follower']))
                                    <a href="{{ $ptcAd->ads_body }}" target="_blank" class="btn btn-primary">
                                        {{ __('Visit Link') }}
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- /left side --}}
                    {{-- right side --}}
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="from-group mb-2">
                                    <label for="title" class="required">{{ __('Title') }} </label>
                                    <input type="text" name="title" id="title" class="form-control"  value="{{ $ptcAd->title }}"
                                            placeholder="{{ __('Title') }}" required>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="amount" class="required">{{ __('Amount') }} </label>
                                    <div class="input-group">
                                        <input type="number" name="amount" id="amount" step="any" value="{{ $ptcAd->amount }}"
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
                                                value="{{ $ptcAd->duration }}" placeholder="{{ __('Duration') }}" required >
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('Seconds') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="max_limit" class="required">{{ __('Maximum Limit') }} </label>
                                    <div class="input-group">
                                        <input type="number" name="max_limit" id="max_limit" class="form-control"
                                                value="{{ $ptcAd->max_limit }}" placeholder="{{ __('Maximum Limit') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{ __('Times') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="from-group mb-2">
                                    <label for="status" class="required">{{ __('Status') }} </label>
                                    <select name="status" class="form-control" id="status" data-control="select2" data-placeholder="{{ __('Select Status') }}" required>
                                        <option value="1" @selected($ptcAd->status == 1)>{{ __('Active') }}</option>
                                        <option value="0" @selected($ptcAd->status == 0)>{{ __('Inactive') }}</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="from-group mb-2">
                                    <label for="ads_type" class="required">{{ __('Advertisement Type') }} </label>
                                    <select name="ads_type" class="form-control" id="ads_type" data-control="select2" data-placeholder="{{ __('Select Advertisement Type') }}" required>
                                        <option></option>
                                        <option value="link_url" @selected($ptcAd->ads_type == 'link_url')>{{ __('Link / URL') }}</option>
                                        <option value="banner_image" @selected($ptcAd->ads_type == 'banner_image')>{{ __('Banner / Image') }}</option>
                                        <option value="clickable_image" @selected($ptcAd->ads_type == 'clickable_image')>{{ __('Clikable Image') }}</option>
                                        <option value="script_code" @selected($ptcAd->ads_type == 'script_code')>{{ __('Script / Code') }}</option>
                                        <option value="embedded" @selected($ptcAd->ads_type == 'embedded')>{{ __('Embedded Code') }}</option>
                                        
                                    </select>
                                </div>

                                <div id="ads_type_body">

                                    @if($ptcAd->ads_type == 'link_url' || $ptcAd->ads_type == 'clickable_image')
                                        <div class="from-group mb-2">
                                            <label for="link_url">{{ __('Link / URL') }}</label>
                                            <input type="url" class="form-control" name="ads_body" id="link_url" value="{{ $ptcAd->ads_body }}" placeholder="https://example.com/" required>
                                        </div>
                                    @elseif($ptcAd->ads_type == 'script_code')
                                        <div class="from-group mb-2">
                                            <label for="script_code">{{ __('Script / Code') }}</label>
                                            <textarea class="form-control" name="ads_body" id="script_code" rows="5" placeholder="<script>code</script>" required>{{ $ptcAd->ads_body }}</textarea>
                                        </div>
                                    @elseif($ptcAd->ads_type == 'embedded')
                                        <div class="from-group mb-2">
                                            <label for="embedded">{{ __('Embedded Code') }}</label>
                                            <textarea class="form-control" name="ads_body" id="embedded" placeholder="<iframe...........</iframe>" required>{{ $ptcAd->ads_body }}</textarea>
                                        </div>
                                    @elseif($ptcAd->ads_type == 'youtube_subscriber')
                                        <div class="from-group mb-2">
                                            <label for="youtube_subscriber">{{ __('Youtube Channel Link') }}</label>
                                            <input type="url" class="form-control" name="ads_body" id="youtube_subscriber" value="{{ $ptcAd->ads_body }}" placeholder="https://www.youtube.com/c/channel" required>'
                                        </div>
                                    @elseif($ptcAd->ads_type == 'facebook_follower')
                                        <div class="from-group mb-2">
                                            <label for="facebook_follower">{{ __('Facebook Link') }}</label>
                                            <input type="url" class="form-control" name="ads_body" id="facebook_follower" value="{{ $ptcAd->ads_body }}" placeholder="https://www.facebook.com/abcd" required>
                                        </div>
                                    @elseif($ptcAd->ads_type == 'twitter_follower')
                                        <div class="from-group mb-2">
                                            <label for="twitter_follower">{{ __('Twitter Link') }}</label>
                                            <input type="url" class="form-control" name="ads_body" id="twitter_follower" value="{{ $ptcAd->ads_body }}" placeholder="https://www.twitter.com/abcd" required>
                                        </div>
                                    @elseif($ptcAd->ads_type == 'instagram_follower')
                                        <div class="from-group mb-2">
                                            <label for="instagram_follower">{{ __('Instagram Link') }}</label>
                                            <input type="url" class="form-control" name="ads_body" id="instagram_follower" value="{{ $ptcAd->ads_body }}" placeholder="https://www.instagram.com/abcd" required>
                                        </div>
                                    @endif
                                </div>

                                <div class="media-uploader-wrapper" >
                                    @if ($ptcAd->ads_type == 'clickable_image')
                                    {{ mediasection([
                                        'input_name' => 'image',
                                        'value' => $ptcAd->meta->value ?? null,
                                        'preview' => $ptcAd->meta->value ?? null,
                                        ]) }}
                                    @elseif ($ptcAd->ads_type == 'banner_image')
                                    {{ mediasection([
                                        'input_name' => 'image',
                                        'value' => $ptcAd->ads_body ?? null,
                                        'preview' => $ptcAd->ads_body ?? null,
                                        ]) }}
                                    @else
                                    {{ mediasection([
                                        'input_name' => 'image',
                                        'value' => $ptcAd->preview->value ?? null,
                                        'preview' => $ptcAd->preview->value ?? null,
                                        ]) }}
                                    @endif
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

@push('script')
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/ptcads/create.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpush
