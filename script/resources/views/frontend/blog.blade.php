@extends('layouts.frontend.app')

@section('title', __('Blog'))

@section('content')
    <!-- Blog Area -->
    <div class="blog-area section-padding-100-50">
        @isset($blog_news)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="heading-title text-center">
                            <h3>{{ $blog_news->name }}</h3>
                            <p>{{ $blog_news->other }}</p>
                        </div>
                    </div>
                </div>
                @isset($posts)
                    <div class="row justify-content-center">
                        @foreach($posts as $post)
                            <!-- Single Blog Card -->
                            <div class="col-md-6 col-lg-4">
                                <div class="single-card-blog">
                                    <!-- Blog Header -->
                                    <div class="blog-header-image">
                                        <img src="{{ $post->preview->value ?? asset('frontend/img/bg-img/no-image.jpg')}}" alt="card__image" class="card__image">
                                    </div>
                                    <!-- Body Text -->
                                    <div class="blog-body-text">
                                        {{--<span class="tag tag-blue">Technology</span>--}}
                                        <h4><a href="{{ route('frontend.blog-post', $post->slug) }}">{{ $post->title }}</a></h4>
                                        {{ content_format(optional($post->excerpt)->value) }}
                                    </div>
                                    <!-- Blog Footer -->
                                    <div class="blog-footer d-flex align-items-center mt-3">
                                        <div class="user-image">
                                            <img src="{{ asset('frontend/img/bg-img/i-1.jpg') }}" alt="user__image" class="user__image">
                                        </div>
                                        <div class="user__info">
                                            <h5>{{ $post->user->name }}</h5>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
                <!-- Pagination Area -->
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-area mb-50">
                            {{ $posts->links('frontend.components.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                {{ __('If you are admin please add information') }} <a href="{{ route('admin.website.heading.index') }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
            </div>
        @endisset
    </div>
    <!-- Blog Area -->
@endsection
