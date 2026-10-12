@extends('front.layouts.app')
@section('content')
<section class="section-5 auth-section registration-section">
    <div class="container">
        <div class="auth-compact">
            <div class="auth-panel">
                @session('success')
                    <p class="alert alert-success fw-bold text-center">{{ Session()->get('success') }}</p>
                @endsession
                <div class="auth-card">
                    <div class="auth-heading">
                        <h2>Login</h2>
                    </div>
                    <form action="{{ route('account.check.login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div> 
                        <button class="btn btn-primary auth-submit" type="submit">Login</button>
                    </form>                    
                </div>
                <div class="auth-switch">
                    <p>Do not have an account? <a  href="{{ route('account.registration') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
