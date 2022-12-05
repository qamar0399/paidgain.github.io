@extends('layouts.frontend.app')

@section('title', __('Earn Money'))

@section('content')
    <!-- View Add Area -->
    <div class="view-add-area section-padding-100-50">
        <div class="container">
            @isset($data['earn_money'])
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-7">
                        <div class="heading-title text-center">
                            <h3>{{ $data['earn_money']->name }}</h3>
                            <p>{{ $data['earn_money']->other }}</p>
                        </div>
                    </div>
                </div>
                @if(isset($data['advertisements']) && count($data['advertisements']) > 0)
                    <!-- Add Area -->
                    <div class="row">
                        @foreach($data['advertisements'] as $ad)
                            <div class="col-md-6 col-lg-4">
                                <!-- Single Add Card -->
                                <div class="single-add-area d-sm-flex align-items-center">
                                    <div class="earn-image">
                                        @if($ad->ads_type == 'clickable_image')
                                            <img src="{{ asset($ad->meta->value) }}" alt="">
                                        @elseif($ad->ads_type == 'banner_image')
                                            <img src="{{ asset($ad->meta->value) }}" alt="">
                                        @else
                                            <img src="{{ asset($ad->meta->value) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="earn-content-text">
                                        <h4>{{ $ad->title }} </h4>
                                        <h6>{{ __('Earn') }} : {{ currency_format($ad->amount) }}</h6>
                                        <a class="add-btn-2" href="{{ auth()->check() ? route('user.ads.show', encrypt($ad->id)) : route('login') }}#">{{ __('View Add') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        {{ __('Advertisement not found!') }}
                    </div>
                @endisset
            @else
                <div class="alert alert-danger">
                    {{ __('If you are admin please add information') }}
                    <a href="{{ route('admin.website.heading.index') }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                </div>
            @endisset
        </div>
    </div>
@endsection
