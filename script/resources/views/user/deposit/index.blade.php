@extends('layouts.user.app')

@section('title', __('Deposit'))

@section('content')
 <!-- Dashboard Area -->
 <div class="dashboard-card-area">
    <div class="container">
        <div class="row">
            <!-- Dashboard Single Card  -->
            <div class="col-md-6 col-xl-4">
                <div
                    class="dashboard-single-card d-flex align-items-center justify-content-between">
                    <!-- Image -->
                    <div class="image">
                        <img src="{{ asset('frontend/img/icons/d-1.png') }}" alt="">
                    </div>
                    <!-- Text -->
                    <div class="dashboard-single-card-text">
                        <h4>{{ __('Current Balance') }}</h4>
                        <h2>{{ currency_format(Auth::user()->balance,'icon') }}</h2>
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
                        <h2>{{ currency_format($total_deposit,'icon') }}</h2>
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
                        <h4>{{ __('Pending Deposit') }}</h4>
                        <h2>{{ currency_format($total_pending_deposit,'icon') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Area -->

<!-- Transaction Area -->
<div class="transction-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between w-100 align-items-center mb-4">
                            <h4 class="card-title">{{ __('All Transaction') }} </h4>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn_deposit"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/dep.png') }}" alt="">{{ __('Make Deposit') }}</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">{{ __('Trx ID') }}</th>
                                        <th class="align-middle">{{ __('Amount') }}</th>
                                        <th class="align-middle">{{ __('Date') }}</th>
                                        <th class="align-middle">{{ __('Fee') }}</th>
                                        <th class="align-middle">{{ __('Conversion') }}</th>
                                        <th class="align-middle">{{ __('Payment Method') }}</th>
                                        <th class="align-middle">{{ __('Status') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deposits as $deposit)
                                    <tr>

                                        <td>{{ $deposit->trx }}</td>
                                        <td>{{ currency_format($deposit->amount) }}</td>
                                        <td>{{ $deposit->created_at->format('d F, y') }}</td>
                                        <td>{{ number_format($deposit->charge,2) }} ({{ $deposit->currency }}</td>
                                        <td>
                                            {{ defaultcurrency()->rate .' '. str(defaultcurrency()->currency)->upper() }}
                                            =
                                            {{ number_format(getcurrencyrate($deposit->rate), 2) }} {{ str($deposit->getway->currency_name)->upper() }}
                                            <br>
                                            {{ getmoney($deposit->amount + $deposit->charge, $deposit->rate)  }}
                                            {{ str($deposit->getway->currency_name)->upper() }}
                                        </td>
                                        <td>{{ $deposit->getway->name ?? '' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $deposit->status == 1 ? 'success' : 'warning' }}">
                                                {{ $deposit->status == 1 ? 'Complete' : 'Pending' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                             <div class="mt-2">
                                 {{ $deposits->links('vendor.pagination.bootstrap-5') }}
                             </div>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Transaction Area -->

<!-- Modal -->

@endsection
@section('extra')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form class="ajaxform_with_next" action="{{ route('user.deposit.store') }}" method="POST">
            @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Make Deposit') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <label class="text-dark">{{ __('Amount') }} ({{ get_option('currency_info',true)->name }})</label>
            <input type="number" step="any" name="amount" class="form-control" min="1" required="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary basicbtn">{{ __('Deposit') }}</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
    @if(session('message'))
    <script>
        Sweet('success', '{{ session('message') }}')
    </script>
    @endif
@endpush
