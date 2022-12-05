<!-- Header Area Start -->
<header class="site-header site-header--menu-right landing-1-menu site-header--absolute site-header--sticky">
    <div class="container">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <div class="brand-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ get_option('logo_setting', true)->logo ?? null }}" alt="" class="dark-version-logo">
                </a>
            </div>
            <div class="menu-block-wrapper">
                <div class="menu-overlay"></div>
                <nav class="menu-block" id="append-menu-header">
                    <div class="mobile-menu-head">
                        <div class="go-back">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="current-menu-title"></div>
                        <div class="mobile-menu-close">&times;</div>
                    </div>
                    <ul class="site-menu-main">
                        {{ RenderMenu('header', 'components.menu.header') }}
                        @if(Auth::check())
                            <li class="nav-link-item dashboard-link">
                                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="sign-btn">
                                    <img src="{{ get_gravatar(Auth::user()->email) }}" class="rounded-circle" alt=""> {{ Auth::user()->name }}
                                </a>
                            </li>
                        @else
                            <li class="nav-link-item login-btn">
                                <button type="button" class="sign-btn" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-whatever="@mdo">
                                    {{ __('Login') }}
                                </button>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
            <!-- mobile menu trigger -->
            <div class="mobile-menu-trigger">
                <span></span>
            </div>
        </nav>
    </div>
</header>
<!-- header-end -->
