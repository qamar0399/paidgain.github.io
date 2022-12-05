@extends('layouts.frontend.app')

@section('title', __('Top Investor'))

@section('content')
    <!-- Top Investor Area -->
    <div class="top-investor-area section-padding-100-50">
        <div class="container">
            @isset($data['top_investor'])
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $data['top_investor']->name }}</h3>
                        <p>{{ $data['top_investor']->other }}</p>
                    </div>
                </div>
            </div>
            @isset($data['top_investors'])
            <div class="row">
                @foreach($data['top_investors'] as $top_investor)
                <!-- Single investor Card -->
               
                 <div class="col-sm-6  col-xl-4">
                    <div class="top-investor-card d-sm-flex align-items-center">
                        <!-- Image -->
                        <div class="investor-image">
                           <img src="{{ json_decode($top_investor->meta->value)->photo ?? null }}" alt="">
                        </div>
                        <!-- Info Text -->
                        <div class="invest-info">
                            <h4 class="">{{ $top_investor->name }} <i class="fas fa-check-circle ms-2 text-success" data-toggle="tooltip" data-placement="top" title="Verified"></i>
                            
                            </h4>
                            
                            <p class="mb-3">{{ __('Total Invested') }} : <span>{{ $top_investor->other }}</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <div class="alert alert-danger">
                    <a href="{{ route('admin.website.top-investors.index') }}"><i class="fas fa-edit"></i> {{ __('Add Investors') }}</a>
                </div>
            @endisset
            @else
                <div class="alert alert-danger">
                    <a href="{{ route('admin.website.heading.index') }}"><i class="fas fa-edit"></i> {{ __('Edit top investor section') }}</a>
                </div>
            @endisset
        </div>
    </div>
    <!-- Top Investor Area -->
@endsection
