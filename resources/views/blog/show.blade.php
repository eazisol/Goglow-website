@extends('layouts.mainInnerPages')

@section('title', 'Blog Article')

@section('styles')
@php
    $cssPath = public_path('css/blog.css');
    $cssVersion = file_exists($cssPath) ? filemtime($cssPath) : time();
@endphp
<link href="{{ asset('css/blog.css') }}?v={{ $cssVersion }}" rel="stylesheet" media="screen">
@endsection

@section('content')
<!-- Blog Detail Page Section Start -->
<div class="blog-detail-page-section">
    <div class="container">
        <!-- Back to Blog Link -->
        <div class="blog-detail-back">
            <a href="/blogs" class="blog-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>{{ __('app.blog.back_to_blog') }}</span>
            </a>
        </div>

        <!-- Loading State -->
        <div id="blog-detail-loading" class="blog-detail-loading">
            <div class="blog-spinner"></div>
            <p>{{ __('app.common.loading_article') }}</p>
        </div>

        <!-- Error State -->
        <div id="blog-detail-error" class="blog-detail-error" style="display: none;">
            <div class="blog-error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h3>{{ __('app.blog.article_not_found') }}</h3>
            <p id="blog-detail-error-message">{{ __('app.blog.article_not_found_message') }}</p>
            <a href="/blogs" class="blog-retry-btn">{{ __('app.blog.back_to_blog') }}</a>
        </div>

        <!-- Article Content -->
        <article id="blog-detail-content" class="blog-detail-content" style="display: none;">
            <!-- Article Header -->
            <header class="blog-detail-header">
                <h1 id="blog-detail-title" class="blog-detail-title"></h1>
                <div id="blog-detail-meta" class="blog-detail-meta"></div>
            </header>

            <!-- Featured Image -->
            <div id="blog-detail-image-container" class="blog-detail-image" style="display: none;">
                <img id="blog-detail-image" src="" alt="" loading="lazy">
            </div>

            <!-- Article Body -->
            <div id="blog-detail-body" class="blog-detail-body">
                <!-- Content will be inserted here -->
            </div>

            <!-- Article Footer -->
            <footer class="blog-detail-footer">
                <div id="blog-detail-tags" class="blog-detail-tags" style="display: none;">
                    <!-- Tags will be inserted here -->
                </div>
                <div class="blog-detail-share">
                    <a href="/blogs" class="blog-back-to-list">
                        <i class="fas fa-arrow-left"></i>
                        <span>{{ __('app.blog.back_to_all_articles') }}</span>
                    </a>
                </div>
            </footer>
        </article>
    </div>
</div>
<!-- Blog Detail Page Section End -->
@endsection

@section('scripts')
@php
    $jsPath = public_path('js/blog.js');
    $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
@endphp
<script src="{{ asset('js/blog.js') }}?v={{ $jsVersion }}"></script>
<script>
    // Initialize blog detail page when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        const articleId = {{ $id }};
        fetchArticleDetail(articleId);
    });
</script>
@endsection

