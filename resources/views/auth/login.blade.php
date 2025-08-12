@extends('layouts.main')

@section('styles')
<style>
    .auth-card { background: #fff; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .auth-card .card-cover img { display: block; width: 100%; height: 220px; object-fit: cover; }
    .auth-card .card-body { padding: 24px; }
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
    .btn-default { width: 100%; }
</style>
@endsection

@section('content')
    <div class="page-header bg-section">
        <div class="container"><div class="row"><div class="col-lg-12"></div></div></div>
    </div>
    <div class="page-contact-us">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-6 mx-auto">
                    <div class="auth-card">
                        <div class="card-cover">
                            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Login">
                        </div>
                        <div class="card-body">
                            <div class="section-title mb-3">
                                <h3 class="wow fadeInUp">welcome back</h3>
                                <h2 class="text-anime-style-2" data-cursor="-opaque">Sign in to <span>GoGlow</span></h2>
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

                            <form method="POST" action="{{ route('login.store') }}">
                                @csrf
                                <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn-default"><span>Sign in</span></button>
                                <p class="mt-3 mb-0">No account? <a href="{{ route('signup') }}">Create one</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


