@extends('layouts.frontend.app', ['withOutBreadcrumb' => true])

@section('title', __('Referral'))

@section('content')
    <div class="container">
        <div class="blog-area section-padding-100-50">
            <div class="row justify-content-center mt-50">
                <div class="col-md-4">
                    <div class="card">
                        @if(Auth::user()->referredBy)
                        <img src="{{ get_gravatar(Auth::user()->referredBy->email, 1000) }}" alt="">
                        @endif
                        <div class="card-body">
                            @if(Auth::user()->referredBy)
                                <h4 class="text-center">
                                    {{ __('You are already referred by :') }} {{ Auth::user()->referredBy->name }}
                                </h4>
                            @else
                                <form action="{{ route('frontend.referral.confirm') }}" method="post" class="ajaxform_with_next">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="ref" class="text-dark">{{ __('Referral ID') }}</label>
                                        <input type="text" name="ref" id="ref" class="form-control" value="{{ $user->id }}" placeholder="{{ __('Enter referral id') }}">
                                    </div>

                                    <button class="btn btn-dark basicbtn">{{ __('Confirm') }}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
