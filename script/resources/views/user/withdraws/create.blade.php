@extends('layouts.user.app')

@section('content')
    <div class="section-body create-withdraw">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header shadow-sm">
                        <h4 class="create-title">{{ trans('Create new withdraw') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.withdraws.store') }}" method="post" class="withdraw_form">
                            @csrf

                            <div class="row gap-2">
                                <div class="col-12">
                                    <label for="withdraw-method" class="form-label text-dark">{{ trans('Withdraw') }}</label>
                                    <select class="form-select form--select" id="withdraw-method" name="withdraw_method_id"
                                        required>
                                        <option value="">{{ trans('Select Method') }}</option>
                                        @foreach ($methods as $method)
                                            <option {{ request('method') == $method->id ? 'selected' : '' }}
                                                value="{{ $method->id }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="amount" class="form-label text-dark">{{ trans('Amount') }}</label>
                                    <div class="input-group">
                                        <input type="number" min="0" id="amount" name="amount" class="form-control form--control"  placeholder="{{ trans('Withdraw Amount') }}" value="0" step=".01" required>
                                        <span class="input-group-text currency">{{ trans('Wait...') }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="commants" class="form-label text-dark">{{ trans('Comments') }}</label>
                                    <textarea name="commants" id="commants" class="form-control" rows="3" required placeholder="{{ trans('Account infos/others') }}"></textarea>
                                </div>
                            </div>
                            <div class="mt-3 preview-details">
                                <ul class="list-group text-center">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Method') }}</span>
                                        <span class="name"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Limit') }}</span>
                                        <span><span class="min fw-bold min_limit">0</span> <span class="currency"></span> - <span class="fw-bold max_limit">0</span>
                                        <span class="currency"></span></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Conversation') }}</span>
                                        <span>
                                            <span class="fw-bold">
                                                {{ defaultcurrency()->rate .' '. str(defaultcurrency()->currency)->upper() }}
                                            </span>
                                            -
                                            <span class="fw-bold conversation">0</span>
                                            <span class="currency"></span>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Quotient') }}</span>
                                        <span class="fw-bold">
                                            <span class="calculation">0</span>
                                            <span>{{ str(defaultcurrency()->currency)->upper() }}</span>
                                        </span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Wallet') }}</span>
                                        <span class="wallet fw-bold"></span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Charge Type') }}</span>
                                        <span class="charge-type"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ trans('Charge') }}</span>
                                        <span class="fw-bold">
                                            <span class="charge"> 0 </span>
{{--                                            <span class="currency"></span>--}}
                                        </span>

                                    </li>
                                </ul>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 mt-4 basicbtn">{{ trans('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        $('.preview-details').fadeOut();

        var method = $('#withdraw-method').val();
        if (method) {
            getMethod()
        }

        $('#withdraw-method').on('change', function() {
            getMethod()
        });

        function getMethod() {
            var method = $('#withdraw-method').val();
            $('.create-title').text('Please wait...');

            $.ajax({
                type: 'GET',
                url: `{{ route('user.withdraws.create') }}`,
                data: {
                    method: method
                },
                success: function(res) {
                    if (res) {
                        $('.create-title').text('Create new withdraw');
                        $('.preview-details').fadeIn();
                        $('.name').text(res.method.name)
                        $('.currency').text(res.method.currency)
                        $('.min_limit').text(res.method.min_limit)
                        $('.max_limit').text(res.method.max_limit)
                        $('.conversation').text(res.conversation)
                        $('.wallet').text(res.wallet)
                        $('.charge').text(res.method.percent_charge > 0 ? res.method.percent_charge : res.method.fixed_charge)
                        $('.charge-type').text(res.method.percent_charge ? 'Parcentage' : 'Fixed')
                    }
                },
                error: function(xhr, status, error) {
                    Sweet('error', item)
                }
            })
        }


        $(".withdraw_form").on('submit', function(e) {
            e.preventDefault();

            var basicbtnhtml = $('.basicbtn').html();
            $.ajax({
                type: 'POST',
                url: this.action,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('.basicbtn').html("Please Wait....");
                    $('.basicbtn').attr('disabled', '')
                },

                success: function(response) {
                    console.log(response)
                    $('.basicbtn').removeAttr('disabled')
                    Sweet('success', response);
                    $('.basicbtn').html(basicbtnhtml);
                    $('.withdraw_form').trigger('reset');
                    
                },
                error: function(err, status, error) {
                    $('.basicbtn').html(basicbtnhtml);
                    $('.basicbtn').removeAttr('disabled')
                    $('.errorarea').show();
                    Sweet('error', err.responseJSON)
                }
            })
        });

        $('#amount').on('input', function () {
            const conversation = $('.conversation').text();
            const amount = $(this).val();
            const calculate = amount / conversation
            $('.calculation').text(calculate.toFixed(2));
        })
    </script>
@endpush
