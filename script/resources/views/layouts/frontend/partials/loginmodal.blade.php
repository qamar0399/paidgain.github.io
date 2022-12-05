<!-- Login Area -->
<div class="login-area">
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Login tab Area -->
                    <div class="login-tab-area">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">
                                    {{ __('Login') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">
                                    {{ __('Register') }}
                                </button>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <div class="modal-body">
                                    <h5 class="modal-title" id="loginModalLabel">
                                        <i class="far fa-sign-in"></i>
                                        {{ __('Login') }}
                                    </h5>
                                    <form action="{{ route('login', request()->all()) }}" method="POST" class="auth_form">
                                        @csrf
                                        <div class="mb-30">
                                            <label for="recipient-name2" class="col-form-label">
                                                {{ __('Email') }}
                                            </label>
                                            <input type="text" class="form-control focus-input100" id="recipient-name2" name="email" placeholder="{{ __('Enter Email Address') }}">
                                        </div>
                                        <div>
                                            <label for="recipient-name" class="col-form-label">
                                                <span>{{ __('Password') }}</span>
                                                <a class="forgot-btn" href="{{ url('/password/reset') }}">
                                                    {{ __('Forgot Password?') }}
                                                </a>
                                            </label>
                                            <input type="password" name="password" class="form-control" id="recipient-name" placeholder="**********">
                                        </div>
                                        <button type="submit" class="login-submit basicbtn">{{ __('Login') }}</button>
                                    </form>
                                    <!-- Button -->
                                    <!-- Other Sign Up -->
                                     @if(env('GOOGLE_CLIENT_ID') != null || env('FACEBOOK_CLIENT_ID') != null)
                                    <div class="other-sign-up-area">
                                        <p>{{ __('Or Sign Up Using') }}</p>
                                        <ul class="other-sign-list">
                                            @if(env('GOOGLE_CLIENT_ID') != null)
                                            <li><a href="{{ route('redirect-to-provider', 'google') }}"><img src="{{ asset('/frontend/img/icons/13.png') }}" alt=""></a></li>
                                            @endif
                                            @if(env('FACEBOOK_CLIENT_ID') != null)
                                            <li><a href="{{ route('redirect-to-provider', 'facebook') }}"><img src="{{ asset('/frontend/img/icons/11.png') }}" alt=""></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <div class="modal-body">
                                    <h5 class="modal-title" id="loginModalLabel2">
                                        <i class="far fa-sign-in"></i>
                                        {{ __('New Account') }}
                                    </h5>
                                    <form method="POST" action="{{ route('register') }}" class="auth_form">
                                        @csrf
                                        <div class="mb-30">
                                            <label for="recipient-name-1" class="col-form-label">
                                                {{ __('Name') }}
                                            </label>
                                            <input type="text" class="form-control focus-input100" id="recipient-name-1" name="name" required>
                                        </div>
                                        <div class="mb-30">
                                            <label for="recipient-name-2" class="col-form-label">
                                                {{ __('Phone Number') }}
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select name="phone_code" class="form-control" aria-describedby="recipient-name-2">
                                                        @foreach (phoneCodes() as $item)
                                                            <option
                                                                value="{{ $item->dial_code }}">{{ $item->code,10 }} {{ $item->dial_code }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input id="recipient-name-2" type="tel"
                                                       class="form-control focus-input100" name="phone" required
                                                       autofocus>
                                            </div>
                                        </div>
                                        <div class="mb-30">
                                            <label for="recipient-name-3"
                                                   class="col-form-label">{{ __('Email') }}</label>
                                            <input type="email" class="form-control focus-input100"
                                                   id="recipient-name-3" name="email">
                                        </div>
                                        <div class="mb-30">
                                            <label for="recipient-name-4"
                                                   class="col-form-label">{{ __('Country') }}</label>
                                            <select name="country" class="form-control" id="recipient-name-4">
                                                @foreach (countries() as $item)
                                                    <option value="{{ $item->country }}">{{ $item->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="recipient-name-5"
                                                   class="col-form-label-2"><span>{{ __('Password') }}</span></label>
                                            <input type="password" class="form-control" id="recipient-name-5"
                                                   name="password">
                                        </div>
                                        <div>
                                            <label for="recipient-name-6"
                                                   class="col-form-label-2"><span>{{ __('Confirm Password') }}</span></label>
                                            <input type="password" class="form-control" id="recipient-name-6"
                                                   name="password_confirmation">
                                        </div>
                                        <!-- Button -->
                                        <button type="submit"
                                                class="login-submit basicbtn">{{ __('Register') }}</button>
                                    </form>
                                    <!-- Other Sign Up -->
                                    @if(env('GOOGLE_CLIENT_ID') != null || env('FACEBOOK_CLIENT_ID') != null)
                                    <div class="other-sign-up-area">
                                        <p>{{ __('Or Sign Up Using') }}</p>
                                        <ul class="other-sign-list">
                                            @if(env('GOOGLE_CLIENT_ID') != null)
                                            <li><a href="{{ route('redirect-to-provider', 'google') }}"><img src="{{ asset('/frontend/img/icons/13.png') }}" alt=""></a></li>
                                            @endif
                                            @if(env('FACEBOOK_CLIENT_ID') != null)
                                            <li><a href="{{ route('redirect-to-provider', 'facebook') }}"><img src="{{ asset('/frontend/img/icons/11.png') }}" alt=""></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Area -->
