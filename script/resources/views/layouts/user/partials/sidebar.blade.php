<div class="ecaps-sidenav" id="ecapsSideNav">
    <!-- Side Menu Area -->
    <div class="side-menu-area">
        <!-- Sidebar Menu -->
        <nav>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="sidemenu-user-profile d-flex align-items-center">
                    <div class="user-thumbnail">
                        <img src="{{ get_gravatar(Auth::user()->email, 100) }}" alt="">
                    </div>
                    <div class="user-content">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span> {{ '@'.Auth::user()->username }}</span>
                    </div>
                </li>
                <li class="{{ request()->is('*/dashboard') ? 'active':'' }}">
                    <a href="{{ url('/user/dashboard') }}"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/dashboard.png') }}"
                            alt=""><span>{{ __('Dashboard') }}</span></a>
                </li>
                <li class="{{ request()->is('*/deposit') ? 'active':'' }}">
                    <a href="{{ route('user.deposit.index') }}"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/dep.png') }}" alt=""><span>{{ __('Deposit') }}</span></a>
                </li>
                <li class="{{ request()->is('*/referrals') ? 'active':'' }}">
                    <a href="{{ route('user.referrals.index') }}"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/dep.png') }}" alt=""><span>{{ __('Referrals History') }}</span></a>
                </li>
                <li class="treeview {{ request()->is('*/withdraws*') || request()->is('*/methods*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/planning.png') }}" alt=""> <span>{{ trans('Withdraws') }}</span> <i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->is('*/methods') ? 'active' : '' }}"><a href="{{ route('user.methods.index') }}">{{ trans('Make Withdraw') }}</a></li>
                        {{-- <li class="{{ request()->is('*/withdraws/create') ? 'active' : '' }}"><a href="{{ route('user.withdraws.create') }}">Create withdraw</a></li> --}}
                        <li class="{{ request()->is('*/withdraws') && !request('status') ? 'active' : '' }}"><a href="{{ route('user.withdraws.index') }}">{{ trans('Withdraw History') }}</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Request::is('user/plans*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)">
                        <img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/planning.png') }}" alt="">
                        <span>{{ __('Plans') }}</span> <i class="fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu {{ Request::is('user/plans*') ? 'd-block' : '' }}">
                        <li class="{{ Route::is('user.plans.index') ? 'active' : null }}">
                            <a href="{{ route('user.plans.index') }}">{{ __('Plans') }}</a>
                        </li>
                        <li><a href="{{ route('user.transactions.index') }}">{{ trans('Transactions') }}</a></li>
                    </ul>
                </li>
                <li class="treeview {{ Request::is('user/ads*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)">
                        <img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/money-bag.png') }}" alt="">
                        <span>{{ trans('Ptc') }}</span> <i class="fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu {{ Request::is('user/ads*') ? 'd-block' : '' }}">
                        <li><a href="{{ route('user.ads.index') }}">{{ trans('Ads') }}</a></li>
                        @if(auth()->user()->plan->user_can_post ?? false)
                            <li><a href="{{ route('user.ptc-ads.index') }}">{{ trans('My Ads') }}</a></li>
                        @endif
                        <li><a href="{{ route('user.ads.click') }}">{{ trans('Click') }}</a></li>
                    </ul>
                </li>
                <li class="{{ request()->is('*/support') ? 'active':'' }}">
                    <a href="{{ url('/user/support') }}"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/dashboard.png') }}"
                            alt=""><span>{{ __('Support') }}</span></a>
                </li>

                <li class="treeview {{ Request::is('user/profile*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)"><img class="menu-icon" src="{{ asset('frontend/dashboard/img/bg-img/user.png') }}" alt="">
                        <span>{{ __('Account') }}</span> <i class="fa fa-angle-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Request::is('user/profile*') ? 'd-block' : '' }}">
                        <li class="{{ Route::is('user.profile.index') ? 'active' : null }}">
                            <a href="{{ route('user.profile.index') }}">{{ __('My Profile') }}</a>
                        </li>
                        <li class="{{ Route::is('user.profile.password') ? 'active' : null }}">
                            <a href="{{ route('user.profile.password') }}">{{ __('Change Password') }}</a>
                        </li>

                        <li>
                            <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('Logout') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
@csrf
</form>
