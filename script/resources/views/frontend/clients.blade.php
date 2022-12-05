@extends('layouts.frontend.app')

@section('title', __('Clients'))

@section('content')
    <!-- Client Review Area -->
    <div class="client-review-area section-padding-50">
        <div class="container">
            @isset($heading)
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $heading->name ?? null }}</h3>
                        <p>{{ $heading->other ?? null }}</p>
                    </div>
                </div>
            </div>
            @endisset
            <!-- Single review card -->
            @foreach ($reviews as $review)
            <div class="single-client-review-card">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <!-- Image -->
                        <div class="client-image">
                            <img src="{{ asset(optional($review->preview)->value) }}" alt="">
                        </div>
                    </div>
                    <!-- Text Content Text -->
                    <div class="col-md-8">
                        <div class="client-content-text">
                            <div class="client-info d-sm-flex justify-content-between">
                                <h2>{{ $review->name }}</h2>
                                <h5 class="rating-text">{{ __('Rating :') }} <span>{{ $review->slug }} / 5</span></h5>
                            </div>
                            <p>{{ optional($review->description)->value }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Pagination Area -->
            <div class="row">
                <div class="col-12">
                    <div class="pagination-area mb-50">
                        {{ $reviews->links('frontend.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Client Review Area -->
@endsection
