@php
    $footer = get_option('footer_setting', true, current_locale())
@endphp
<!-- Footer Area -->
<div class="footer-contact-area section-padding-100-50">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Footer Widget -->
            <div class="col-sm-5 col-lg-4">
                <div class="footer-single-widget mb-50">
                    <div class="footer-logo">
                        <a href="{{ url('/') }}"><img src="{{ get_option('logo_setting', true)->logo ?? null }}" alt="Image"></a>
                    </div>
                    @isset($footer->address)
                        <p>
                            <i class="fas fa-map-pin"></i>
                            {{ $footer->address ?? null }}
                        </p>
                    @endisset
                    @isset($footer->phone)
                        <a href="tel:{{ $footer->phone }}">
                            <p><i class="fas fa-phone-volume"></i> {{ $footer->phone ?? null }}</p>
                        </a>
                    @endisset
                    @isset($footer->email)
                        <a href="mailto:{{ $footer->email }}">
                            <p><i class="fas fa-at"></i> {{ $footer->email ?? null }}</p>
                        </a>
                    @endisset
                    <div class="row">
                        <div class="col-lg-6">
                            @php
                                $langs = get_option('languages',true);
                            @endphp
                            <div class="language-swithcher">
                                <select class="form-select" id="lang_switch">
                                    @foreach ($langs as $key=>$lang)
                                    <option {{ app()->getLocale() == $key ? 'selected' : '' }} value="{{ $key }}">{{ $lang }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="lang_url" value="{{ route('lang.switch') }}">
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-7 col-lg-8">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="footer-single-widget first mb-50">
                            {{ RenderMenu('footer_left_menu', 'components.menu.footer') }}
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="footer-single-widget second mb-50">
                            {{ RenderMenu('footer', 'components.menu.footer') }}
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="footer-single-widget third mb-50">
                            {{ RenderMenu('footer_right_menu', 'components.menu.footer') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Area -->
<div class="footer-area section-padding-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-social-area">
                    <ul class="footer-social">
                        @foreach($footer->social ?? [] as $social)
                            <li>
                                <a href="{{ $social->link ?? 'javascript:void(0)' }}">
                                    <i class="{{ $social->icon }}"></i>
                                </a>
                            <li>
                        @endforeach
                    </ul>
                </div>
                <div class="copy-right-area text-center">
                    <p>{{ $footer->copyright ?? null }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Area -->
