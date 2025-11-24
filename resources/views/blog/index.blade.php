@extends('layouts.mainInnerPages')

@section('title', 'Blog')

@section('styles')
@php
    $cssPath = public_path('css/blog.css');
    $cssVersion = file_exists($cssPath) ? filemtime($cssPath) : time();
@endphp
<link href="{{ asset('css/blog.css') }}?v={{ $cssVersion }}" rel="stylesheet" media="screen">
@endsection

@section('content')
<!-- Blog Page Section Start -->
<div class="blog-page-section">
    <div class="container">
        <!-- Page Header -->
        <div class="blog-page-header">
            <h1 class="blog-page-title">Our Blog</h1>
            <p class="blog-page-subtitle">Discover the latest articles and insights</p>
        </div>

        <!-- Loading State -->
        <div id="blog-loading" class="blog-loading">
            <div class="blog-spinner"></div>
            <p>Loading articles...</p>
        </div>

        <!-- Error State -->
        <div id="blog-error" class="blog-error" style="display: none;">
            <div class="blog-error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h3>Oops! Something went wrong</h3>
            <p id="blog-error-message">Failed to load articles. Please try again later.</p>
            <button class="blog-retry-btn" onclick="fetchArticles(currentPage)">Try Again</button>
        </div>

        <!-- Empty State -->
        <div id="blog-empty" class="blog-empty" style="display: none;">
            <div class="blog-empty-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3>No articles found</h3>
            <p>There are no articles available at the moment. Please check back later.</p>
        </div>

        <!-- Articles Grid -->
        <div id="blog-articles-container" class="blog-articles-grid" style="display: none;">
            <!-- Articles will be dynamically inserted here -->
        </div>

        <!-- Pagination -->
        <div id="blog-pagination" class="blog-pagination" style="display: none;">
            <button id="blog-prev-btn" class="blog-pagination-btn blog-pagination-btn-prev" onclick="goToPreviousPage()" disabled>
                <i class="fas fa-chevron-left"></i>
                <span>Previous</span>
            </button>
            <div class="blog-pagination-info">
                <span id="blog-page-info">Page 1 of 1</span>
            </div>
            <button id="blog-next-btn" class="blog-pagination-btn blog-pagination-btn-next" onclick="goToNextPage()" disabled>
                <span>Next</span>
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
<!-- Blog Page Section End -->
@endsection

@section('scripts')
@php
    $jsPath = public_path('js/blog.js');
    $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
@endphp
<script src="{{ asset('js/blog.js') }}?v={{ $jsVersion }}"></script>
<script>
    // Initialize blog page when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get page number from URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const page = parseInt(urlParams.get('page')) || 1;
        fetchArticles(page);
    });
</script>
@endsection
