@extends('layouts.auth')

@section('title', 'Forgot Password - SarkariCourse')
@section('auth_heading', 'Forgot Your Password?')
@section('auth_subheading', "No problem. We'll help you get back into your account in just a minute.")

@section('content')

<span class="sc-badge">🔒 Password Reset</span>
<h3>Reset Your Password</h3>
<p class="sc-auth-form-intro">Enter your email address and we'll send you a link to reset your password.</p>

<x-auth-session-status class="sc-alert sc-alert-success" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="sc-af-group">
        <label class="sc-label" for="forgotEmail">Email Address</label>
        <input id="forgotEmail" type="email" class="sc-input" name="email" value="{{ old('email') }}" placeholder="arjun@example.com" required autofocus>
        @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="sc-btn sc-btn-primary" style="width:100%">Email Password Reset Link →</button>
</form>

<div class="sc-auth-switch" style="margin-top:20px">
    Remembered your password? <a href="{{ route('userlogin') }}">Sign in →</a>
</div>

@endsection
