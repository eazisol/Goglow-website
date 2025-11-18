@extends('layouts.main')
{{-- Title --}}
@section('title', 'Sign Up')

{{-- Style Files --}}
@section('styles')
<style>
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
    .small-text { font-size: 13px; color: #666; }
    .input-group-text { background: #fff; }
    .password-toggle { cursor: pointer; }
    .required { color: var(--error-color); }
    .policy-link { text-decoration: underline; }
</style>
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	<!-- Signup Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Signup image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('images/kimia-kazemi-u93nTfWqR9w-unsplash.jpg') }}" alt="Sign Up">
                        </figure>
                        
                        <!-- Feature List Start -->
                        {{-- <div class="mt-4">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">why join</h3>
                                <h2 class="text-anime-style-2" >Beauty made <span>simple</span></h2>
                            </div>
                            <ul class="feature-list">
                                <li><i class="fa fa-check"></i><span>Book services with top-rated professionals</span></li>
                                <li><i class="fa fa-check"></i><span>Track appointments and manage reschedules</span></li>
                                <li><i class="fa fa-check"></i><span>Get personalized beauty recommendations</span></li>
                                <li><i class="fa fa-check"></i><span>Access member-only deals and perks</span></li>
                            </ul>
                        </div> --}}
                        <!-- Feature List End -->
                    </div>
                    <!-- Signup image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Signup Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-title mb-4">
                            <h3 class="wow fadeInUp">Create Account</h3>
                            <h2 class="text-anime-style-2" >Join <span>Glaura</span></h2>
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
                        
                        <form method="POST" action="{{ route('signup.store') }}" data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number (with country code)" value="{{ old('phone') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location (City, Country)" value="{{ old('location') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password (at least 6 characters)" required minlength="6">
                                        <span class="input-group-text password-toggle" onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required minlength="6">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a class="policy-link" href="{{ url('/terms_condition') }}">Terms</a> and <a class="policy-link" href="{{ url('/privacy_policy') }}">Privacy Policy</a>
                                        </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Create account</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                    <p class="mt-3 mb-0">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Signup Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Signup Section End -->
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


