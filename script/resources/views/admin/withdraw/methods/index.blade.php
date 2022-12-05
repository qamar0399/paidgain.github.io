@extends('layouts.backend.app')

@section('title', __('Withdrawal Methods'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title' => __('Withdrawal Methods'),
        'button_name' => __('Add New'),
        'button_link' => route('admin.withdraw-methods.create'),
    ])
@endsection

@section('content')
    <div class="section-body">
        <div class="method">
            <div class="col-12">
                <div class="card"> 
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.methods.delete') }}" class="ajaxform_with_reload">
                            @csrf
                            <div class="float-left mb-3">
                                <div class="input-group">
                                    <select class="form-control action" name="method">
                                        <option value="">{{ __('Select Action') }}</option>
                                        <option value="delete">{{ __('Delete Permanently') }}</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary basicbtn" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-2">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="checkAll"></th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Withdraw Limit') }}</th>
                                            <th>{{ __('Total Used') }}</th>
                                            <th>{{ __('Charge') }}</th>
                                            <th>{{ __('Delay') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($methods as $method)
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" value="{{ $method->id }}"></td>
                                                <td>{{ $method->name }}</td>
                                                <td>{{ $method->min_limit .' - ' . $method->max_limit }}</td>
                                                <td>{{ $method->withdraws_count }}</td>
                                                <td>{{ $method->percent_charge > 0 ? $method->percent_charge : $method->fixed_charge }}</td>
                                                <td>{{ $method->delay }} {{ __('Days') }}</td>
                                                <td>
                                                    @if ($method->status == 1)
                                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                                    @endif
                                                    @if ($method->status == 0)
                                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d M Y', strtotime($method->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.withdraw-methods.edit', $method->id) }}"
                                                        class="btn btn-primary btn-sm text-center"><i
                                                            class="far fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        {{ $methods->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
