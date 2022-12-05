@extends('layouts.user.app')

@section('title', __('My Profile'))

@section('content')
    <!-- Transaction Area -->
    <div class="transction-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-header-area">{{ __('My Profile') }}</h4>
                            <div class="row gutters-sm">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img src="{{ get_gravatar(Auth::user()->email, 500) }}" alt="" class="rounded-circle" width="150">
                                                <div class="mt-3">
                                                    <h6><span>@</span>{{ Auth::user()->username }}</h6>
                                                    <h4>{{ Auth::user()->name }}</h4>
                                                    @if (Auth::user()->referredBy)
                                                    <p>{{ __('Referred By :') }} {{ Auth::user()->referredBy->name }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <form class="ajaxform" action="{{ route('user.profile.update') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">{{ __('Full Name') }}</h6>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required aria-label="">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">{{ __('Email') }}</h6>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required aria-label="">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">{{ __('Phone') }}</h6>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" required aria-label="">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">{{ __('Country') }}</h6>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select name="country" class="form-control" aria-label="" required>
                                                            @foreach (countries() as $item)
                                                                <option value="{{ $item->country }}" @selected($item->country == Auth::user()->country)>{{ $item->country }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <button class="profile-button basicbtn"><i class="fas fa-save"></i> {{ __('Update') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transaction Area -->
@endsection
