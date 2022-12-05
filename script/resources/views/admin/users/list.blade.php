@extends('layouts.backend.app')

@section('title', $title)

@section('head')
    @include('layouts.backend.partials.headersection',['title'=> $title, 'button_name' => __('Add New'), 'button_link' => route('admin.users.create')])
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="float-left">
            <h6 class="text-primary">{{ $title }}</h6>
        </div>
        <div class="float-right">
            <form method="get">
                <div class="input-group">
                    <input name="src" type="text" value="{{ request('src') ?? '' }}" class="form-control"
                            placeholder="{{ __('Search by username, email, name') }}">
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
                    <th>{{ __('User') }}</th>
                    <th>{{ __('Email - Phone') }}</th>
                    <th class="text-center">{{ __('Phone verification') }}</th>
                    <th class="text-center">{{ __('Email verification') }}</th>
                    <th class="text-center">{{ __('Joined At') }}</th>
                    <th>{{ __('Balance') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="font-weight-bold">
                            {{  $user->name  }}
                            <br>
                            <a href="{{ route('admin.users.detail', $user->username) }}"><span>@</span>{{ $user->username }}</a>
                        </td>
                        <td>
                            {{ $user->email  }}
                            <br>
                            {{ $user->phone }}
                        </td>
                        <td class="text-center"><span class="badge badge-{{ $user->phone_verified_at != null ? 'success' : 'warning' }}">{{ $user->phone_verified_at != null ? 'Verified' : 'Not Verified' }}</span></td>
                        <td class="text-center"><span class="badge badge-{{ $user->email_verified_at != null ? 'success' : 'warning' }}">{{ $user->email_verified_at != null ? 'Verified' : 'Not Verified' }}</span></td>
                        <td class="text-center">
                            {{ formatted_date($user->created_at, 'd M, Y')  }}
                        </td>
                        <td>{{ number_format($user->balance, 2) }}</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    {{ __('Action') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu">
                                    <a class="dropdown-item has-icon text-warning"
                                        href="{{ route('admin.users.detail', $user->username) }}">
                                        <i class="fa fa-eye"></i>{{ __('View') }}
                                    </a>
                                    <a class="dropdown-item has-icon text-warning"
                                        href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="fa fa-user-edit"></i>{{ __('Edit') }}
                                    </a>
                                    <a class="dropdown-item has-icon text-warning"
                                        href="{{ url('admin/users/login-as-user', $user->id) }}">
                                        <i class="fa fa-key"></i>{{ __('Login') }}
                                    </a>
                                    <a class="dropdown-item has-icon text-warning"
                                        href="{{ route('admin.users.email-log', $user->id) }}">
                                        <i class="fas fa-envelope-open-text"></i>{{ __('Email Log') }}
                                    </a>
                                    
                                    <a class="dropdown-item has-icon delete-confirm text-danger"
                                        href="javascript:void(0)" data-id="{{ $user->id }}">
                                        <i class="fa fa-trash"></i>{{ __('Delete') }}
                                    </a>
                                    <form class="d-none" id="delete_form_{{ $user->id }}"
                                            action="{{ route('admin.ptc-ads.destroy', $user->id) }}"
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
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
