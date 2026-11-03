@extends('layouts.auth')

@section('title', 'Login / Register - SarkariCourse')
@section('auth_heading', 'Your Path to Government Jobs Starts Here.')
@section('auth_subheading', "Join 50,000+ aspirants preparing smarter with India's most trusted free exam platform.")
@section('auth_bg_image', 'login-welcome-3d.webp')

@section('content')

@php
    $showRegister = $errors->has('first_name') || $errors->has('last_name') || $errors->has('phone') || old('first_name');
@endphp

<div class="sc-auth-tabs" role="tablist">
    <button type="button" class="sc-auth-tab {{ $showRegister ? '' : 'active' }}" id="scTabLogin" onclick="scSwitchAuthTab('login')" role="tab" aria-selected="{{ $showRegister ? 'false' : 'true' }}">Sign In</button>
    <button type="button" class="sc-auth-tab {{ $showRegister ? 'active' : '' }}" id="scTabRegister" onclick="scSwitchAuthTab('register')" role="tab" aria-selected="{{ $showRegister ? 'true' : 'false' }}">Create Account</button>
</div>

{{-- ══════════════════ LOGIN PANEL ══════════════════ --}}
<div id="scPanelLogin" class="sc-auth-tab-panel {{ $showRegister ? '' : 'active' }}">
    <h3>Welcome Back 👋</h3>
    <p>Sign in to continue your exam preparation journey.</p>

    @if(session('error'))
        <div class="sc-alert sc-alert-error">{{ session('error') }}</div>
    @endif

    <a href="{{ route('auth.google') }}" class="sc-social-btn">
        <svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Continue with Google
    </a>
    <button type="button" class="sc-social-btn" aria-disabled="true" title="Apple Sign-In coming soon">
        <svg viewBox="0 0 24 24" fill="#111827"><path d="M16.36 1.43c0 1.14-.46 2.2-1.2 2.98-.83.86-2.13 1.53-3.22 1.44-.13-1.09.41-2.24 1.16-2.98.83-.85 2.26-1.5 3.26-1.44zm3.9 16.99c-.5 1.15-.74 1.66-1.38 2.67-.9 1.42-2.16 3.19-3.73 3.2-1.39.02-1.75-.9-3.63-.89-1.88.01-2.28.91-3.67.89-1.57-.02-2.76-1.61-3.66-3.03-2.5-3.93-2.77-8.55-1.22-11.01.99-1.58 2.86-2.6 4.61-2.6 1.8 0 2.93.99 4.42.99 1.44 0 2.32-.99 4.4-.99 1.58 0 3.25.86 4.34 2.34-3.81 2.09-3.19 7.53-.48 9.43z"/></svg>
        Continue with Apple
    </button>

    <div class="sc-auth-divider"><span>or sign in with email</span></div>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="sc-af-group">
            <label class="sc-label" for="loginEmail">Email Address</label>
            <input type="email" id="loginEmail" class="sc-input" name="email" placeholder="arjun@example.com" value="{{ old('email') }}" required>
            @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
        </div>

        <div class="sc-af-group">
            <div class="sc-pw-row">
                <label class="sc-label" for="loginPassword">Password</label>
                <a href="{{ route('password.request') }}" class="sc-forgot-link">Forgot password?</a>
            </div>
            <div class="sc-pw-field">
                <input type="password" id="loginPassword" class="sc-input" name="password" placeholder="Enter your password" required>
                <button type="button" class="sc-pw-toggle" onclick="scTogglePassword('loginPassword', this)" aria-label="Show password">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            @error('password') <span class="sc-field-error">{{ $message }}</span> @enderror
        </div>

        <label class="sc-remember">
            <input type="checkbox" name="remember">
            <span>Remember me for 30 days</span>
        </label>

        <button type="submit" class="sc-btn sc-btn-primary" style="width:100%">Sign In →</button>
    </form>

    <div class="sc-auth-switch">Don't have an account? <a onclick="scSwitchAuthTab('register')">Create one free →</a></div>
</div>

