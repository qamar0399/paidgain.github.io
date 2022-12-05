@extends('layouts.user.app')

@section('title', __('Methods List'))

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header shadow-sm">
                        <div class="row justify-content-beetween">
                            <div class="col-6">
                                <h4>{{ __('Methods List') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-borderless">
                                <thead>
                                    <tr class="bg-light">
                                        <th>{{ trans('Name') }}</th>
                                        <th>{{ __('Withdraw Limit') }}</th>
                                        <th>{{ __('Charge') }}</th>
                                        <th>{{ __('Delay') }}</th>
                                        <th>{{ trans('Status') }}</th>
                                        <th>{{ trans('Created At') }}</th>
                                        <th>{{ trans('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($methods as $method)
                                        <tr id="row4">
                                            <td>{{ $method->name }}</td>
                                            <td>{{ $method->min_limit . ' - ' . $method->max_limit }}</td>
                                            <td>{{ $method->percent_charge > 0 ? $method->percent_charge : $method->fixed_charge }}
                                            </td>
                                            <td>{{ $method->delay }}</td>
                                            <td>
                                                @if ($method->status == 1)
                                                    <span class="badge bg-success">{{ trans('Active') }}</span>
                                                @endif
                                                @if ($method->status == 0)
                                                    <span class="badge bg-danger">{{ trans('Inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d M Y', strtotime($method->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('user.withdraws.create', ['method' => $method->id, 'method_name' => $method->name]) }}"
                                                    class="btn btn-dark btn-sm">{{ trans('Transfer') }}</a>
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
