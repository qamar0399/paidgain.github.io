@extends('layouts.backend.app')

@section('title','Manage Referral Commission')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Manage Referral Commission', 'button_name' => __('Add New'), 'button_link' => route('admin.referral-commission.create')])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('admin.referrals.commission.delete') }}" method="POST" class="ajaxform_with_reload">
                @csrf
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <div class="input-group">
                                    <input name="src" type="text" value="{{ request('src') ?? '' }}"
                                        class="form-control"
                                        placeholder="search...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Commission') }}</th>
                        
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($referralCommissions as $row)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" name="id[]" class="custom-control-input" value="{{ $row->id }}" id="media-{{ $row->id }}">
                                        <label for="media-{{ $row->id }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ ucfirst($row->slug) }}</td>
                                <td>
                                    @if($row->slug == 'fixed')
                                        {{ $row->other }} /-
                                    @elseif($row->slug == 'percentage')
                                        {{ $row->other }} %
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
                                            href="{{ route('admin.referral-commission.edit', $row->id) }}">
                                                <i class="fa fa-edit"></i>{{ __('Edit') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $referralCommissions->links('vendor.pagination.bootstrap-5') }}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
