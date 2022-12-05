@extends('layouts.backend.app')

@section('title','Email Log')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'Email Log', 'prev' => url()->previous()])
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="float-left">
                    <h6 class="text-primary">{{ __('Email Log') }}</h6>
                </div>
                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control"
                                    placeholder="{{ __('Search by subject') }}">
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
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('Message') }}</th>
                            <th>{{ __('Sent At') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td>
                                    {{ $notification->data['subject'] }}
                                </td>
                                <td>
                                    {{ $notification->data['body'] }}
                                </td>
                                <td>
                                    {{ formatted_date($notification->data['sent_at'], 'd M, Y h:i A') }}
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
                                                href="{{ route('admin.users.detail', $notification->id) }}">
                                                <i class="fa fa-eye"></i>{{ __('View') }}
                                            </a>
                                            <a class="dropdown-item has-icon delete-confirm text-danger"
                                                href="javascript:void(0)" data-id="{{ $notification->id }}">
                                                <i class="fa fa-trash"></i>{{ __('Delete') }}
                                            </a>
                                            <form class="d-none" id="delete_form_{{ $notification->id }}"
                                                    action="{{ route('admin.ptc-ads.destroy', $notification->id) }}"
                                                    method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $notifications->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
@endpush
