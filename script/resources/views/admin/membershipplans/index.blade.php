@extends('layouts.backend.app')

@section('title','Membership Plans')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Membership Plans', 'button_name'=>'Add New','button_link'=>route('admin.membership-plans.create')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="post" action="{{ route('admin.membership-plans.delete') }}">
                @csrf
                @method('DELETE')
            <div class="card-body">
                <div class="float-left">
                    <div class="input-group align-items-center">
                        <select class="form-control selectric mr-3" tabindex="-1" name="status" required>
                            <option selected disabled>{{ __('Select Action') }}</option>
                            <option value="delete">{{ __('Delete Permanently') }}</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-lg basicbtn">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control"
                                    placeholder="search...">
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
                            <th class="text-center pt-2">
                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                                </th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Limit/Day') }}</th>
                            <th>{{ __('Days') }}</th>
                            <th>{{ __('Referral Commission') }}</th>
                            <th>{{ __('Active Users') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($membershipPlans as $row)
                            <tr>
                                <td class="text-center">
                                    @if($row->id != 1 && $row->users_count == 0)
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" name="id[]" class="custom-control-input" value="{{ $row->id }}" id="media-{{ $row->id }}">
                                        <label for="media-{{ $row->id }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                    @endif 
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <strong>{{ $row->price }} {{ defaultcurrency('currency') }}</strong>
                                </td>
                                <td>{{ $row->ad_limit }} {{ __('PTC') }}</td>
                                <td>{{ $row->days }}</td>
                                <td>
                                    
                                    {{ $row->commission_rate ?? '' }} %
                                    
                                </td>
                                <td>{{ $row->users_count }}</td>
                                <td>
                                    @if($row->status)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-dark">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            {{ __('Action') }}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu">
                                            <a class="dropdown-item has-icon text-warning"
                                                href="{{ route('admin.membership-plans.edit', $row->id) }}">
                                                <i class="fa fa-edit"></i>{{ __('Edit') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $membershipPlans->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
