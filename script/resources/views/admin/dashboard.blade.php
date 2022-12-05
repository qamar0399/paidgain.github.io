@extends('layouts.backend.app')

@section('title', __('Dashboard'))

@section('content')
<section class="section">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-primary">
					<i class="fas fa-users"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Customers') }}</h4>
					</div>
					<div class="card-body" id="total_customers">
						<img src="{{ asset('uploads/loader.gif') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-danger">
					<i class="fas fa-wallet"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Deposits') }}</h4>
					</div>
					<div class="card-body" id="total_deposits">
						<img src="{{ asset('uploads/loader.gif') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-warning">
					<i class="fas fa-hand-holding-usd"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Withdraws') }}</h4>
					</div>
					<div class="card-body" id="total_withdraws">
						<img src="{{ asset('uploads/loader.gif') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-success">
					<i class="fas fa-receipt"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Total Subscriptions') }}</h4>
					</div>
					<div class="card-body" id="total_subscriptions">
						<img src="{{ asset('uploads/loader.gif') }}">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="card card-statistic-2">
				<div class="card-stats">
					<div class="card-stats-title">{{ __('Withdraws Statistics') }} -
						<div class="dropdown d-inline">
							<a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="withdraw_month" id="withdraw_month">{{ Date('F') }}</a>
							<ul class="dropdown-menu dropdown-menu-sm">
								<li class="dropdown-title">{{ __('Select Month') }}</li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'January') active @endif" data-month="January" >{{ __('January') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'February') active @endif" data-month="February" >{{ __('February') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'March') active @endif" data-month="March" >{{ __('March') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'April') active @endif" data-month="April" >{{ __('April') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'May') active @endif" data-month="May" >{{ __('May') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'June') active @endif" data-month="June" >{{ __('June') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'July') active @endif" data-month="July" >{{ __('July') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'August') active @endif" data-month="August" >{{ __('August') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'September') active @endif" data-month="September" >{{ __('September') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'October') active @endif" data-month="October" >{{ __('October') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'November') active @endif" data-month="November" >{{ __('November') }}</a></li>
								<li><a href="#" class="dropdown-item month @if(Date('F') == 'December') active @endif" data-month="December" >{{ __('December') }}</a></li>
							</ul>
						</div>
					</div>
					<div class="card-stats-items">
						<div class="card-stats-item">
							<div class="card-stats-item-count" id="pending_withdraw"></div>
							<div class="card-stats-item-label">{{ __('Pending') }}</div>
						</div>
						<div class="card-stats-item">
							<div class="card-stats-item-count" id="approved_withdraw"></div>
							<div class="card-stats-item-label">{{ __('Approved') }}</div>
						</div>
						<div class="card-stats-item">
							<div class="card-stats-item-count" id="expired_withdraw"></div>
							<div class="card-stats-item-label">{{ __('Expired') }}</div>
						</div>
					</div>
				</div>
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-hand-holding-usd"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Total Withdraws') }}</h4>
					</div>
					<div class="card-body" id="total_withdraw">

					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="card card-statistic-2">
				<div class="card-chart">
					<canvas id="deposit_chart" height="80"></canvas>
				</div>
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-wallet"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Total deposits this year') }} - {{ date('Y') }}</h4>
					</div>
					<div class="card-body" id="total_deposits_of_this_year">
						<img src="{{ asset('uploads/loader.gif') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="card card-statistic-2">
				<div class="card-chart">
					<canvas id="withdraw_chart" height="80"></canvas>
				</div>
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-shopping-bag"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ __('Total withdraws this year') }} - {{ date('Y') }}</h4>
					</div>
					<div class="card-body" id="total_withdraws_of_this_year">
						<img src="{{ asset('uploads/loader.gif') }}" class="loads">
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('Deposits') }} <img src="{{ asset('uploads/loader.gif') }}" height="20" id="deposit_performance"></h4>
                    <div class="card-header-action">
                        <select class="form-control" id="deposit_performance_dropdown">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="15">{{ __('Last 15 Days') }}</option>
                            <option value="30">{{ __('Last 30 Days') }}</option>
                            <option value="365">{{ __('Last 365 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="deposit_performance_chart" height="145"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('Withdraw') }} <img src="{{ asset('uploads/loader.gif') }}" height="20" id="withdraw_performance"></h4>
                    <div class="card-header-action">
                        <select class="form-control" id="withdraw_performance_dropdown">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="15">{{ __('Last 15 Days') }}</option>
                            <option value="30">{{ __('Last 30 Days') }}</option>
                            <option value="365">{{ __('Last 365 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="withdraw_performance_chart" height="145"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        <a href="{{ route('admin.deposits.all') }}">{{ trans('Recent Deposits') }}</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap card-table text-center">
                            <thead>
                            <tr>
                                <th>{{ trans('User') }}</th>
                                <th>{{ trans('Method') }}</th>
                                <th>{{ trans('TRX') }}</th>
                                <th>{{ trans('Amount') }}</th>
                                <th>{{ trans('Currency') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th>{{ trans('Payment Status') }}</th>
                                <th>{{ trans('Deposit At') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_deposits as $deposit)
                                <tr>
                                    <td><a href="{{ route('admin.users.detail', $deposit->user->username) }}">{{ '@'.$deposit->user->name }}</a></td>
                                    <td>{{ $deposit->getway->name }}</td>
                                    <td><a href="{{ url('/admin/deposits/detail',$deposit->id) }}">{{ $deposit->trx }}</a></td>
                                    <td>{{ currency_format($deposit->amount) }}</td>
                                    <td>{{ strtoupper($deposit->currency) }}</td>
                                    <td>
                                        @if($deposit->status == 1)
                                            <span class="badge badge-success">{{ trans('Success') }}</span>
                                        
                                        @elseif($deposit->status == 2)
                                            <span class="badge badge-warning">{{ trans('Pending') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ trans('Failed') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($deposit->payment_status == 1)
                                            <span class="badge badge-success">{{ trans('Success') }}</span>
                                        @elseif($deposit->payment_status == 2)
                                            <span class="badge badge-warning">{{ trans('Pending') }}</span>    
                                        @else
                                            <span class="badge badge-warning">{{ trans('Failed') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $deposit->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">
                        <a href="{{ route('admin.withdraws.index') }}">{{ trans('Recent Withdraws') }}</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap card-table text-center">
                            <thead>
                            <tr>
                            	<th>{{ __('Invoice No') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Method') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Currency') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Withdraw At') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_withdraws as $withdraw)
                                <tr>
                                	<td><a href="{{ route('admin.withdraws.show',$withdraw->id) }}">{{ $withdraw->invoice_no }} <small>{{ date('d-M-y', strtotime($withdraw->created_at)) }}</small></a></td>
                                    <td>
                                        <a href="{{ route('admin.users.detail', $withdraw->user->username) }}">{{ '@'.$withdraw->user->name }}</a>
                                    </td>
                                    <td>{{ $withdraw->method->name }}</td>
                                    <td>{{ currency_format($withdraw->amount) }}</td>
                                    <td>{{ strtoupper($withdraw->currency) }}</td>
                                    <td>
                                        @if($withdraw->status == 'approved')
                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                        @elseif($withdraw->status == 'pending')
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @elseif($withdraw->status == 'rejected')
                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                        @elseif($withdraw->status == 'failed')
                                            <span class="badge badge-secondary">{{ __('Failed') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $withdraw->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Site Analytics') }}</h4>
				<div class="card-header-action">
					<select class="form-control" id="days"> 
						<option value="7">{{ __('Last 7 Days') }}</option>
						<option value="15">{{ __('Last 15 Days') }}</option>
						<option value="30">{{ __('Last 30 Days') }}</option>
						<option value="180">{{ __('Last 180 Days') }}</option>
						<option value="365">{{ __('Last 365 Days') }}</option>
					</select>
				</div>
			</div>
			<div class="card-body">
				<canvas id="google_analytics" height="120"></canvas>
				<div class="statistic-details mt-sm-4">
					<div class="statistic-details-item">

						<div class="detail-value" id="total_visitors"></div>
						<div class="detail-name">{{ __('Total Vistors') }}</div>
					</div>
					<div class="statistic-details-item">

						<div class="detail-value" id="total_page_views"></div>
						<div class="detail-name">{{ __('Total Page Views') }}</div>
					</div>

					<div class="statistic-details-item">

						<div class="detail-value" id="new_vistors"></div>
						<div class="detail-name">{{ __('New Visitor') }}</div>
					</div>

					<div class="statistic-details-item">

						<div class="detail-value" id="returning_visitor"></div>
						<div class="detail-name">{{ __('Returning Visitor') }}</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="card">
					<div class="card-header">
						<h4>{{ __('Referral URL') }}</h4>
					</div>
					<div class="card-body refs" id="refs" >

					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4>{{ __('Top Browser') }}</h4>
					</div>
					<div class="card-body">
						<div class="row" id="browsers"></div>
					</div>
				</div>

			</div>

			<div class="col-lg-6 col-md-6 col-12">
				<div class="card">
					<div class="card-header">
						<h4>{{ __('Top Most Visit Pages') }}</h4>
					</div>
					<div class="card-body tmvp" id="table-body">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="site_url" value="{{ url('/') }}">
<input type="hidden" id="dashboard_static" value="{{ url('admin/dashboard/static') }}">
<input type="hidden" id="dashboard_withdraw_statistics" value="{{ url('/admin/dashboard/withdraw-statistics') }}">
<input type="hidden" id="dashboard_deposit_performance" value="{{ url('/admin/dashboard/performance/deposit') }}">
<input type="hidden" id="dashboard_withdraw_performance" value="{{ url('/admin/dashboard/performance/withdraw') }}">
<input type="hidden" id="dashboard_transaction_performance" value="{{ url('/admin/dashboard/performance/transaction') }}">
<input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
<input type="hidden" id="month" value="{{ date('F') }}">
@endsection

@push('script')
<script src="{{ asset('admin/assets/js/chart.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/js/dashboard.js') }}"></script>
@endpush
