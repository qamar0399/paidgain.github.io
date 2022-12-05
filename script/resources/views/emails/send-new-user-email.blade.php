@component('mail::message')
<h3>Welcome Mr/Ms. {{ $user->name }}</h3>
<br>{{ __('your account is ready for use') }}
<br>{{ __('Here is your credentials') }}
<br>{{ __('Email') }}: {{ $user->email }}<br> {{ __('Password') }}: {{ $password }}
@endcomponent
