@component('mail::message')
@isset($data['name'])
<p>Hello <b>{{ $data['name'] }},</b></p>
@endisset

<p>Please upgrade your plan otherwise your plan will be expire. Your plan expire date is {{ $data['will_expire'] }}.</p>

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent