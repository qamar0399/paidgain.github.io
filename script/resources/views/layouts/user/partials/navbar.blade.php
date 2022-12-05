@php
    $logo_setting = get_option('logo_setting', true)
@endphp
<header class="top-header-area d-flex align-items-center justify-content-between">
    <div class="left-side-content-area d-flex align-items-center">
        <!-- Mobile Logo -->
        <div class="mobile-logo mr-3 mr-sm-4">
            <a href="{{ route('user.dashboard') }}">
                <img src="{{ $logo_setting->logo ?? null }}" alt="Logo">
            </a>
        </div>
        <!-- Triggers -->
        <div class="ecaps-triggers mr-1 mr-sm-3">
            <div class="mobile-menu-open" id="mobileMenuOpen">
                <img src="{{ $logo_setting->logo ?? null }}"  alt="">
            </div>
        </div>
    </div>
</header>
