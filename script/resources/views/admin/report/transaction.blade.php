@extends('layouts.backend.app')

@section('title', __('Transaction Logs'))

@section('head')
@include('layouts.backend.partials.headersection',['title'=> __('Transaction Logs')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Transaction Logs') }}</h6>
               </div>
               <div class="float-right">
                  <form method="get">
                     <div class="input-group">
                        <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control" placeholder="search...">
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
                           <th>{{ __('Trx') }}</th>
                           <th>{{ __('Transacted') }}</th>
                           <th>{{ __('Post Balance') }}</th>
                           <th>{{ __('Amount') }}</th>
                           <th>{{ __('Detail') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($transactions as $transaction)
                         <tr>
                             <td>
                                 {{ $transaction->user->name }}
                                 <br>
                                 <a href="{{ route('admin.users.detail', $transaction->user->username) }}">
                                     <span>@</span>{{ $transaction->user->username }}
                                 </a>
                             </td>
                             <td>{{ $transaction->trx_id }}</td>
                             <td>
                                 {{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}
                                 <br>
                                 {{ $transaction->created_at->diffForHumans() }}
                             </td>
                             <td>+ {{ number_format($transaction->user->balance, 2) }}</td>
                             <td>{{ number_format($transaction->amount, 2) }}</td>
                             <td>-</td>
                         </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
