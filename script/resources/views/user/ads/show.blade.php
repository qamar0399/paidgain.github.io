<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $ads->title }}</title>


    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ads.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ads-responsive.css?v=1.2') }}">
</head>
<body>

    <div id="progress_bar"></div>
    {{-- header area start --}}
    <div class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('frontend/img/core-img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="{{ route('user.ads.confirm') }}" method="POST" id="confirm_form" class="d-none ajaxform">
                        @csrf
                        <div class="header-right-area f-right">
                            <div class="header-calculation-area">
                                <div class="calculation-answer-input">
                                    <div class="captcha-area">
                                        {!! captcha_img() !!}
                                    </div>
                                    <input type="text" name="captcha">
                                    <input type="hidden" name="ptc_id" value="{{ $ads->id }}" required placeholder="T3524">
                                    <div class="error"></div>
                                </div>
                                <div class="calculation-submit-btn">
                                    <button type="submit" id="confirm_earn">{{ __('Confirm Earn') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- header area end --}}


    {{-- ads show body area start --}}
    <section>
        <div class="ads-show">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($ads->ads_type == 'link_url')
                        <iframe src="{{ $ads->ads_body }}" frameborder="0"></iframe>
                        @elseif($ads->ads_type == 'banner_image')
                        <div class="text-center">
                            <img class="img-fluid" src="{{ asset($ads->ads_body) }}" alt="">
                        </div>
                        @elseif($ads->ads_type == 'clickable_image')
                        <div class="text-center">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <a target="_blank" href="{{ $ads->ads_body }}">
                                        <img class="img-fluid" onclick="ads_click()" src="{{ $ads->meta->value }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @elseif($ads->ads_type == 'script_code')
                        {{ content_format($ads->ads_body) }}
                        @elseif($ads->ads_type == 'youtube_subscriber')

                        @elseif($ads->ads_type == 'facebook_follower')
                        <article id="default-usage">
                            <div class="to-lock">
                            <button class="btn btn-primary">{{ __('opended') }}</button>
                            </div></article>
                        @elseif($ads->ads_type == 'twitter_follower')

                        @elseif($ads->ads_type == 'instagram_follower')

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ads show body area end --}}

    <input type="hidden" id="duration" value="{{ $ads->duration }}">
    <input type="hidden" id="ptc_index" value="{{ route('user.ads.index') }}">
    <input type="hidden" id="error_page" value="{{ url('/expired') }}">

    <!-- Must needed plugins to the run this Template -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>

    <script src="{{ asset('frontend/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/form.js') }}"></script>
    <!-- Active JS -->
    @if ($ads->ads_type == 'clickable_image')
    <script>
        "use strict";
        $('#confirm_form').removeClass('d-none');
        $('#confirm_earn').addClass('disabled');
        $('#confirm_earn').prop('disabled',true);
        function ads_click()
        {
            $('.progressbar-text').addClass('d-none');
            $('#confirm_earn').removeClass('disabled');
            $('#confirm_earn').prop('disabled',false);
        }
    </script>
    @endif
    @if ($ads->ads_type != 'clickable_image')
    <script>
        "use strict";
        var seconds = $('#duration').val() * 1000;

        progressbar();
        var satus = 0;

        function progressbar() {
            var bar = new ProgressBar.Line(progress_bar, {
                strokeWidth: 4,
                easing: 'easeInOut',
                duration: seconds,
                color: '#ec5a1f',
                trailColor: '#eee',
                trailWidth: 1,
                svgStyle: { width: '100%', height: '100%' },
                text: {
                    style: {
                        color: '#000',
                        position: 'absolute',
                        right: '100px',
                        top: '35px',
                        padding: 0,
                        margin: 0,
                        transform: null,
                    },
                    autoStyleContainer: false
                },
                from: { color: '#FFEA82' },
                to: { color: '#ED6A5A' },
                step: (state, bar) => {
                    bar.setText(Math.round(bar.value() * 100) + ' %');
                }
            });

            bar.animate(1.0); // Number from 0.0 to 1.0
        }

        setTimeout(() => {
            $('.progressbar-text').addClass('d-none');
            $('#confirm_form').removeClass('d-none');
        }, seconds);

    </script>
    @endif
    @if ($ads->ads_type != 'clickable_image')
    <script>
        "use strict";
         document.addEventListener("visibilitychange", function() {
            if (document.hidden) {
                var error_page = $('#error_page').val();
                window.location.href = error_page;
            }
        });
    </script>
    @endif
    <script>
        "use strict";
        function success(res)
        {
            var ptc_index = $('#ptc_index').val();
            window.location.href = ptc_index;
        }
    </script>
</body>
</html>
