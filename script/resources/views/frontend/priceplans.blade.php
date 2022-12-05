@extends('layouts.frontend.app')

@section('title', __('Price Plans'))

@section('content')
    <!-- Price Table Area -->
    <div class="price-table-area section-padding-100-50">
        <div class="container">
            @isset($data['price_plan'])
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ $data['price_plan']->name }}</h3>
                            <p>{{ $data['price_plan']->other }}</p>
                        </div>
                    </div>
                </div>
                @if(count($data['plans']) > 0)
                <div class="row">
                    @foreach ($data['plans'] as $plan)
                    <div class="col-md-6 col-lg-4">
                        <div class="single-price-table text-center">
                            <div class="price-title">
                                <h4>{{ $plan->name }}</h4>
                                <span>{{ $plan->days == -1 ? 'Unlimited':'Attend only '. $plan->days .' days' }}</span>
                            </div>
                            <h2 class="price-text">{{ currency_format($plan->price, 'icon') }}</h2>
                            <ul class="price-body">
                                <li><img src="{{ asset('frontend/img/icons/check.png') }}" alt=""> {{ $plan->days == -1 ? 'Unlimited Daily Ads Limit':'Daily Ad Limit '.$plan->ad_limit }} </li>
                                <li>
                                    <img src="{{ asset('frontend/img/icons/check.png') }}" alt=""> {{ __('Referral Commission Rate') }}
                                    ({{ $plan->commission_rate }}%)
                                </li>
                            </ul>
                            @guest
                                <a href="{{ route('login') }}" class="price-btn">{{ __('Subscribe Now') }}</a>
                            @else
                                <form action="{{ route('user.common.subscribe') }}" method="post" class="subscription_form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="plan" value="{{ $plan->id }}">

                                    <button type="submit" class="price-btn">{{ __('Subscribe Now') }}</button>
                                </form>
                            @endguest
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="alert alert-danger">
                    <a href="{{ route('admin.membership-plans.index') }}">
                        {{ __('Add Membership Plans') }}
                        <i class="fas fa-plus"></i>
                    </a>
                    </div>
                @endif
                @else
                <div class="alert alert-danger">
                    <a href="{{ route('admin.website.heading.index') }}">
                        {{ __('Edit Price Plan Section') }}
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            @endisset
        </div>
    </div>
    <!-- Price Table Area -->
@endsection

@push('js')
    <script src="{{ asset('frontend/js/pages/frontend/priceplans.js') }}"></script>
@endpush
