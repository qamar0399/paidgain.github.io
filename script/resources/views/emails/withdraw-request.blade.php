@component('mail::message')
<h1 style="text-align: center; color: #6777ef; text-shadow: 3px 0px 3px rgb(81 67 21 / 80%), -3px 0px 3px rgb(81 67 21 / 80%), 0px 4px 2px rgb(81 67 21 / 80%); font-size: 35px;">@lang('Withdraw request from') {{ env('APP_NAME') }}</h1>

<table style="width: 100%; border: 1px solid #000">
    <thead style="background: rgb(248,249,250); padding: 10px 0;">
        <tr>
            <th>Amount</th>
            <th>Charge</th>
            <th>Currency</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{ $withdraw->amount }}</th>
            <th>{{ $withdraw->charge }}</th>
            <th>{{ $withdraw->currency }}</th>
        </tr>
    </tbody>
</table>
@endcomponent
