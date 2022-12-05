@extends('layouts.user.app')

@section('title', __('Ads Click Show'))

@section('content')
<div class="dashboard-card-area">
    <div class="row">
        <div class="col-12">
            <h2 class="dashboard-title">{{ __('Ads Click Show') }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ __('All Ads Click Show') }}</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">{{ __('Id') }}</th>
                                    <th class="align-middle">{{ __('Ads Name') }}</th>
                                    <th class="align-middle">{{ __('Ads Type') }}</th>
                                    <th class="align-middle">{{ __('Date') }}</th>
                                    <th class="align-middle">{{ __('Total Earn') }}</th>
                                    <th class="align-middle">{{ __('Total Click') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ades as $key=>$ads)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ads->title }}</td>
                                    <td>
                                        {{ str_replace('_',' ',$ads->ads_type) }}
                                    </td>
                                    <td>
                                        {{ $ads->pivot->created_at->toDateString() }}
                                    </td>
                                    <td>
                                        {{ $ads->amount }}
                                    </td>
                                    <td>
                                        1
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <div class="pagination-area mt-5">
                        {{ $ades->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
