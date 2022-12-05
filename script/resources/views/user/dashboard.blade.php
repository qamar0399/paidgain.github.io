@extends('layouts.user.app')

@section('content')
 <!-- Dashboard Area -->
 <div class="dashboard-card-area">
    <div class="container">
        <div class="row">
            @php
     $date= \Carbon\Carbon::now()->addDays(7)->format('Y-m-d');
     $will_expire=Auth::user()->will_expire;

    @endphp

    @if($will_expire == null || $will_expire == '')
    <div class="col-md-12">
        <div class="alert alert-warning">
             {{ __('Please Enroll a subscription from this') }} 
            
           
             <ins><a target="_blank" class="text" href="{{ url('/pricing') }}">{{ __('link') }}</a></ins> 
        </div>
    </div>
    @elseif($will_expire <= $date && $will_expire != '0000-00-00')
    <div class="col-md-12">
        <div class="alert alert-warning">
             {{ __('Your subscription is ending in') }} 
            
             {{ \Carbon\Carbon::parse($will_expire)->diffForHumans() }}
            {{ __('Please') }} <ins><a target="_blank" class="text" href="{{ url('/pricing') }}">{{ __('renew') }}</a></ins> {{ __('the plan!') }}
        </div>
    </div>
    @elseif($will_expire <= now())
    <div class="col-md-12">
        <div class="alert alert-warning">
             {{ __('Your subscription was expired at') }} 
            
             {{ \Carbon\Carbon::parse($will_expire)->diffForHumans() }}
            {{ __('Please') }} <ins><a target="_blank" class="text" href="{{ url('/pricing') }}">{{ __('renew') }}</a></ins> {{ __('the plan!') }}
        </div>
    </div>
    @endif
            <div class="col-12">
                <h2 class="dashboard-title">{{ __('Dashboard') }} </h2>
            </div>
            <!-- Dashboard Single Card  -->
            <div class="col-md-6 col-xl-4">
                <div class="dashboard-single-card d-flex align-items-center justify-content-between">
                    <!-- Image -->
                    <div class="image">
                        <img src="{{ asset('frontend/img/icons/d-1.png') }}" alt="">
                    </div>
                    <!-- Text -->
                    <div class="dashboard-single-card-text">
                        <h4>{{ __('Current Balance') }}</h4>
                        <h2>{{ currency_format(Auth::user()->balance) }}</h2>
                    </div>
                </div>
            </div>
            <!-- Dashboard Single Card  -->
            <div class="col-md-6 col-xl-4">
                <div
                    class="dashboard-single-card d-flex align-items-center justify-content-between">
                    <!-- Image -->
                    <div class="image">
                        <img src="{{ asset('frontend/img/icons/d-2.png') }}" alt="">
                    </div>
                    <!-- Text -->
                    <div class="dashboard-single-card-text">
                        <h4>{{ __('Total Deposit') }}</h4>
                        <h2>{{ currency_format($total_deposit) }}</h2>
                    </div>
                </div>
            </div>
            <!-- Dashboard Single Card  -->
            <div class="col-md-6 col-xl-4">
                <div
                    class="dashboard-single-card d-flex align-items-center justify-content-between">
                    <!-- Image -->
                    <div class="image">
                        <img src="{{ asset('frontend/img/icons/d-3.png') }}" alt="">
                    </div>
                    <!-- Text -->
                    <div class="dashboard-single-card-text">
                        <h4>{{ __('Total Withdraw') }}</h4>
                        <h2>{{ currency_format($total_withdraw) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Area -->

 <div class="container">
     <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="card">
                 <div class="card-header">
                     <canvas id="myChart" width="400" height="400"></canvas>
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="dashboard-single-card d-flex align-items-center justify-content-between">
                 <!-- Image -->
                 <div class="image">
                     <img src="{{ asset('frontend/img/icons/d-1.png') }}" alt="">
                 </div>
                 <!-- Text -->
                 <div class="dashboard-single-card-text">
                     <h4>{{ __('Total Clicks') }}</h4>
                     <h2>{{ $ptc_user[0]['total_click'] ?? 0 }}</h2>
                 </div>
             </div>

             <div class="dashboard-single-card d-flex align-items-center justify-content-between">
                 <!-- Image -->
                 <div class="image">
                     <img src="{{ asset('frontend/img/icons/d-1.png') }}" alt="">
                 </div>
                 <!-- Text -->
                 <div class="dashboard-single-card-text">
                     <h4>{{ __('Today Clicks') }}</h4>
                     <h2>{{ $today_clicks }}</h2>
                 </div>
             </div>
             <div class="dashboard-single-card d-flex align-items-center justify-content-between">
                 <!-- Image -->
                 <div class="image">
                     <img src="{{ asset('frontend/img/icons/d-1.png') }}" alt="">
                 </div>
                 <!-- Text -->
                 <div class="dashboard-single-card-text">
                     <h4>{{ __('Remain Clicks For Today') }}</h4>
                     <h2>{{ $remain_clicks }}</h2>
                 </div>
             </div>
         </div>
     </div>
 </div>

<!-- Transaction Area -->
<div class="transction-area section-padding-0-100 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('All Transaction') }}</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">{{ __('Trx ID') }}</th>
                                        <th class="align-middle">{{ __('Amount') }}</th>
                                        <th class="align-middle">{{ __('Date') }}</th>
                                        <th class="align-middle">{{ __('Charge') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->trx_id }}</td>
                                        <td>{{ currency_format($transaction->amount) }}</td>
                                        <td>
                                            {{ $transaction->created_at->toDateString() }}
                                        </td>
                                        <td>
                                            {{ currency_format($transaction->charge) }}
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
    <script src="{{ asset('admin/assets/js/chart.min.js') }}"></script>
    <script>
        "use strict";
        var clicks = {{ Js::from($ptc_user[0]['total_click'] ?? 0) }};
        var earnings = {{ Js::from($ptc_user[0]['total_earning'] ?? 0) }};
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Click', 'Earning'],
                datasets: [{
                    label: 'Click',
                    data: [clicks, earnings],
                    borderColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            }
        });
    </script>
@endpush
