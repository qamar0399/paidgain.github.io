@extends('layouts.user.app')

@section('title', __('Support'))

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-container">
                    <div class="header-section mb-3">
                        <div class="row align">
                            <div class="col-md-6"><h4>{{ __('Supports') }}</h4></div>
                            <div class="col-md-6">
                                <div class="button-btn">
                                    <a class="float-end btn_deposit" href="{{ route('user.support.create') }}">{{ __('Create Support Request') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <table class="table support-table">
                                <thead>
                                  <tr>
                                    <th scope="col">{{ __('Ticket No') }}</th>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Comment') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Created At') }}</th>
                                    <th scope="col">{{ __('Details') }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($supports as $key => $support)
                                  <tr>
                                       <td><a class="text-primary" href="{{ route('user.support.show', $support->id) }}">{{ $support->ticket_no }}</a></td>
                                       <td>{{ Str::limit($support->title,15) }}</td>
                                       <td>{{ Str::limit($support->meta[0]->comment,15) ?? '' }}</td>
                                       <td><span class="badge  bg-{{ $support->status == 1 ? 'success' : ($support->status == 2 ? 'warning' : 'danger') }}">{{ $support->status == 1 ? 'Open' : ($support->status == 2 ? 'Pending' : 'Closed') }}</span> </td>
                                       <td>{{  $support->created_at->isoFormat('LL') }}</td>
                                        <td>
                                            <a class="btn_deposit" href="{{ route('user.support.show', $support->id) }}">{{ __('View') }}</a>
                                        </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            <div class="float-right">
                                {{ $supports->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dahboard area end -->
@endsection
