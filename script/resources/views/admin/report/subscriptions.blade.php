@extends('layouts.backend.app')

@section('title', __('Subscription Logs'))

@section('head')
@include('layouts.backend.partials.headersection',['title'=> __('Subscription Logs')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Subscription Logs') }}</h6>
               </div>
               <div class="float-right">
                  <form method="get">
                     <div class="input-group">
                        <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control" placeholder="{{ __('Search by username') }}">
                        <div class="input-group-append">
                           <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="clearfix mb-3"></div>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>{{ __('Invoice ID') }}</th>
                           <th>{{ __('User') }}</th>
                           <th>{{ __('Plan') }}</th>
                           <th>{{ __('Amount') }}</th>
                           <th>{{ __('Subscribe At') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($subscriptions as $subscription)
                         <tr>
                             <td>{{ $subscription->invoice_no }}</td>
                             <td>
                                 {{ $subscription->user->name }}
                                 <br>
                                 <a href="{{ route('admin.users.detail', $subscription->user->username) }}"><span>@</span>{{ $subscription->user->username }}</a></td>
                             <td>{{ $subscription->plan->name }}</td>
                             <td>{{ $subscription->amount }}</td>
                             <td>
                                 {{ formatted_date($subscription->created_at) }}
                                 <br>
                                 {{ $subscription->created_at->diffForHumans() }}
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                  </table>
                   {{ $subscriptions->links('vendor.pagination.bootstrap-5') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
