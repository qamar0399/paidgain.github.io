@extends('layouts.user.app')

@section('content')
<!-- dahboard area start -->
<section>
    <div class="dashboard-area pt-150 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-container">
                        <div class="header-section">
                            <h4>{{ __('Ticket No: ') }} {{ $support->ticket_no }}</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table support-details">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th class="text-end">{{ __('Details') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Status') }}</td>
                                            <td class="text-end">
                                                <span class="fs-6 badge rounded-pill bg-{{ $support->status == 1 ? 'primary' : ($support->status == 2 ? 'warning' : 'danger') }}">{{ $support->status == 1 ? 'Open' : ($support->status == 2 ? 'Pending' : 'Closed') }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Title') }}</td>
                                            <td class="text-end">
                                            <strong>
                                                {{ $support->title }}
                                            </strong>
                                            </td>
                                        </tr>
                                            @foreach ($support->meta as $item)
                                            <tr>
                                                <td colspan=2 class="{{ $item->type == 1 ? 'text-start' : 'text-end'}}">
                                                    @if ($item->type == 1)
                                                        <div class="mb-2">
                                                            <img  height="5" class="support-author-img" src="{{ url('https://ui-avatars.com/api/?background=random&rounded=true&name='.$support->user->name) }}" alt="">
                                                            {{ $support->user->name }}
                                                        </div>
                                                    @else
                                                        <div class="mb-2">
                                                            {{ __('Admin') }}
                                                            <img height="5"  class="support-author-img" src="{{ url('https://ui-avatars.com/api/?background=random&&rounded=true&name=Admin') }}">
                                                        </div>
                                                    @endif
                                                    <span >{{ $item->comment }}</span>
                                                    <br>
                                                    <span class="text-primary support-time">{{ $item->created_at->diffforhumans() }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if ($support->status != 0)
                                            <tr>
                                                <td colspan="2">
                                                    <form action="{{ route('user.support.update', $support->id) }}" method="post" class="ajaxform_with_reload">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="">{{ __('Comment') }}</label>
                                                                    <textarea name="comment" id="" cols="30" rows="5" class="@error('description') is-invalid @enderror form-control"></textarea>
                                                                </div>
                                                                @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 text-center mt-3">
                                                                <div class="button-btn">
                                                                    <button type="submit" class="basicbtn btn_submit w-100">{{ __('Submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
