@extends('layouts.frontend.app')

@section('title', __('About'))

@section('content')
    <!-- About Us Area -->
    <div class="about-us-area section-padding-100-50">
        <div class="container">
            @isset($data['about'])
            <div class="row align-items-center">
                <!-- About Text -->
                <div class="col-lg-6">
                    <div class="about-us-text mb-50">
                        <h5>{{ __('About Us') }}</h5>
                        <h2>{{ $data['about']->title ?? null }}</h2>
                        {{ content_format($data['about']->description->value ?? null) }}
                    </div>
                </div>
                <!-- About Image -->
                <div class="col-lg-6">
                    <div class="about-image mb-50">
                        <img src="{{ $data['about']->preview->value ?? null}}" alt="">
                    </div>
                </div>
            </div>
            @else
               @if (Auth::user()->role == 'admin')
                    <div class="alert alert-danger">
                        <a href="{{ route('admin.website.about.index') }}">
                            {{ __('Edit About Section') }} <i class="fas fa-edit"></i>
                        </a>
                    </div>
               @endif
            @endisset
        </div>
    </div>
    <!-- About Us Area -->

    <!-- Team Area Css -->
    <div class="team-area section-padding-0-100">
        <div class="container">
            @isset($data['our_team'])
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ optional($data['our_team'])->name }}</h3>
                            <p>{{ optional($data['our_team'])->other }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                @foreach($data['members'] as $member)
                    <!-- Single Card -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="single-team-member">
                            <!-- Member Image -->
                            <div class="team-image">
                                <img src="{{ json_decode($member->meta->value)->image ?? null }}" alt="">
                            </div>
                            <!-- teax -->
                            <div class="team-content-text">
                                <h5>{{ $member->name }}</h5>
                                <p>{{ $member->other }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @else
                <div class="alert alert-danger">
                    <a href="{{ route('admin.website.heading.index') }}">
                        {{ __('Edit Our Team Section') }} <i class="fas fa-edit"></i>
                    </a>
                </div>
            @endisset
        </div>
    </div>
    <!-- Team Area Css -->
@endsection
