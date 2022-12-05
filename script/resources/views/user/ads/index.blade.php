@extends('layouts.user.app')

@section('title', __('Ads'))

@section('content')
    <div class="dashboard-card-area">
        <div class="row">
            <div class="col-12">
                <h2 class="dashboard-title mb-3">{{ __('Ads') }}</h2>
                @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <!-- View Add Area -->
                <div class="view-add-area">
                    <div class="row">
                        @foreach ($ades as $ads)
                        @php
                           $ptcuser = App\Models\PTCUser::where([
                                ['ptc_id',$ads->id],
                                ['user_id',Auth::User()->id]
                            ])->whereDate('created_at',Carbon\Carbon::today())->first();
                            if($ptcuser)
                            {
                                $ptc_id = $ptcuser->ptc_id;
                            }else{
                                $ptc_id = 0;
                            }
                            $ptcuser_limit = App\Models\PTCUser::where([
                                ['ptc_id',$ads->id]
                            ])->count();
                        @endphp
                        @if ($ptc_id != $ads->id)
                        @if ($ptcuser_limit < $ads->max_limit)
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-50">
                            <!-- Single Card -->
                            <div class="swiper-slide dashboard">
                                <div class="add-image">
                                    <img src="{{ $ads->meta->value }}" alt="">
                                </div>
                                <h4>{{ $ads->title }}</h4>
                                <h6>{{ __('Earn:') }} {{ $currency->icon }}{{ $ads->amount }}</h6>
                                <a target="_blank" class="add-btn" href="{{ route('user.ads.show',encrypt($ads->id)) }}">{{ __('View Add') }}</a>
                            </div>
                        </div> 
                        @endif
                        @endif
                        @endforeach
                        {{ $ades->links() }}
                    </div>
                </div>
                <!-- View Add Area -->
            </div>
        </div>
    </div>
@endsection
