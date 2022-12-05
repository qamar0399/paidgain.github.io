@extends('layouts.backend.app')

@section('title', __('All Withdraws')))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title' => request('status') ? 'Withdraw (' . request('status') . ')' : 'All Withdraw',
    ])
@endsection

@section('content')
    <div class="section-body">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('*/withdraws') && !request('status') ? 'active' : '' }}" href="{{ route('admin.withdraws.index') }}">@lang('All')
                                <span class="badge  badge-white">{{ $total_withdraws }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ route('admin.withdraws.index', ['status' => 'approved']) }}">{{ __('Approved') }}
                                <span class="badge badge-success">{{ $total_approved }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.withdraws.index', ['status' => 'pending']) }}">{{ __('Pending') }}
                                <span class="badge badge-warning">{{ $total_pending }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'rejected' ? 'active' : '' }}" href="{{ route('admin.withdraws.index', ['status' => 'rejected']) }}"> {{ __('Rejected') }} <span class="badge badge-danger">{{ $total_rejected }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.withdraws.delete') }}" class="ajaxform_with_reload">
                            @csrf
                            <div class="float-left mb-3">
                                <div class="input-group">
                                    <select class="form-control action" name="method">
                                        <option value="">{{ __('Select Action') }}</option>
                                        <option value="delete">{{ __('Delete Permanently') }}</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center table-borderless">
                                    <thead>
                                        <tr class="bg-light">
                                            <th><input type="checkbox" class="checkAll"></th>
                                            <th>{{ __('Invoice No') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Method') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Charge') }}</th>
                                            <th>{{ __('Rate') }}</th>
                                            <th>{{ __('Currency') }}</th>
                                            <th>{{ __('Status') }}</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr id="row4">
                                                <td><input type="checkbox" name="ids[]" value="{{ $withdraw->id }}"></td>
                                                <td><a href="{{ route('admin.withdraws.show',$withdraw->id) }}">{{ $withdraw->invoice_no }} <small>{{ date('d-M-y', strtotime($withdraw->created_at)) }}</small></a></td>
                                                <td><a href="  {{ url('admin/users/detail',$withdraw->user->username ?? '') }}">{{ '@'.$withdraw->user->username ?? '' }}</a></td>
                                                <td>{{ $withdraw->method->name ?? '' }}</td>
                                                <td>{{ $withdraw->amount }}</td>
                                                <td>{{ $withdraw->charge }}</td>
                                                <td>{{ $withdraw->rate }}</td>
                                                <td>{{ $withdraw->currency }}</td>
                                                <td>
                                                    @if ($withdraw->status == 'pending')
                                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                    @elseif ($withdraw->status == 'rejected')
                                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                    @elseif ($withdraw->status == 'approved')
                                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        {{ $withdraws->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
