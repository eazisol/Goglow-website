@extends('layouts.main')
{{-- Title --}}
@section('title', 'Login')

{{-- Style Files --}}
@section('styles')
<style>
    .form-label { font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
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
	
	<!-- Login Section Start -->
    <div class="page-book-appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Login image Start -->
                    <div class="appointment-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('images/hayley-kim-studios-sRSRuxkOuzI-unsplash.jpg') }}" alt="Login">
                        </figure>
                    </div>
                    <!-- Login image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Login Form Start -->
                    <div class="appointment-form wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-title mb-4">
                            <h3 class="wow fadeInUp">welcome back</h3>
                            <h2 class="text-anime-style-2" >Sign in to <span>GoGlow</span></h2>
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
                        
                        <form method="POST" action="{{ route('login.store') }}" data-toggle="validator">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group col-md-12 mb-4">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default"><span>Sign in</span></button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                    <p class="mt-3 mb-0">No account? <a href="{{ route('signup') }}">Create one</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Login Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End -->
@endsection


