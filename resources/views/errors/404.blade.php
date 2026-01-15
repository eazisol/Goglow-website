@extends('layouts.mainInnerPages')
{{-- Title --}}
@section('title', '404 - Page Not Found')

{{-- Style Files --}}
@section('styles')
<style>
    .error-page-modern {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 20px;
    }

    .error-page-container {
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }

    .error-code {
        font-size: 120px;
        font-weight: 800;
        background: linear-gradient(93deg, #2c0d18 0%, #e50050 50%, #ff8c00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 20px;
        font-family: 'Raflesia', serif;
    }

    .error-title {
        font-size: 42px;
        font-weight: 700;
        color: #2c0d18;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .error-title .highlight {
        background: linear-gradient(93deg, #e50050 0%, #ff8c00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .error-description {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .error-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .error-btn {
        padding: 16px 32px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .error-btn-primary {
        background: linear-gradient(93deg, #e50050 0%, #ff8c00 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(229, 0, 80, 0.3);
    }

    .error-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(229, 0, 80, 0.4);
        color: white;
        text-decoration: none;
    }

    .error-btn-secondary {
        background: white;
        color: #e50050;
        border: 2px solid #e50050;
    }

    .error-btn-secondary:hover {
        background: #e50050;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .error-illustration {
        margin-bottom: 40px;
    }

    .error-illustration img {
        max-width: 100%;
        height: auto;
        max-height: 300px;
    }

    @media (max-width: 768px) {
        .error-code {
            font-size: 80px;
        }

        .error-title {
            font-size: 32px;
        }

        .error-description {
            font-size: 16px;
        }

        .error-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .error-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection


{{-- Content --}}
@section('content')
    <!-- Error Page Start -->
    <div class="error-page-modern">
        <div class="container">
            <div class="error-page-container">
                <!-- Error Code -->
                <div class="error-code">404</div>
                
                <!-- Error Illustration -->
                <div class="error-illustration">
                    <img src="{{ asset('images/404-error-img.png') }}" alt="404 Error" onerror="this.style.display='none'">
                </div>
                
                <!-- Error Title -->
                <h1 class="error-title">
                    {{ __('app.error_404.title') }} <span class="highlight">{{ __('app.error_404.title_highlight') }}</span>
                </h1>
                
                <!-- Error Description -->
                <p class="error-description">
                    {{ __('app.error_404.description') }}
                </p>
                
                <!-- Error Actions -->
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="error-btn error-btn-primary">
                        <span>{{ __('app.error_404.go_home') }}</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2L3 7V17H8V12H12V17H17V7L10 2Z" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="javascript:history.back()" class="error-btn error-btn-secondary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ __('app.error_404.go_back') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Page End -->
@endsection


{{-- Scripts --}}
@section('scripts')

@endsection
