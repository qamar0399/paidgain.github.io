@extends('layouts.backend.app')

@section('title', __('Subscribers'))

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>  __('Subscribers'), 'button_name' => '<i class="fas fa-paper-plane"></i> '. __('Send Email'), 'button_link' => route('admin.subscriber.send')])
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-left">
                        <h6 class="text-primary">{{ __('Subscriber Manager') }}</h6>
                    </div>
                    <div class="float-right">
                        <form method="get">
                            <div class="input-group">
                                <input name="src" type="text" value="{{ request('src') ?? '' }}"
                                        class="form-control" placeholder="{{ __('Search by email') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix mb-3"></div>
                    @if(count($subscribers) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <th class="text-center">{{ __('Subscribe At') }}    </th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->email }}</td>
                                        <td class="text-center">
                                            {{ formatted_date($subscriber->create_at, 'd M, Y - h:i A') }}
                                            <br>
                                            {{ $subscriber->created_at->diffForHumans() }}
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-sm btn-danger delete-confirm"
                                                href="javascript:void(0)" data-id="{{ $subscriber->id }}">
                                                <i class="fa fa-trash"></i> {{ __('Delete') }}
                                            </a>
                                            <form class="d-none" id="delete_form_{{ $subscriber->id }}"
                                                    action="{{ route('admin.subscribers.destroy', $subscriber->id) }}"
                                                    method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $subscribers->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
