@extends('layouts.auth')

@section('title', 'Reset Password - SarkariCourse')
@section('auth_heading', 'Create a New Password')
@section('auth_subheading', "Choose a strong new password to keep your account secure.")

@section('content')

<span class="sc-badge">🔑 New Password</span>
<h3>Reset Password</h3>
<p class="sc-auth-form-intro">Enter your new password below to regain access to your account.</p>

<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="sc-af-group">
        <label class="sc-label" for="resetEmail">Email Address</label>
        <input id="resetEmail" type="email" class="sc-input" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
        @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
    </div>

    <div class="sc-af-group">
        <label class="sc-label" for="resetPassword">New Password</label>
        <div class="sc-pw-field">
            <input id="resetPassword" type="password" class="sc-input" name="password" required autocomplete="new-password" placeholder="Min 8 chars">
            <button type="button" class="sc-pw-toggle" onclick="scTogglePassword('resetPassword', this)" aria-label="Show password">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>
        @error('password') <span class="sc-field-error">{{ $message }}</span> @enderror
    </div>

    <div class="sc-af-group">
        <label class="sc-label" for="resetPasswordConfirm">Confirm New Password</label>
        <input id="resetPasswordConfirm" type="password" class="sc-input" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat">
        @error('password_confirmation') <span class="sc-field-error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="sc-btn sc-btn-primary" style="width:100%">Reset Password →</button>
</form>

@push('scripts')
<script>
function scTogglePassword(id, btn) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.style.color = input.type === 'text' ? 'var(--sc-primary)' : '';
}
</script>
@endpush
@endsection
