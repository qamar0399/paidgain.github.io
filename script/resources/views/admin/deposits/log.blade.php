@extends('layouts.backend.app')

@section('title', $title)

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> $title])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-0">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/deposits') ? 'active' : '' }}" href="{{ route('admin.deposits.all') }}">{{ __('All') }} <span class="badge {{ Request::is('admin/deposits') ? 'badge-white' : 'badge-primary' }}">{{ $all }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/deposits/pending') ? 'active' : '' }}" href="{{ route('admin.deposits.pending') }}">{{ __('Pending') }} <span class="badge {{ Request::is('admin/deposits/pending') ? 'badge-white' : 'badge-primary' }}">{{ $pending }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/deposits/approved') ? 'active' : '' }}" href="{{ route('admin.deposits.approved') }}">{{ __('Approved') }} <span class="badge {{ Request::is('admin/deposits/approved') ? 'badge-white' : 'badge-primary' }}">{{ $approved }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/deposits/rejected') ? 'active' : '' }}" href="{{ route('admin.deposits.rejected') }}">{{ __('Rejected') }} <span class="badge {{ Request::is('admin/deposits/rejected') ? 'badge-white' : 'badge-primary' }}">{{ $reject }}</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <h6 class="text-primary">{{ $title }}</h6>
                </div>
                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control"
                                    placeholder="{{ __('Search by TRX, Username') }}">
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
                            <th>{{ __('Trx') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Gateway') }}</th>
                            <th class="text-center"> {{ __('Charge') }}</th>
                            <th class="text-center">{{ __('Amount') }}</th>
                            <th class="text-center">{{ __('Date') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.deposits.detail', $deposit) }}">{{ $deposit->trx }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.detail', $deposit->user->username) }}"><span>@</span>{{ $deposit->user->username }}</a>
                                </td>
                                <td>{{ strtoupper($deposit->getway->name) }} </td>
                                <td class="font-weight-bold text-center">
                                    {{ $deposit->charge }} {{ strtoupper($deposit->getway->currency_name) }}
                                </td>
                                <td class="font-weight-bold text-center">
                                    @if($deposit->charge > 0)
                                        {{ ($deposit->amount + $deposit->charge) }} {{ strtoupper($deposit->getway->currency_name) }}
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    {{ formatted_date($deposit->created_at, 'd M, Y')  }}
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
                                    <a href="{{ route('admin.deposits.detail', $deposit) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $deposits->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