{{-- ══════════════════ REGISTER PANEL ══════════════════ --}}
<div id="scPanelRegister" class="sc-auth-tab-panel {{ $showRegister ? 'active' : '' }}">
    <h3>Create Account 🚀</h3>
    <p>Start your free preparation journey with SarkariCourse.</p>

    <a href="{{ route('auth.google') }}" class="sc-social-btn">
        <svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Sign up with Google
    </a>
    <button type="button" class="sc-social-btn" aria-disabled="true" title="Apple Sign-In coming soon">
        <svg viewBox="0 0 24 24" fill="#111827"><path d="M16.36 1.43c0 1.14-.46 2.2-1.2 2.98-.83.86-2.13 1.53-3.22 1.44-.13-1.09.41-2.24 1.16-2.98.83-.85 2.26-1.5 3.26-1.44zm3.9 16.99c-.5 1.15-.74 1.66-1.38 2.67-.9 1.42-2.16 3.19-3.73 3.2-1.39.02-1.75-.9-3.63-.89-1.88.01-2.28.91-3.67.89-1.57-.02-2.76-1.61-3.66-3.03-2.5-3.93-2.77-8.55-1.22-11.01.99-1.58 2.86-2.6 4.61-2.6 1.8 0 2.93.99 4.42.99 1.44 0 2.32-.99 4.4-.99 1.58 0 3.25.86 4.34 2.34-3.81 2.09-3.19 7.53-.48 9.43z"/></svg>
        Sign up with Apple
    </button>

    <div class="sc-auth-divider"><span>or register with email</span></div>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="sc-af-row">
            <div class="sc-af-group">
                <label class="sc-label" for="regFirstName">First Name</label>
                <input type="text" id="regFirstName" class="sc-input" name="first_name" placeholder="Arjun" value="{{ old('first_name') }}" required>
                @error('first_name') <span class="sc-field-error">{{ $message }}</span> @enderror
            </div>
            <div class="sc-af-group">
                <label class="sc-label" for="regLastName">Last Name</label>
                <input type="text" id="regLastName" class="sc-input" name="last_name" placeholder="Singh" value="{{ old('last_name') }}" required>
                @error('last_name') <span class="sc-field-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="sc-af-group">
            <label class="sc-label" for="regPhone">Contact Number</label>
            <input type="tel" id="regPhone" class="sc-input" name="phone" placeholder="+91 98765 43210" value="{{ old('phone') }}" required>
            @error('phone') <span class="sc-field-error">{{ $message }}</span> @enderror
        </div>

        <div class="sc-af-group">
            <label class="sc-label" for="regEmail">Email Address</label>
            <input type="email" id="regEmail" class="sc-input" name="email" placeholder="arjun@example.com" value="{{ old('email') }}" required>
            @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
        </div>

        <div class="sc-af-row">
            <div class="sc-af-group">
                <label class="sc-label" for="regPassword">Password</label>
                <div class="sc-pw-field">
                    <input type="password" id="regPassword" class="sc-input" name="password" placeholder="Min 8 chars" required>
                    <button type="button" class="sc-pw-toggle" onclick="scTogglePassword('regPassword', this)" aria-label="Show password">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password') <span class="sc-field-error">{{ $message }}</span> @enderror
            </div>
            <div class="sc-af-group">
                <label class="sc-label" for="regPasswordConfirm">Confirm Password</label>
                <input type="password" id="regPasswordConfirm" class="sc-input" name="password_confirmation" placeholder="Repeat" required>
            </div>
        </div>

        <p class="sc-auth-terms">
            By creating an account you agree to our
            <a href="{{ route('terms') }}">Terms of Service</a> and
            <a href="{{ route('privacy') }}">Privacy Policy</a>.
        </p>

        <button type="submit" class="sc-btn sc-btn-primary" style="width:100%">Create Free Account →</button>
    </form>

    <div class="sc-auth-switch">Already have an account? <a onclick="scSwitchAuthTab('login')">Sign in →</a></div>
</div>

@push('scripts')
<script>
function scSwitchAuthTab(tab) {
    document.getElementById('scPanelLogin').classList.toggle('active', tab === 'login');
    document.getElementById('scPanelRegister').classList.toggle('active', tab === 'register');
    document.getElementById('scTabLogin').classList.toggle('active', tab === 'login');
    document.getElementById('scTabRegister').classList.toggle('active', tab === 'register');
    document.getElementById('scTabLogin').setAttribute('aria-selected', tab === 'login');
    document.getElementById('scTabRegister').setAttribute('aria-selected', tab === 'register');

    const hero = document.getElementById('scAuthHero3d');
    if (hero) {
        const img = tab === 'register' ? 'signup-journey-3d.webp' : 'login-welcome-3d.webp';
        hero.style.backgroundImage = `url('{{ asset('images/auth') }}/${img}')`;
    }
}
function scTogglePassword(id, btn) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.style.color = input.type === 'text' ? 'var(--sc-primary)' : '';
}
</script>
@endpush
@endsection
