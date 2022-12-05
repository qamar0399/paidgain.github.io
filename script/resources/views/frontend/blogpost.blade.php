@extends('layouts.frontend.app')

@section('title', $post->title ?? __('Blog'))

@section('content')
    <!-- Blog Area -->
    <div class="blog-details-area section-padding-100-50">
        <div class="container">
            <div class="row">
                <!-- Content Text -->
                <div class="col-lg-9">
                    <div class="blog-details-content mb-50">
                        <div class="blog-details-image">
                            <img src="{{ $post->preview->value }}" alt="">
                        </div>
                        <div class="post-meta-date">
                            {{ formatted_date($post->created_at, 'd M') }}
                        </div>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <h2>{{ $post->title }}</h2>
                            {{ content_format($post->description->value) }}
                           <div class="card">
                               <div class="card-body">
                                   <a href="{{ Request::url() }}#disqus_thread"></a>
                                   {{ disquscomment() }}
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
                <!-- Side Blog Content -->
                <div class="col-lg-3">
                    <div class="side-blog-details-area">
                        @isset($data['recent'])
                        <div class="single-side-content">
                            <h4 class="side-blog-title">{{ __('Recent Post') }}</h4>
                            <div class="recent-post-area">
                                @foreach($data['recent'] as $recent)
                                    <!-- Single Post -->
                                    <div class="single-recent-post d-md-flex align-items-center">
                                        <div class="recent-post-img">
                                            <img src="{{ asset($recent->preview->value) ?? asset('frontend/img/bg-img/no-image.jpg') }}" alt="">
                                        </div>
                                        <div class="recent-post-text">
                                            <h5><a href="{{ route('frontend.blog-post', $recent->slug) }}">{{ $recent->title }}</a></h5>
                                            <span class="recent-post-date">{{ formatted_date($recent->created_at) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endisset
                        @isset($data['latest'])
                        <div class="single-side-content">
                            <h4 class="side-blog-title">{{ __('Latest Blog') }}</h4>
                            <div class="recent-post-area">
                                @foreach($data['latest'] as $latest)
                                    <!-- Single Post -->
                                    <div class="single-recent-post d-md-flex align-items-center">
                                        <div class="recent-post-img">
                                            <img src="{{ asset($latest->preview->value) ?? asset('frontend/img/bg-img/no-image.jpg') }}" alt="">
                                        </div>
                                        <div class="recent-post-text">
                                            <h5><a href="{{ route('frontend.blog-post', $latest->slug) }}">{{ $latest->title }}</a></h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Area -->
@endsection
