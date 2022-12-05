@extends('layouts.user.app')

@section('content')
    <div class="section-body pb-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header shadow-sm">
                        <div class="row justify-content-beetween">
                            <div class="col-6">
                                <h4><span class="text-capitalize">{{ request('status') }}</span> Withdraws List</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-borderless">
                                <thead>
                                    <tr class="bg-light">
                                        <th>#</th>
                                        <th>{{ __('Method') }}</th>
                                        <th>{{ __('Date') }}</th>
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
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ optional($withdraw->method)->name }}</td>
                                            <td>{{ date('d M y', strtotime($withdraw->created_at)) }}</td>
                                            <td>{{ $withdraw->amount }}</td>
                                            <td>{{ $withdraw->charge }}</td>
                                            <td>{{ $withdraw->rate }}</td>
                                            <td>{{ $withdraw->currency }}</td>
                                            <td>
                                                @if ($withdraw->status == 'pending')
                                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                                @elseif ($withdraw->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approved') }}</span>
                                                @elseif ($withdraw->status == 'rejected')
                                                    <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
