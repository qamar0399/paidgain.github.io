<li class="menu-header">{{ __('Dashboard') }}</li>
<li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
</li>
<li class="menu-header">{{ __('Manage PTC') }}</li>
<li class="{{ Request::is('admin/ptc-ads*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.ptc-ads.index') }}"><i class="fas fa-ad"></i>
        <span>{{ __('PTC Ads') }}</span>
    </a>
</li>


<li class="{{ Request::is('admin/membership-plans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.membership-plans.index') }}"><i class="fas fa-layer-group"></i>
        <span>{{ __('Subscription Plans') }}</span>
    </a>
</li>
<li class="{{ Request::is('admin/deposits*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.deposits.all') }}"><i class="fas fa-dollar-sign"></i>
        <span>{{ __('Manage Deposit') }}</span>
    </a>
</li>
<li class="menu-header">{{ __('User Management') }}</li>
<li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.users.all') }}"><i class="fas fa-dollar-sign"></i>
        <span>{{ __('Manage Users') }}</span>
    </a>
</li>


<li class="dropdown {{ request()->is('*/withdraw-methods*') || request()->is('*/withdraws*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>{{ __('Withdraws') }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ request()->is('*/withdraws') ? 'active' : '' }}">
            <a class="nav-link"
                href="{{ route('admin.withdraws.index') }}">{{ __('Withdraws Requests') }}</a>
        </li>
        <li class="{{ request()->is('*/withdraw-methods') ? 'active' : '' }}">
            <a class="nav-link"
                href="{{ route('admin.withdraw-methods.index') }}">{{ __('Withdrawal Methods') }}</a>
        </li>
    </ul>
</li>
<li class="dropdown {{ Request::is('admin/report*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
            class="fas fa-chart-line"></i><span>{{ __('Reports') }}</span></a>
    <ul class="dropdown-menu">
        <li>
            <a class="nav-link {{ request()->is('*/transaction') ? 'active' : '' }}"
                href="{{ route('admin.report.transaction') }}">{{ __('Transaction Logs') }}</a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('*/subscriptions') ? 'active' : '' }}"
                href="{{ route('admin.report.subscriptions') }}">
                {{ __('Subscription Logs') }}
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->is('*/referrals') ? 'active' : '' }}"
                href="{{ route('admin.report.referrals') }}">
                {{ __('Referral Logs') }}
            </a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('admin/users/send-email*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.users.send.email') }}"><i class="fas fa-envelope"></i>
        <span>{{ __('Email Marketing') }}</span>
    </a>
</li>
<li class="{{ Request::is('admin/support*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.support.index') }}"><i class="fas fa-headphones-alt"></i>
        <span>{{ __('Support') }}</span>
    </a>
</li>
<li class="menu-header">{{ __('Payment Gateway') }}</li>
<li class="{{ Request::is('admin/gateway*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.gateway.index') }}">
        <i class="fas fa-wallet"></i>
        <span>{{ __('Gateway') }}</span>
    </a>
</li>
<li class="menu-header">{{ __('Settings') }}</li>
<li
    class="nav-item dropdown {{ Request::is('admin/menu') ? 'show active' : '' }} {{ Request::is('admin/language') ? 'show active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cogs"></i>
        <span>{{ __('Settings') }}</span></a>
    <ul class="dropdown-menu">

        <li class="{{ Request::is('admin/language') ? 'active' : '' }}">
            <a href="{{ route('admin.language.index') }}"
                class="nav-link"><span>{{ __('Languages') }}</span></a>
        </li>


        <li><a class="nav-link" href="{{ route('admin.menu.index') }}">{{ __('Menu Settings') }}</a>
        </li>

        <li><a class="nav-link" href="{{ route('admin.seo.index') }}">{{ __('SEO Settings') }}</a>
        <li><a class="nav-link" href="{{ route('admin.env.index') }}">{{ __('System Settings') }}</a>
        </li>
        <li><a class="nav-link" href="{{ route('admin.app.settings') }}">{{ __('App Settings') }}</a>
    </ul>
</li>
<li class="menu-header">{{ __('Website Management') }}</li>
<li class="nav-item dropdown {{ Request::is('admin/website/*') ? 'show active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-desktop"></i>
        <span>{{ __('Website') }}</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('admin.website.logo.index') }}">{{ __('Logo') }}</a></li>
        <li><a class="nav-link"
                href="{{ route('admin.website.heading.index') }}">{{ __('Section Headings') }}</a></li>
        <li><a class="nav-link"
                href="{{ route('admin.website.top-investors.index') }}">{{ __('Top Investors') }}</a></li>
        <li><a class="nav-link"
                href="{{ route('admin.website.team-members.index') }}">{{ __('Team Members') }}</a></li>
        <li><a class="nav-link" href="{{ route('admin.website.faq.index') }}">{{ __('FAQ') }}</a></li>
        <li><a class="nav-link" href="{{ route('admin.website.about.index') }}">{{ __('About') }}</a>
        </li>
        <li><a class="nav-link" href="{{ route('admin.website.footer.index') }}">{{ __('Footer') }}</a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('admin/media*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.media.list') }}">
        <i class="far fa-file-image"></i>
        <span>{{ __('Media') }}</span>
    </a>
</li>
<li class="{{ Request::is('admin/blog*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger"></i>
        <span>{{ __('Blog') }}</span></a>
    <ul class="dropdown-menu">
        <li>
            <a class="nav-link" href="{{ route('admin.blog.create') }}">{{ __('Blog Create') }}</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.blog.index') }}">{{ __('Blog List') }}</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('Categories') }}</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.tag.index') }}">{{ __('Tags') }}</a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('admin/page*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i>
        <span>{{ __('Custom Page') }}</span></a>
    <ul class="dropdown-menu">
        <li>
            <a class="nav-link {{ Request::is('*/create') ? 'active' : null }}"
                href="{{ route('admin.page.create') }}">{{ __('Page Create') }}</a>
        </li>
        <li>
            <a class="nav-link  {{ Request::is('*/page') ? 'active' : null }}"
                href="{{ route('admin.page.index') }}">{{ __('Page List') }}</a>
        </li>
    </ul>
</li>
<li class="{{ Request::is('admin/review*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-comments"></i>
        <span>{{ __('Reviews') }}</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="nav-link" href="{{ route('admin.review.create') }}">{{ __('Create Review') }}</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.review.index') }}">{{ __('Review List') }}</a>
        </li>
    </ul>
</li>
@can('role.list', 'admin.list')
<li
   class="dropdown {{ Request::is('admin/role*') ? 'active' : '' }} {{ Request::is('admin/users*') ? 'active' : '' }}">
   <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
      class="fas fa-user-shield"></i><span>{{ __('Admins & Roles') }}</span></a>
   <ul class="dropdown-menu">
      @can('role.list')
      <li>
         <a class="nav-link" href="{{ route('admin.role.index') }}">{{ __('Roles') }}</a>
      </li>
      @endcan
      @can('admin.list')
      <li><a class="nav-link" href="{{ route('admin.admin.index') }}">{{ __('Admins') }}</a>
      </li>
      @endcan
   </ul>
</li>
@endcan
