@extends('layouts.backend.app')

@section('title','User Detail')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'User Detail'])
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Deposit') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($user->deposits_sum_amount, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Withdraw') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($user->withdraws_sum_amount, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Transaction') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ number_format($user->transactions_sum_amount, 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Clicks') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $user->viewed_ptc_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-lg-12 col-md-12">
            <div class="card overflow-hidden mt-30">
                <div class="card-header">
                     <h4>{{ __('User Information') }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Username') }}<span class="font-weight-bold"><span>@</span>{{ $user->username }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Status') }}
                            @if($user->status)
                                <span class="badge badge-pill badge-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-pill badge-secondary">{{ __('Inactive') }}</span>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Balance') }} <span class="font-weight-bold">{{ currency_format($user->balance) }}</span>
                        </li>
                        @if($user->referredBy)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Referred By') }}
                            <a href="{{ route('admin.users.detail', $user->referredBy->username) }}">{{ $user->referredBy->name }}</a>
                        </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Referral') }}
                            <span class="font-weight-bold">{{ $user->referralUsers()->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Commission') }}
                            <span class="font-weight-bold">{{ currency_format($user->referrals->sum('amount')) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('User Plan') }}<span class="font-weight-bold">
                                {{ $user->plan->name ?? __('N/A') }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <a href="#" class="btn btn-primary btn-shadow btn-block text-left col-3" data-toggle="modal"   data-target="#exampleModal">
                            <i class="fas fa-paper-plane"></i>
                            {{ __(' Send Email ') }}
                          </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
             <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Deposits vs Withdraws vs Transactions') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="collapseDepositsParent">
                    <div class="card mt-50">
                        <div class="card-header" data-toggle="collapse" data-target="#collapseDeposits" aria-expanded="true" aria-controls="collapseDeposits">
                            <h4>{{ __('History of Deposits') }}</h4>
                        </div>
                        <div id="collapseDeposits" class="collapse show" aria-labelledby="collapseDeposits" data-parent="#collapseDepositsParent">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Gateway | Trx') }}</th>
                                        <th class="text-center">{{ __('Initiated') }}</th>
                                        <th class="text-center">{{ __('Amount') }}</th>
                                        <th class="text-center"> {{ __('Conversion') }}</th>
                                        <th class="text-center">{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deposits as $deposit)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.deposits.detail', $deposit) }}" class="font-weight-bold">{{ strtoupper($deposit->getway->name) }}
                                                <br>
                                                <small> {{ $deposit->trx }} </small>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                {{ formatted_date($deposit->created_at, 'd M, Y h:i A')  }}
                                                <br>
                                                {{ $deposit->created_at->diffForHumans()  }}
                                            </td>
                                            <td class="font-weight-bold text-center">
                                                <span data-toggle="tooltip" data-placement="top" title="{{ __('Amount') }}">
                                                    {{ $deposit->amount }}
                                                </span>
                                                @if($deposit->getway->charge > 0)
                                                    +
                                                    <span class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ __('Charge') }}">
                                                        {{ $deposit->getway->charge }}
                                                    </span>
                                                    <br>
                                                    <strong data-toggle="tooltip" data-placement="top" title="{{ __('Amount with charge') }}">
                                                        {{ ($deposit->amount + $deposit->getway->charge) }} {{ strtoupper($deposit->getway->currency_name) }}
                                                    </strong>
                                                @endif
                                            </td>
                                            <td class="font-weight-bold text-center">
                                                {{ defaultcurrency()->rate .' '. str(defaultcurrency()->currency)->upper() }}
                                                =
                                                {{ number_format(getcurrencyrate($deposit->getway->rate), 2) }} {{ str($deposit->getway->currency_name)->upper() }}
                                                <br>
                                                {{ getmoney($deposit->amount + $deposit->getway->charge, $deposit->getway->rate)  }}
                                                {{ str($deposit->getway->currency_name)->upper() }}
                                            </td>
                                            <td class="text-center">
                                                @if($deposit->status == 0)
                                                    <span class="badge badge-pill badge-danger">{{ __('Failed/Cancel') }}</span>
                                                @elseif($deposit->status == 1)
                                                    <span class="badge badge-pill badge-success">{{ __('Approved') }}</span>
                                                @elseif($deposit->status == 2)
                                                    <span class="badge badge-pill badge-info">{{ __('Pending') }}</span>
                                                @elseif($deposit->status == 3)
                                                    <span class="badge badge-pill badge-warning">{{ __('Expired') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a  href="{{ route('admin.deposits.detail', $deposit) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $deposits->appends(['withdraws' => $withdraws->currentPage(), 'transactions' => $transactions->currentPage()])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="collapseWithdrawsParent">
                    <div class="card mt-50">
                        <div class="card-header"  data-toggle="collapse" data-target="#collapseWithdraws" aria-expanded="true" aria-controls="collapseWithdraws">
                            <h4>{{ __('History of Withdraws') }}</h4>
                        </div>
                        <div id="collapseWithdraws" class="collapse show" aria-labelledby="collapseWithdraws" data-parent="#collapseWithdrawsParent">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Gateway | Trx') }}</th>
                                        <th class="text-center">{{ __('Initiated') }}</th>
                                        <th class="text-center">{{ __('Amount') }}</th>
                                        <th class="text-center"> {{ __('Conversion') }}</th>
                                        <th class="text-center">{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($withdraws as $withdraw)
                                        <tr>
                                            <td>
                                                <a href="{{ url('admin/withdraws', $withdraw->id) }}"  class="font-weight-bold">{{ strtoupper($withdraw->method->name) }}
                                                <br>
                                                <small> {{ $withdraw->trx }} </small></a>
                                            </td>
                                            <td class="text-center">
                                                {{ formatted_date($withdraw->created_at, 'd M, Y h:i A')  }}
                                                <br>
                                                {{ $withdraw->created_at->diffForHumans()  }}
                                            </td>
                                            <td class="font-weight-bold text-center">
                                                <span data-toggle="tooltip" data-placement="top" title="{{ __('Amount') }}">
                                                    {{ $withdraw->amount }}
                                                </span>
                                                @if($withdraw->method->charge > 0)
                                                    +
                                                    <span class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ __('Charge') }}">
                                                        {{ $withdraw->method->charge }}
                                                    </span>
                                                    <br>
                                                    <strong data-toggle="tooltip" data-placement="top" title="{{ __('Amount with charge') }}">
                                                        {{ ($withdraw->amount + $withdraw->method->charge) }} {{ strtoupper($withdraw->method->currency) }}
                                                    </strong>
                                                @endif
                                            </td>
                                            <td class="font-weight-bold text-center">
                                                {{ defaultcurrency()->rate .' '. str(defaultcurrency()->currency)->upper() }}
                                                =
                                                {{ number_format(getcurrencyrate($withdraw->method->rate), 2) }} {{ str($withdraw->method->currency)->upper() }}
                                                <br>
                                                {{ getmoney($withdraw->amount + $withdraw->method->charge, $withdraw->method->rate)  }}
                                                {{ str($withdraw->method->currency)->upper() }}
                                            </td>
                                            <td class="text-center">
                                                @if ($withdraw->status == 'pending')
                                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                    @elseif ($withdraw->status == 'rejected')
                                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                    @elseif ($withdraw->status == 'approved')
                                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                                    @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.deposits.detail', $withdraw->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $withdraws->appends(['deposits' => $deposits->currentPage(), 'transactions' => $transactions->currentPage()])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="collapseTransactionsParent">
                    <div class="card mt-50">
                        <div class="card-header"  data-toggle="collapse" data-target="#collapseTransactions" aria-expanded="true" aria-controls="collapseTransactions">
                            <h4>{{ __('History of Transactions') }}</h4>
                        </div>
                        <div id="collapseTransactions" class="collapse show" aria-labelledby="collapseTransactions" data-parent="#collapseTransactionsParent">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Trx') }}</th>
                                        <th class="text-center">{{ __('Initiated') }}</th>
                                        <th class="text-center">{{ __('Amount') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{ $transaction->trx_id }}
                                            </td>
                                            <td class="text-center">
                                                {{ formatted_date($transaction->created_at, 'd M, Y h:i A')  }}
                                                <br>
                                                {{ $transaction->created_at->diffForHumans()  }}
                                            </td>
                                            <td class="font-weight-bold text-center">
                                                <span data-toggle="tooltip" data-placement="top" title="{{ __('Amount') }}">
                                                    {{ number_format($transaction->amount, 2) }}
                                                </span>
                                                @if($transaction->charge > 0)
                                                    +
                                                    <span class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ __('Charge') }}">
                                                        {{ number_format($transaction->charge, 2) }}
                                                    </span>
                                                    <br>
                                                    <strong data-toggle="tooltip" data-placement="top" title="{{ __('Amount with charge') }}">
                                                        {{ number_format(($transaction->amount + $transaction->charge), 2) }}
                                                    </strong>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $transactions->appends(['deposits' => $deposits->currentPage(), 'withdraws' => $withdraws->currentPage()])->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Send Mail') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="ajaxform_with_reset" action="{{ route('admin.users.send-email-to-user', $user->id) }}" method="post" id="emailForm">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="subject">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Enter email subject') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="body">{{ __('Body') }}</label>
                            <textarea name="body" id="body" class="form-control" placeholder="{{ __('Enter message') }}" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" class="btn btn-primary basicbtn" onclick="$('#emailForm').trigger('submit')">
                        <i class="fas fa-paper-plane"></i> {{ __('Send') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/assets/js/chart.min.js') }}"></script>
    <script>
        "use strict";
        var labels = {{ Js::from($labels) }};
        var deposit_data =  {{ Js::from($deposit_data) }};
        var withdraw_data =  {{ Js::from($withdraw_data) }};
        var transaction_data =  {{ Js::from($transaction_data) }};
    </script>
    <script src="{{ asset('admin/js/pages/users/details.blade.js') }}"></script>
@endpush
