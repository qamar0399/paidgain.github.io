@extends('layouts.user.app')

@section('title', __('Transactions'))

@section('content')
    <!-- Transaction Area -->
    <div class="transction-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('Transactions') }}</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">{{ __('TRX ID') }}</th>
                                        <th class="align-middle">{{ __('Amount') }}</th>
                                        <th class="align-middle">{{ __('Charge') }}</th>
                                        <th class="align-middle">{{ __('Created At') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->trx_id }}</td>
                                            <td>{{ currency_format($transaction->amount) }}</td>
                                            <td>{{ $transaction->charge }}</td>
                                            <td>{{ formatted_date($transaction->created_at) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                            <div class="mt-2">
                                {{ $transactions->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transaction Area -->
@endsection

@push('js')
    <script src="{{ asset('frontend/js/pages/user/transactions/index.js') }}"></script>
@endpush
