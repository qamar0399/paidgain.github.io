@extends('layouts.backend.app')

@section('title', __('Withdraws')))

@section('head')
@include('layouts.backend.partials.headersection', [
'title' => __('Withdraw'),
'prev'=>route('admin.withdraws.index')
])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">

                        <tbody>
                            <tr>
                                <td>{{ __('Invoice No:') }}</td>
                                <td>{{ $info->invoice_no }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Username') }}</td>
                                <td><a href="{{ url('admin/users/detail',$info->user->username) }}">{{ '@'.$info->user->username }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ __('Requested At:') }}</td>
                                <td>{{ date('d-M-Y', strtotime($info->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Method') }}</td>
                                <td>{{ $info->method->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Amount') }}</td>
                                <td>{{ number_format($info->amount,2)  }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Charge') }}</td>
                                <td>{{ number_format($info->charge,2)  }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Currency Rate') }}</td>
                                <td>{{ number_format($info->rate,2)  }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Currency') }}</td>
                                <td>{{ $info->currency  }}</td>
                            </tr>
                           <form method="post" action="{{ route('admin.withdraws.update',$info->id) }}" class="ajaxform">
                            @csrf
                            @method('PUT')
                            <tr>
                                <td>{{ __('Status') }}</td>
                                <td><select class="form-control" name="status">
                                    <option value="pending" @if($info->status == 'pending') selected @endif>{{ __('Pending') }}</option>
                                    <option value="approved" @if($info->status == 'approved') selected @endif>{{ __('Completed') }}</option>
                                    <option value="rejected" @if($info->status == 'rejected') selected @endif>{{ __('Rejected') }}</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="btn btn-primary basicbtn">{{ __('Update') }}</button></td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                {{ __('Withdraw Details') }}
            </div>
            <div class="card-body">
              {{ $info->comment  }}
            </div>
        </div>
    </div>    
</div>
@endsection