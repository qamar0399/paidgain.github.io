@component('mail::message')
@isset($data['name'])
<p>Name: <b>{{ $data['name'] }}</b></p>
@endisset
@isset($data['subject'])
<p>Subject: <b>{{ $data['subject'] }}</b></p>
@endisset

{{ $data['message'] }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent