@extends('layouts.backend.app')

@section('title', __('Content Heading Section'))

@section('head')
    @include('layouts.backend.partials.headersection', ['title'=> __('Content Heading Section')])
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endsection

@section('content')
    <div class="">
        <div class="">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column" id="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="welcome_tab" data-toggle="tab" href="#welcome"
                                       role="tab" aria-controls="welcome" aria-selected="true">{{ __('Welcome') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="features_tab" data-toggle="tab" href="#features" role="tab"
                                       aria-controls="feautes" aria-selected="false">{{ __('Features') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="member_benefit_tab" data-toggle="tab" href="#member_benefit"
                                       role="tab" aria-controls="member_benefit"
                                       aria-selected="false">{{ __('Member Benefits') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="member_info_tab" data-toggle="tab" href="#member_info"
                                       role="tab" aria-controls="member_info"
                                       aria-selected="false">{{ __('Member Info') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="advertise_benefit_tab" data-toggle="tab"
                                       href="#advertise_benefit" role="tab" aria-controls="advertise_benefit"
                                       aria-selected="false">{{ __('Advertise Benefits') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="payouts_tab" data-toggle="tab" href="#payouts" role="tab"
                                       aria-controls="payouts" aria-selected="false">{{ __('Top Payouts') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="join_us_tab" data-toggle="tab" href="#join_us" role="tab"
                                       aria-controls="join_us" aria-selected="false">{{ __('Join US') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="our_team_tab" data-toggle="tab" href="#our_team" role="tab"
                                       aria-controls="our_team" aria-selected="false">{{ __('Our Team') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="our_team_tab" data-toggle="tab" href="#top_investor"
                                       role="tab" aria-controls="top_investor"
                                       aria-selected="false">{{ __('Top Investor') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="client_review_tab" data-toggle="tab" href="#client_review"
                                       role="tab" aria-controls="client_review"
                                       aria-selected="false">{{ __('Client Review') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="blog_news_tab" data-toggle="tab" href="#blog_news"
                                       role="tab" aria-controls="blog_news"
                                       aria-selected="false">{{ __('Blog News') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact_tab" data-toggle="tab" href="#contact" role="tab"
                                       aria-controls="contact" aria-selected="false">{{ __('Contact Section') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="earn_money_tab" data-toggle="tab" href="#earn_money"
                                       role="tab" aria-controls="earn_money"
                                       aria-selected="false">{{ __('Earn Money') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="price_plans_tab" data-toggle="tab" href="#price_plans"
                                       role="tab" aria-controls="price_plans"
                                       aria-selected="false">{{ __('Our Price Plans') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="faq_tab" data-toggle="tab" href="#faq"
                                       role="tab" aria-controls="faq"
                                       aria-selected="false">{{ __('FAQ') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="welcome" role="tabpanel"
                             aria-labelledby="welcome_tab">
                            @include('admin.website.heading.welcome')
                        </div>

                        <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features_tab">
                            @include('admin.website.heading.features')
                        </div>
                        <div class="tab-pane fade" id="member_benefit" role="tabpanel"
                             aria-labelledby="member_benefit_tab">
                            @include('admin.website.heading.memberbenefits')
                        </div>
                        <div class="tab-pane fade" id="member_info" role="tabpanel" aria-labelledby="member_info_tab">
                            @include('admin.website.heading.memberinfo')
                        </div>
                        <div class="tab-pane fade" id="advertise_benefit" role="tabpanel"
                             aria-labelledby="advertise_benefit_tab">
                            @include('admin.website.heading.advertisebenefits')
                        </div>
                        <div class="tab-pane fade" id="payouts" role="tabpanel" aria-labelledby="payouts_tab">
                            @include('admin.website.heading.toppayouts')
                        </div>
                        <div class="tab-pane fade" id="join_us" role="tabpanel" aria-labelledby="join_us_tab">
                            @include('admin.website.heading.joinus')
                        </div>
                        <div class="tab-pane fade" id="our_team" role="tabpanel" aria-labelledby="our_team_tab">
                            @include('admin.website.heading.ourteammember')
                        </div>
                        <div class="tab-pane fade" id="top_investor" role="tabpanel" aria-labelledby="top_investor_tab">
                            @include('admin.website.heading.topinvestor')
                        </div>
                        <div class="tab-pane fade" id="client_review" role="tabpanel"
                             aria-labelledby="client_review_tab">
                            @include('admin.website.heading.clientreview')
                        </div>
                        <div class="tab-pane fade" id="blog_news" role="tabpanel" aria-labelledby="blog_news_tab">
                            @include('admin.website.heading.blognews')
                        </div>
                        <div class="tab-pane fade" id="blog_news" role="tabpanel" aria-labelledby="blog_news_tab">
                            @include('admin.website.heading.blognews')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact_tab">
                            @include('admin.website.heading.contact')
                        </div>
                        <div class="tab-pane fade" id="earn_money" role="tabpanel" aria-labelledby="earn_money_tab">
                            @include('admin.website.heading.earnmoney')
                        </div>
                        <div class="tab-pane fade" id="price_plans" role="tabpanel" aria-labelledby="price_plans_tab">
                            @include('admin.website.heading.priceplans')
                        </div>
                        <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq_tab">
                            @include('admin.website.heading.faq')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ mediasingle() }}
@endsection

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
    <script src="{{ asset('admin/js/media.js') }}"></script>
@endpush

