@extends('layouts.user.app')

@section('title', __('Subscription Plans'))

@section('content')
    <!-- Transaction Area -->
    <div class="transction-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('Available Subscription Plans') }}</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">{{ __('Name') }}</th>
                                        <th class="align-middle">{{ __('Price') }}</th>
                                        <th class="align-middle">{{ __('Ad Limit') }}</th>
                                        <th class="align-middle">{{ __('Period') }}</th>
                                        <th class="align-middle">{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ currency_format($plan->price) }}</td>
                                            <td>{{ $plan->ad_limit }}</td>
                                            <td>
                                                @if($plan->days == "-1")
                                                    {{ __('Unlimited') }}
                                                @else
                                                    {{ $plan->days }}
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $date= \Carbon\Carbon::now()->format('Y-m-d');
                                                    $will_expire=Auth::user()->will_expire;
                                                @endphp

                                                @if($plan->id == auth()->user()->plan_id)

                                                @if ($will_expire <= $date && $will_expire != '0000-00-00')
                                                <form action="{{ route('user.common.subscribe') }}" method="post" class="subscription_form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="plan" value="{{ $plan->id }}">
                                                    <button class="btn btn-success">{{ __('Renew Now') }}</button>
                                                </form>
                                                @else    
                                                <button class="btn btn-secondary" disabled>{{ __('Subscribed') }}</button>
                                                @endif
                                                    
                                                @else
                                                    <form action="{{ route('user.common.subscribe') }}" method="post" class="subscription_form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="plan" value="{{ $plan->id }}">

                                                        <button class="btn btn-success">{{ __('Subscribe Now') }}</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transaction Area -->
@endsection

@push('js')
    <script src="{{ asset('frontend/js/pages/user/plans/index.js') }}"></script>
@endpush
