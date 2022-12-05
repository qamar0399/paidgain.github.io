@extends('layouts.user.app')

@section('title', __('Referral List'))

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header shadow-sm">
                        <div class="row justify-content-beetween align-items-center">
                            <div class="col-6">
                                <div class="referral-title">
                                    <h4>{{ __('Referral List') }}</h4>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="input-group">
                                    <span class="input-group-text">{{ trans('Your Referral Link') }}</span>
                                    <input id="refer-link" type="text" class="form-control"
                                        value="{{ route('frontend.referral.index', auth()->id()) }}" readonly>
                                    <button onclick="copy()" class="input-group-text btn btn-dark">{{ __('Copy') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-center table-borderless">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">#</th>
                                        <th class="align-middle">{{ __('Refferd By') }}</th>
                                        <th class="align-middle">{{ __('Amount') }}</th>
                                        <th class="align-middle">{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($referrals as $referral)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ optional($referral->referredBy)->name }}</td>
                                            <td>{{ currency_format($referral->amount) }}</td>
                                            <td>
                                                {{ $referral->created_at->format('d F, y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        function copy() {
            var copyText = document.getElementById("refer-link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
@endpush
