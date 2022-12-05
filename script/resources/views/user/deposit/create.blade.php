@extends('layouts.user.app')

@section('title', __('Make Payment'))

@section('content')
 <!-- Dashboard Area -->
 <div class="dashboard-card-area">
 	<h4 class="text-center">{{ __('Make Payment') }}</h4>
    <div class="container">
        <div class="row">
    <div class="col-12">
        <div class="">
            <div class="">
                <div class="row">
                    <div class="offset-2 col-lg-8">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('message'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>
                                    {{ Session::get('message') }}
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="offset-2 col-lg-8">
                        @if (Session::has('alert'))
                        <div class="alert {{ Session::get('type') }}">
                            {{ Session::get('alert') }}
                        </div>
                        @endif
                        <div class="card w-100">
                            <ul class="nav nav-pills mx-auto" id="myTab3" role="tablist">
                                @foreach ($gateways as $key => $gateway)
                                    <li class="nav-item">
                                        <a class="nav-link {{  $key == 0 ? 'active' : '' }}" id="getway-tab{{ $gateway->id }}" data-bs-toggle="tab" data-bs-target="#getway{{ $gateway->id }}"
                                            href="#getway{{ $gateway->id }}" role="tab" aria-controls="home"
                                            aria-selected="true">
                                            <div class="card-body">
                                                <img class="payment-img" src="{{ asset($gateway->logo) }}" alt="{{ $gateway->name }}"
                                                    width="100">
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="card-footer">
                                <div class="tab-content" id="myTabContent2">
                                    @foreach ($gateways as $key => $gateway)
                                        @php $data = json_decode($gateway->data) @endphp
                                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                            id="getway{{ $gateway->id }}" role="tabpanel"
                                            aria-labelledby="getway-tab{{ $gateway->id }}">
                                            <div class="">
                                                <table class="table">
                                                     <tr>
                                                        <td><strong>{{ __('Gateway Name') }}</strong></td>
                                                        <td class="float-right">{{ $gateway->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Maximum Transaction Amount') }}</strong></td>
                                                        <td class="float-right">{{ number_format($gateway->max_amount,2) }} {{ strtoupper($gateway->currency_name) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Minimum Transaction Amount') }}</strong></td>
                                                        <td class="float-right">{{ number_format($gateway->min_amount,2) }} {{ strtoupper($gateway->currency_name) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Amount') }}</strong></td>
                                                        <td class="float-right">{{ $amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Currency') }}</strong></td>
                                                        <td class="float-right">{{ strtoupper($gateway->currency_name) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Charge') }}</strong></td>
                                                        <td class="float-right">{{ $gateway->charge }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>{{ __('Rate') }}</strong></td>
                                                        <td class="float-right">{{ $gateway->rate }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>{{ __('Payable') }}</strong></td>
                                                        <td class="float-right">{{  round($amount * $gateway->rate + $gateway->charge) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <form action="{{ route('user.make-payment', $gateway->id) }}" method="post" class="ajaxform_with_next" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-row">
                                                    @if ($gateway->phone_required == 1)
                                                        <table class="table">
                                                            <tr>
                                                                <td><label for="">{{ __('Phone') }}</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        name="phone" required {{ Session::has('phone_error') ? 'is-invalid' : '' }}>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                    @if ($gateway->image_accept == 1)
                                                        <table class="table">
                                                            <tr>
                                                                <td>
                                                                    <label >{{ __('Payment Instructions') }}</label>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ content_format($gateway->data) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="screenshot">{{ __('Upload Attachment') }}</label>
                                                                    <input type="file" name="screenshot"
                                                                        class="form-control"
                                                                        value="" required/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="comment">{{ __('Comments') }}</label>
                                                                    <textarea class="form-control h-100" name="comment" id="" cols="30" rows="10"></textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                    <button type="submit"
                                                        class="btn btn-primary paymentbtn btn-lg w-100">{{ __('Make Payment')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
