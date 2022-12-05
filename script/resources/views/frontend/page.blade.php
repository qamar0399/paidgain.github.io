@extends('layouts.frontend.app')

@section('title', $page->title)

@section('content')
    <div class="container">
        <div class="blog-area section-padding-100-50">
            {{ content_format($info->page_content ?? null) }}
        </div>
    </div>
@endsection
