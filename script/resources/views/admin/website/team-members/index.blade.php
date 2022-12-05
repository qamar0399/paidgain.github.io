@extends('layouts.backend.app')

@section('title', __('Our Team Members'))

@section('head')
@include('layouts.backend.partials.headersection', [
'title'=> __('Our Team Members'),
'button_name' => __('Add New'),
'button_link' => route('admin.website.team-members.create')
])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Team Members') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Photo') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Position') }}</th>
                                <th class="text-right">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $row)
                            <tr>
                                <td><img src="{{ json_decode($row->meta->value)->image ?? null }}" class="avatar" alt=""></td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->other }}</td>

                                <td class="text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu">
                                        <a class="dropdown-item has-icon text-warning"
                                        href="{{ route('admin.website.team-members.edit', $row->id) }}">
                                        <i class="fa fa-edit"></i>{{ __('Edit') }}
                                    </a>
                                    <a class="dropdown-item has-icon delete-confirm text-danger"
                                    href="javascript:void(0)" data-id="{{ $row->id }}">
                                    <i class="fa fa-trash"></i>{{ __('Delete') }}
                                </a>
                                <form class="d-none" id="delete_form_{{ $row->id }}"
                                  action="{{ route('admin.website.team-members.destroy', $row->id) }}"
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
      {{ $members->links('vendor.pagination.bootstrap-5') }}
  </div>
</div>
</div>
</div>
</div>
@endsection
