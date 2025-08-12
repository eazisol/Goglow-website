@extends('layouts.main')

@section('styles')
<style>
    .auth-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .auth-card .card-cover img {
        display: block;
        width: 100%;
        height: 240px;
        object-fit: cover;
    }
    .auth-card .card-body { padding: 24px; }
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
    .small-text { font-size: 13px; color: #666; }
    .page-header .container { padding-top: 24px; padding-bottom: 24px; }
    .alert { border-radius: 8px; }
    .input-group-text { background: #fff; }
    .password-toggle { cursor: pointer; }
    .btn-default { width: 100%; }
    .divider { display: flex; align-items: center; gap: 12px; color: #999; margin: 16px 0; }
    .divider::before, .divider::after { content: ""; flex: 1; height: 1px; background: #eee; }
    .social-btn { width: 100%; background: #fff; border: 1px solid #e9ecef; color: #1c1c1c; }
    .social-btn img { width: 18px; height: 18px; margin-right: 8px; }
    .text-anime-style-2 span { color: var(--primary-color); }
    .required { color: var(--error-color); }
    .help-block { font-size: 12px; color: var(--error-color); }
    .policy-link { text-decoration: underline; }
    .auth-side-copy { color: #555; }
    .auth-side-copy .feature-list li { color: #555; }
    .auth-side-copy .feature-list li i { color: #999; }
    @media (max-width: 991px) { .auth-card .card-cover img { height: 180px; } }
    @media (max-width: 575px) { .auth-card .card-body { padding: 16px; } }
    .header--transparent .nav-link, .header--transparent .header-logo { color: #fff !important; }
    .header--solid .nav-link, .header--solid .header-logo { color: #1c1c1c !important; }
</style>
@endsection

@section('content')
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"></div>
            </div>
        </div>
    </div>

    <div class="page-contact-us">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <div class="auth-card">
                        <div class="card-cover">
                            <img src="{{ asset('images/hero-image.png') }}" alt="Create your account">
                        </div>
                        <div class="card-body">
                            <div class="section-title mb-3">
                                <h3 class="wow fadeInUp">create account</h3>
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Join <span>GoGlow</span></h2>
                                <p class="small-text">Sign up to book beauty services, track appointments, and enjoy member perks.</p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('signup.store') }}" novalidate class="wow fadeInUp" data-wow-delay="0.1s">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="name" class="form-label">Full Name <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Jane Doe" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. +33 6 01 02 03 04" value="{{ old('phone') }}" required>
                                        <span class="small-text">Include country code.</span>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="location" class="form-label">Location <span class="required">*</span></label>
                                        <input type="text" name="location" id="location" class="form-control" placeholder="City, Country" value="{{ old('location') }}" required>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="password" class="form-label">Password <span class="required">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="At least 6 characters" required minlength="6">
                                            <span class="input-group-text password-toggle" onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="required">*</span></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repeat password" required minlength="6">
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a class="policy-link" href="{{ url('/terms_condition') }}">Terms</a> and <a class="policy-link" href="{{ url('/privacy_policy') }}">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default"><span>Create account</span></button>
                                    </div>
                                </div>
                            </form>

                            <div class="divider">or</div>
                            <button type="button" class="btn btn-light social-btn" disabled>
                                <img src="{{ asset('images/icon-google.svg') }}" alt="Google"> Continue with Google
                            </button>
                            <p class="small-text mt-3 mb-0">Already have an account? <a href="#">Sign in</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-1">
                    <div class="auth-side-copy">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">why join</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Beauty made <span>simple</span></h2>
                            <p class="app-description">Create your GoGlow account to unlock seamless booking, personalized recommendations, and exclusive member offers.</p>
                        </div>
                        <ul class="feature-list">
                            <li><i class="fa fa-check"></i><span>Book services with top-rated professionals</span></li>
                            <li><i class="fa fa-check"></i><span>Track appointments and manage reschedules</span></li>
                            <li><i class="fa fa-check"></i><span>Get personalized beauty recommendations</span></li>
                            <li><i class="fa fa-check"></i><span>Access member-only deals and perks</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
// client-side light validation feedback
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form?.addEventListener('submit', function (e) {
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        if (password && confirm && password.value !== confirm.value) {
            e.preventDefault();
            alert('Passwords do not match.');
            confirm.focus();
        }
    });
});
</script>
@endsection


