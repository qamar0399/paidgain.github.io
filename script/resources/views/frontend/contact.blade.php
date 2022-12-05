@extends('layouts.frontend.app')

@section('title', __('Contact'))

@section('content')
    <!-- Contact Us Area -->
    <div class="contact-us-area section-padding-100-50">
        <div class="container">
            @isset($contact)
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="heading-title text-center">
                        <h3>{{ $contact->name }}</h3>
                        <p>{{ $contact->other }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Contact Area -->
                <div class="col-lg-8">
                    <div class="contact-area mb-50">
                        <form class="nft-contact-from ajaxform_with_reset" action="{{ route('frontend.contact.send') }}" method="post">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12 col-lg-6">
                                    <input class="form-control" type="text" name="name" placeholder="Your Name">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <input class="form-control" type="email" name="email"
                                           placeholder="Your Email">
                                </div>
                                <div class="col-12">
                                    <input class="form-control" type="text" name="subject"
                                           placeholder="Subject">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" name="message"
                                              placeholder="Type your comments..."></textarea>
                                </div>
                                <div class="col-12 text-center mt-30">
                                    <button class="ptc-btn basicbtn" type="submit"><span>Send</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @isset($contact->meta)
                <div class="col-lg-4">
                    <div class="contact-meta-info-area mb-50">
                        <!-- Contact Info -->
                        <div class="contact-meta-info d-flex align-items-center">
                            <!-- Icon -->
                            <div class="c-meta-icon">
                                <img src="{{ asset('frontend/img/icons/p-1.png') }}" alt="">
                            </div>
                            <div>
                                <h4>{{ __('Phone number') }}</h4>
                                <span>{{ json_decode($contact->meta->value)->phone ?? null }}</span>
                            </div>
                        </div>
                        <!-- Contact Info -->
                        <div class="contact-meta-info d-flex align-items-center">
                            <!-- Icon -->
                            <div class="c-meta-icon">
                                <img src="{{ asset('/frontend/img/icons/p-2.png') }}" alt="">
                            </div>
                            <div>
                                <h4>{{ __('Email') }}</h4>
                                <span>{{ json_decode($contact->meta->value)->email ?? null }}</span>
                            </div>
                        </div>
                        <!-- Contact Info -->
                        <div class="contact-meta-info d-flex align-items-center">
                            <!-- Icon -->
                            <div class="c-meta-icon">
                                <img src="{{ asset('frontend/img/icons/p-3.png') }}" alt="">
                            </div>
                            <div>
                                <h4>{{ __('Our Location') }}</h4>
                                <span>{{ json_decode($contact->meta->value)->address ?? null }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endisset
            </div>
            @endisset
        </div>
    </div>
    <!-- Contact Us Area -->
@endsection

@push('js')
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/form.js') }}"></script>
@endpush
