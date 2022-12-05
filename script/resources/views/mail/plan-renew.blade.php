@component('mail::message')

    Dear {{ $mailable['name'] }},

    {!! $mailable['message'] ?? '' !!}
    Plan : {{ $mailable['plan'] }}
@if($mailable['type'] == 'expired')
    Date of Expire : {{ $mailable['will_expire'] }}
@elseif($mailable['type'] == 'expirable')
    Date of Due : {{ $mailable['will_expire'] }}
@endif

Thanks,
{{ strtoupper(config('app.name')) }}
@endcomponent
