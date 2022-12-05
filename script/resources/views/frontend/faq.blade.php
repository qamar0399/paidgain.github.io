@extends('layouts.frontend.app')

@section('title', __('FAQ'))

@section('content')
    <!-- Faq Area -->
    <div class="faq-area section-padding-100">
        <div class="container">
            @isset($data['faq'])
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <!-- Heading Title -->
                        <div class="heading-title text-center">
                            <h3>{{ $data['faq']->name }}</h3>
                            <p>{{ $data['faq']->other }}</p>
                        </div>
                    </div>
                </div>
                @if(isset($data['faqs']) && count($data['faqs']) > 0)
                <!-- Faq Area -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!-- Faq Content -->
                        <div class="faq-content-area">
                            <div class="accordion" id="accordionExample">
                                @foreach ($data['faqs'] as $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                            <button class="accordion-button {{ $loop->first ? '':'collapsed' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="true" aria-controls="collapse-{{ $faq->id }}">
                                                {{ $faq->name }}
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show':'' }}"
                                            aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>{{ $faq->other }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Auth::user()->role == 'admin')
                    <div class="alert alert-danger">
                        <a href="{{ route('admin.website.faq.index') }}">
                            {{ __('Please add some Frequently asked Question') }}
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                @endif
            @elseif (Auth::user()->role == 'admin')
                <div class="alert alert-danger">
                    <a href="{{ route('admin.website.heading.index') }}">
                        {{ __('Edit Faq Section') }} <i class="fas fa-edit"></i>
                    </a>
                </div>
            @endisset
        </div>
    </div>
    <!-- Faq Area -->

    {{-- MEMBERS INFOS --}}
    @isset($data['member_info'])
    {{-- MEMBERS INFOS --}}
    <section class="counter-up-area section-padding-0-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $data['member_info']->name }}</h3>
                        <p>{{ $data['member_info']->other }}</p>
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
                                <h2 class="counter">{{ $data['totalMembers'] }}</h2>
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
                                <h2 class="counter">{{ $data['totalDeposit'] }}</h2>
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
                                <h2 class="counter">{{ $data['totalWithdraw'] ?? null }}</h2>
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
@endsection
