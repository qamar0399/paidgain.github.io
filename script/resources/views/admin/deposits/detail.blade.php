@extends('layouts.backend.app')

@section('title', __('Deposits'))

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> __('Deposits')])
@endsection

@section('content')
<div class="row mb-none-30">
    <div class="col-lg-8 offset-lg-2 mb-30">
        <div class="card b-radius-10 overflow-hidden box-shadow1">
            <div class="card-body">
                <h5 class="mb-20 text-muted">{{ __('Deposit Via') }} {{ ucfirst($deposit->getway->name) }}</h5>
                <div class="p-3 bg-white">
                    <img src="{{ asset($deposit->getway->logo) }}" alt="{{ __('Gate way image') }}" class="img-fluid circle">
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Date') }} <span class="font-weight-bold">{{ formatted_date($deposit->created_at, 'd M, Y') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Transaction Number') }} <span class="font-weight-bold">{{ $deposit->trx }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Username') }} <span class="font-weight-bold">
                            <a href="{{ route('admin.users.detail', $deposit->user_id) }}"><span>@</span>{{ $deposit->user->username }}</a>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Method') }}<span class="font-weight-bold">{{ ucfirst($deposit->getway->name) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Amount') }} <span class="font-weight-bold">{{ number_format($deposit->amount, 2) }} {{ str($deposit->getway->currency_name)->upper() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Charge') }} <span class="font-weight-bold">{{ number_format($deposit->charge, 2) }} {{ str($deposit->getway->currency_name)->upper()  }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('After Charge ') }} <span class="font-weight-bold">{{ number_format($deposit->amount + $deposit->charge, 2) }} {{ str($deposit->getway->currency_name)->upper() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Rate') }}
                        <span class="font-weight-bold">
                            {{ defaultcurrency()->rate .' '. str(defaultcurrency()->currency)->upper() }}
                            =
                            {{ number_format(getcurrencyrate($deposit->rate), 2) }} {{ str($deposit->getway->currency_name)->upper() }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Payable') }} <span class="font-weight-bold">
                            {{ getmoney($deposit->amount + $deposit->charge, $deposit->rate)  }}
                            {{ str($deposit->getway->currency_name)->upper() }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Status') }}
                        @if($deposit->status == 0)
                            <span class="badge badge-pill badge-danger">{{ __('Failed/Cancel') }}</span>
                        @elseif($deposit->status == 1)
                            <span class="badge badge-pill badge-success">{{ __('Paid') }}</span>
                        @elseif($deposit->status == 2)
                            <span class="badge badge-pill badge-info">{{ __('Pending') }}</span>
                        @elseif($deposit->status == 4)
                            <span class="badge badge-pill badge-danger">{{ __('Expired') }}</span>
                        @endif
                    </li>
                    @if(!empty($deposit->depositmeta))
                    @php
                    $meta=json_decode($deposit->depositmeta->value);

                    @endphp

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Attachment') }} <span class="font-weight-bold">
                            <a href="{{ asset($meta->screenshot ?? '#') }}">{{ __('View Attachment') }}</a>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Comment') }} <span class="font-weight-bold">
                            {{ $meta->comment ?? '' }}
                        </span>
                    </li>
                    @endif

                    <form method="post" class="ajaxform" action="{{ url('admin/deposits/update',$deposit->id) }}">
                        @csrf
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Payment Status') }} <span class="font-weight-bold">
                           <select class="form-control" name="payment_status">
                               <option value="1" @if($deposit->payment_status == 1) selected  @endif>{{ __('Approved') }}</option>
                               <option value="2" @if($deposit->payment_status == 2) selected  @endif>{{ __('Pending') }}</option>
                               <option value="0" @if($deposit->payment_status == 0) selected  @endif>{{ __('Failed') }}</option>
                           </select>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Deposit Status') }} <span class="font-weight-bold">
                           <select class="form-control" name="status">
                               <option value="1" @if($deposit->status == 1) selected  @endif>{{ __('Approved') }}</option>
                               <option value="2" @if($deposit->status == 2) selected  @endif>{{ __('Pending') }}</option>
                               <option value="0" @if($deposit->status == 0) selected  @endif>{{ __('Failed') }}</option>
                           </select>
                        </span>
                    </li>

                     <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Add Balance to the user?') }} <span class="font-weight-bold">
                           <select class="form-control" name="balance">
                               <option value="1" >{{ __('Yes') }}</option>
                               <option value="0" selected="">{{ __('No') }}</option>
                              
                           </select>
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                           <button class="btn btn-primary col-12 basicbtn" type="submit">{{ __('Update') }}</button>
                           
                        </span>
                    </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
