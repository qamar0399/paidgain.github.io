@extends('layouts.frontend.app', ['withOutBreadcrumb' => true])

@section('title', __('Home'))

@section('content')
    @isset($data['data']['heading.welcome'])
        <!-- Welcome Area Start -->
        <section class="welcome-area bg-img bg-overlay"
                 style="background-image:url('{{ asset($data['data']['heading.welcome']->info['background_image']) }}');">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Welcome Text -->
                    <div class="col-lg-6">
                        <div class="welcome-text">
                            <h2 data-animation="fadeInDown"
                                data-delay="900ms">{{ $data['data']['heading.welcome']->name ?? '' }}</h2>
                            <p data-animation="fadeInDown"
                               data-delay="400ms">{{ $data['data']['heading.welcome']->other ?? '' }}</p>
                            @isset($data['data']['heading.welcome']->info['button_text'])
                                <!-- Button -->
                                <div class=" btn-area">
                                    <a class="ptc-btn"
                                       href="{{ $data['data']['heading.welcome']->info['button_url'] ?? '#'}}">{{ $data['data']['heading.welcome']->info['button_text'] ?? '' }}</a>
                                </div>
                            @endisset
                            @isset($data['data']['heading.welcome']->info['shape_image'])
                                <!-- Shape Image -->
                                <div class="money-shape-image welcome-thumb">
                                    <img src="{{ asset($data['data']['heading.welcome']->info['shape_image'] ?? '') }}" alt="">
                                </div>
                            @endisset
                        </div>
                    </div>
                    @isset($data['data']['heading.welcome']->info['thumb_image'])
                        <!-- welcome Thumb -->
                        <div class="col-lg-6">
                            <div class="welcome-image welcome-thumb">
                                <img src="{{ asset($data['data']['heading.welcome']->info['thumb_image'] ?? '') }}" alt="">
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </section>
        <!-- Welcome Area End -->
    @endisset

    @isset($data['data']['heading.features'])
        <!-- Earn Money Step Area -->
        <div class="earn-money-step-area section-padding-100-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ $data['data']['heading.features']->name ?? '' }}</h3>
                            <p>{{ $data['data']['heading.features']->other ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @isset($data['dataCollection']['features'])
                    <div class="row">
                        <!-- Single Card -->
                        @foreach($data['dataCollection']['features'] as $feature)
                            <div class="col-md-6 col-lg-4">
                                <div class="single-earn-money-card text-center">
                                    <!-- Icon Image -->
                                    <div class="earn-money-icon">
                                        <img src="{{ asset($feature->info['image' ?? null]) }}" alt="">
                                    </div>
                                    <h3>{{ $feature->name ?? '' }}</h3>
                                    <p>{{ $feature->other ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
        <!-- Earn Money Step Area -->
    @endisset

    @isset($data['data']['heading.member_benefits'])
        <!-- Members Benefit Area -->
        <div class="member-benefit-area section-padding-0-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ $data['data']['heading.member_benefits']->name ?? '' }}</h3>
                            <p>{{ $data['data']['heading.member_benefits']->other ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <!-- Image -->
                    <div class="col-md-6">
                        <div class="benefit-image welcome-thumb text-center mb-50">
                            <img
                                src="{{ asset($data['data']['heading.member_benefits']->info['background_image'] ?? '') }}"
                                alt="">
                        </div>
                    </div>

                    <!-- Content Text -->
                    <div class="col-md-6">
                        <div class="benefit-content-text mb-50">
                            <h2>{{ $data['data']['heading.member_benefits']->info['title'] ?? '' }}</h2>
                            <h6>{{ $data['data']['heading.member_benefits']->info['description'] ?? '' }}</h6>
                            <!-- Benefit List -->
                            <ul class="benefit-list">
                                @isset($data['dataCollection']['member_benefits'])
                                    @foreach($data['dataCollection']['member_benefits'] ?? [] as $k => $member_benefits)
                                        <li>
                                            <svg id="icon-home-{{ $k+1 }}" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit link-icon">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                                      style="stroke-dasharray: 52, 72; stroke-dashoffset: 0;"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                                      style="stroke-dasharray: 42, 62; stroke-dashoffset: 0;"></path>
                                            </svg> {{ $member_benefits->name ?? '' }}
                                        </li>
                                    @endforeach
                                @endisset
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Members Benefit Area -->
    @endisset
    @isset($data['data']['heading.member_info'])
    {{-- MEMBERS INFOS --}}
    <section class="counter-up-area section-padding-0-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $data['data']['heading.member_info']->name ?? '' }}</h3>
                        <p>{{ $data['data']['heading.member_info']->other ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Counter Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-counter-area mb-50">
                        <!-- Counter header Area -->
                        <div class="counter-header-area d-flex align-items-center">
                            <div class="icon" data-aos="fade-up" data-aos-duration="800">
                                <img src="{{ asset('frontend/img/icons/7.png') }}" alt="">
                            </div>
                            <div class="counter-header-text">
                                <h2 class="counter counter_limit">{{ $data['totalMembers'] ?? '' }}</h2>
                                <h6>{{ __('Total Members') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Counter Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-counter-area mb-50">
                        <!-- Counter header Area -->
                        <div class="counter-header-area d-flex align-items-center">
                            <div class="icon two" data-aos="fade-up" data-aos-duration="1000">
                                <img src="{{ asset('frontend/img/icons/diposit.png') }}" alt="">
                            </div>
                            <div class="counter-header-text">
                                <h2 class="counter counter_limit">{{ $data['totalDeposit'] ?? '' }}</h2>
                                <h6>{{ __('Total Disposit') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Counter Area -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-counter-area mb-50">
                        <!-- Counter header Area -->
                        <div class="counter-header-area d-flex align-items-center">
                            <div class="icon three" data-aos="fade-up" data-aos-duration="1200">
                                <img src="{{ asset('frontend/img/icons/withdraw.png') }}" alt="">
                            </div>
                            <div class="counter-header-text">
                                <h2 class="counter counter_limit">{{ $data['total_withdraw'] ?? null }}</h2>
                                <h6>{{ __('Total Withdraw') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MEMBERS INFOS --}}
    @endisset

    @isset($data['data']['heading.advertise_benefits'])
        <!-- advertise Benefit Area -->
        <div class="member-benefit-area section-padding-0-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ $data['data']['heading.advertise_benefits']->name }}</h3>
                            <p>{{ $data['data']['heading.advertise_benefits']->other }}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- Content Text -->
                    <div class="col-xl-9">
                        <div class="benfit-tab">
                            <div class="d-md-flex align-items-start">
                                <!-- Tab Option -->
                                <div class="nav flex-column nav-pills me-3 mb-50" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($data['dataCollection']['advertise_benefits'] as $key => $advertiseBenefit)
                                        <!-- Button -->
                                        <button class="nav-link {{ $key == 0 ? 'active' : null }}"
                                                id="v-pills-{{ $key }}-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-{{ $key }}" type="button" role="tab"
                                                aria-controls="v-pills-{{ $key }}"
                                                aria-selected="true">{{ $advertiseBenefit->name }}</button>
                                    @endforeach
                                </div>
                                <!-- Tab Content Text -->
                                <div class="tab-content mb-50" id="v-pills-tabContent">
                                    @foreach($data['dataCollection']['advertise_benefits'] as $key => $advertiseBenefit)
                                        <!-- Text Box -->
                                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : null }}"
                                             id="v-pills-{{ $key }}" role="tabpanel"
                                             aria-labelledby="v-pills-{{ $key }}-tab">
                                            <!-- Body Text -->
                                            <div class="tab-body-text">
                                                @isset($advertiseBenefit->info['image'])
                                                    <div class="tab-body-icon">
                                                        <img src="{{ $advertiseBenefit->info['image'] }}" alt="">
                                                    </div>
                                                @endif
                                                <p>{{ $advertiseBenefit->other }}</p>
                                            </div>
                                        </div>
                                        <!-- Text Box -->
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- advertise Benefit Area -->
    @endisset

    @if(isset($data['data']['heading.earn_money']) && isset($data['ads']) && count($data['ads']) > 0)
    <!-- View Add Area -->
    <div class="view-add-area section-padding-0-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $data['data']['heading.earn_money']->name }}</h3>
                        <p>{{ $data['data']['heading.earn_money']->other }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($data['ads'] ?? [] as $ad)
                                <!-- Single Slider -->
                                <div class="swiper-slide">
                                    <div class="add-image">
                                        @if($ad->ads_type == 'link_url')
                                            <img src="{{ $ad->meta->value }}" alt="">
                                        @elseif($ad->ads_type == 'banner_image')
                                            <img src="{{ asset($ad->meta->value ?? '') }}" alt="">
                                        @elseif($ad->ads_type == 'clickable_image')
                                            <img src="{{ asset($ad->meta->value ?? '') }}" alt="">
                                        @elseif($ad->ads_type == 'script_code' || $ad->ads_type == 'embedded')
                                            <img src="{{ asset($ad->meta->value ?? '') }}" alt="">
                                        @endif
                                    </div>
                                    <h4>{{ $ad->title }}</h4>
                                    <h6>{{ currency_format($ad->amount) }}</h6>
                                    <a class="add-btn" href="{{ route('user.ads.index') }}">{{ __('View Add') }}</a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Slider Button -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- View Add Area -->
    @endif

    @isset($data['data']['heading.payouts'])
        <!-- Payouts Area -->
        <div class="payouts-area section-padding-0-50">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Heading Title -->
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ optional($data['data']['heading.payouts'])->name }}</h3>
                            <p>{{ optional($data['data']['heading.payouts'])->other }}</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <!-- Payout Image -->
                    <div class="col-lg-5">
                        <div class="payout-image mb-50">
                            <img src="{{ asset($data['data']['heading.payouts']->info['image']) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 mb-50">
                        <h4 class="payout-title">{{ __('Payout History') }}</h4>
                        <div class="payout-list-area" id="listBox">
                            @foreach($data['top_payouts'] as $payout)
                            <!-- Single Card -->
                            <div class="single-payout-list d-sm-flex align-items-center justify-content-between">
                                <div class="payout-auth-info d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="payout-auth-img">
                                        <img src="https://ui-avatars.com/api/?name={{ $payout->user->name }}&rounded=true&size=150&background=random" alt="">
                                    </div>
                                    <div class="auth-info">
                                        <h4>{{ $payout->user->name }}</h4>
                                        
                                    </div>
                                </div>
                                <!-- Info Text -->
                                <div class="payout-info">
                                    <p>{{ __('Date') }} : {{ formatted_date($payout->created_at) }}</p>
                                    <h5>{{ __('Amount') }}: <span>{{ currency_format($payout->amount) }}</span></h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payouts Area -->
    @endisset

    @isset($data['data']['heading.join_us'])
    <!-- Call to Action Area -->
    <div class="cta-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content-text text-center">
                        <h2>{{ $data['data']['heading.join_us']->name }}</h2>
                        <p>{{ $data['data']['heading.join_us']->other }}</p>
                        <a class="cta-btn" href="#">{{ __('Start Earning') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action Area -->
    @endisset

    @isset($data['data']['heading.our_team'])
        <!-- Team Area Css -->
        <div class="team-area section-padding-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ optional($data['data']['heading.our_team'])->name }}</h3>
                            <p>{{ optional($data['data']['heading.our_team'])->other }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Single Card -->
                    @isset($data['dataCollection']['team_members'])
                        @foreach($data['dataCollection']['team_members'] as $team)
                            <div class="col-sm-6 col-lg-3">
                                <div class="single-team-member">
                                    <!-- Member Image -->
                                    <div class="team-image">
                                        <img src="{{ asset($team->info['image'] ?? '') }}" alt="">
                                    </div>
                                    <!-- teax -->
                                    <div class="team-content-text">
                                        <h5>{{ $team->name }}</h5>
                                        <p>{{ $team->other }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
        <!-- Team Area Css -->
    @endisset

    @if(isset($data['data']['heading.blog_news']) && isset($data['blogs']) && count($data['blogs']) > 0)
    <!-- Blog Area -->
    <div class="blog-area section-padding-0-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $data['data']['heading.blog_news']->name }}</h3>
                        <p>{{ $data['data']['heading.blog_news']->other }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($data['blogs'] as $blog)
                    <div class="col-md-6 col-lg-4">
                            <div class="single-card-blog">
                                <!-- Blog Header -->
                                <div class="blog-header-image">
                                    <img src="{{ optional($blog->preview)->value }}" alt="card__image" class="card__image">
                                </div>
                                <!-- Body Text -->
                                <div class="blog-body-text">
                                    <h4><a href="{{ route('frontend.blog-post', $blog->slug) }}">{{ $blog->title }}</a></h4>
                                    <p>{{ content_format(optional($blog->excerpt)->value) }}</p>
                                </div>
                                <!-- Blog Footer -->
                                <div class="blog-footer d-flex align-items-center">
                                    <div class="user-image">
                                        <img src="https://ui-avatars.com/api/?name={{ optional($blog->user)->name }}&size=150" alt="user__image"
                                             class="user__image">
                                    </div>
                                    <div class="user__info">
                                        <h5>{{ optional($blog->user)->name }}</h5>
                                        <span>{{ $blog->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog Area -->
    @endisset
@endsection
