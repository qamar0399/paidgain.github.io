@extends('layouts.backend.app')

@section('title', __('Referral Logs'))

@section('head')
@include('layouts.backend.partials.headersection',['title'=> __('Referral Logs')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Referral Logs') }}</h6>
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
                           <th>{{ __('User') }}</th>
                           <th>{{ __('Referred By') }}</th>
                           <th>{{ __('Referred At') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($referrals as $referral)
                         <tr>
                             <td>
                                 {{ $referral->user->name }}
                                 <br>
                                 <a href="{{ route('admin.users.detail', $referral->user->username) }}"><span>@</span>{{ $referral->user->username }}</a>
                             </td>
                             <td>{
                                 { $referral->user->name }}
                                 <br>
                                 <a href="{{ route('admin.users.detail', $referral->referredBy->username) }}"><span>@</span>{{ $referral->referredBy->username }}</a></td></td>
                             <td>
                                 {{ formatted_date($referral->created_at) }}
                                 <br>
                                 {{ $referral->created_at->diffForHumans() }}
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                  </table>
                   {{ $referrals->links('vendor.pagination.bootstrap-5') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
