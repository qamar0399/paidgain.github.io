@if (count($customers) > 0)
    <div class="search-header">
        {{ __('Customers') }}
    </div>

    @foreach ($customers as $customer)
        <div class="search-item">
            <a href="{{ route('admin.users.detail', $customer->username) }}">{{ $customer->name }}</a>
        </div>
    @endforeach
@else
<div class="search-item">
    <a href="javascript:void(0)"> {{ ('No data found!') }}</a>
</div>
@endif
