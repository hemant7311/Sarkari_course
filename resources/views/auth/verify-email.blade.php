@extends('layouts.auth')

@section('title', 'Verify Email - SarkariCourse')
@section('auth_heading', "You're Almost There!")
@section('auth_subheading', "Just one more step to unlock your full learning dashboard.")

@section('content')

<span class="sc-badge">✉️ Verify Email</span>
<h3>Verify Your Email</h3>
<p class="sc-auth-form-intro">
    Thanks for signing up! Before getting started, please verify your email address by
    clicking the link we just emailed you. Didn't get it? We'll gladly send another.
</p>

@if (session('status') == 'verification-link-sent')
    <div class="sc-alert sc-alert-success">A new verification link has been sent to the email address you provided during registration.</div>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" class="sc-btn sc-btn-primary" style="width:100%">Resend Verification Email</button>
</form>

<form method="POST" action="{{ route('logout') }}" style="margin-top:14px">
    @csrf
    <button type="submit" class="sc-btn sc-btn-ghost" style="width:100%">Log Out</button>
</form>

@endsection
