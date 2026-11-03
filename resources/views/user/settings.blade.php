@extends('layouts.user')

@section('title', 'Settings')

@section('content')

<div class="sc-dash-banner reveal-up">
    <div>
        <h1>Settings</h1>
        <p>Manage your account preferences and personalize your experience.</p>
    </div>
    <span class="sc-dash-banner-icon"><img src="{{ asset('images/settings/settings-gear-3d.webp') }}" alt="Settings gear illustration"></span>
</div>

<div class="sc-settings-layout">

    {{-- ── Side nav ── --}}
    <nav class="sc-settings-nav">
        <a href="#account" class="active">👤 Profile Settings</a>
        <a href="#security">🔒 Security</a>
        <a href="#notifications">🔔 Notification Settings</a>
        <a href="#appearance">🎨 Appearance</a>
        <a href="#privacy">🕶️ Privacy</a>
        <a href="#language">🌐 Language</a>
        <a href="#danger" class="sc-settings-nav-danger">🗑️ Delete Account</a>
    </nav>

    <div class="sc-settings-content">

        {{-- ── Profile (functional — same fields/route as Profile page) ── --}}
        <div class="sc-dash-card sc-profile-card" id="account">
            <h2>Profile Settings</h2>
            <p class="sc-dash-card-sub">Update your personal information and profile details.</p>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="sc-form-row">
                    <div>
                        <label class="sc-label" for="setName">Full Name</label>
                        <input type="text" id="setName" name="name" class="sc-input" value="{{ old('name', $user->name) }}" required>
                        @error('name') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="sc-label" for="setPhone">Mobile Number</label>
                        <input type="text" id="setPhone" name="phone" class="sc-input" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>
                <div style="margin-bottom:16px">
                    <label class="sc-label" for="setEmail">Email Address</label>
                    <input type="email" id="setEmail" name="email" class="sc-input" value="{{ old('email', $user->email) }}" required>
                    @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
                </div>
                <div class="sc-form-actions">
                    <button type="submit" class="sc-btn sc-btn-primary">Save Changes</button>
                    @if (session('status') === 'profile-updated') <span class="sc-saved-flag"><span class="sc-saved-lottie" data-lottie="/lottie/success-check.json" data-lottie-loop="false"></span> Saved!</span> @endif
                </div>
            </form>
        </div>

        {{-- ── Security (functional) ── --}}
        <div class="sc-dash-card sc-profile-card" id="security">
            <h2>Security</h2>
            <p class="sc-dash-card-sub">Password and security settings.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="sc-form-row">
                    <div>
                        <label class="sc-label" for="setCurPw">Current Password</label>
                        <input type="password" id="setCurPw" name="current_password" class="sc-input">
                        @error('current_password', 'updatePassword') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="sc-label" for="setNewPw">New Password</label>
                        <input type="password" id="setNewPw" name="password" class="sc-input">
                        @error('password', 'updatePassword') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div style="max-width:calc(50% - 8px)">
                    <label class="sc-label" for="setConfirmPw">Confirm New Password</label>
                    <input type="password" id="setConfirmPw" name="password_confirmation" class="sc-input">
                </div>
                <div class="sc-form-actions" style="margin-top:16px">
                    <button type="submit" class="sc-btn sc-btn-primary">Update Password</button>
                    @if (session('status') === 'password-updated') <span class="sc-saved-flag"><span class="sc-saved-lottie" data-lottie="/lottie/success-check.json" data-lottie-loop="false"></span> Saved!</span> @endif
                </div>
            </form>

            <div class="sc-settings-divider"></div>
            <div class="sc-settings-toggle-row">
                <div><strong>Two-Factor Authentication</strong><span>Add an extra layer of security to your account.</span></div>
                <label class="sc-switch"><input type="checkbox" disabled><span></span></label>
            </div>
        </div>

        {{-- ── Notification prefs (UI ready) ── --}}
        <div class="sc-dash-card sc-profile-card" id="notifications">
            <h2>Notification Settings</h2>
            <p class="sc-dash-card-sub">Choose what you want to be notified about.</p>
            @foreach(['New course launches', 'Live class reminders', 'Mock test alerts', 'Weekly current affairs digest'] as $i => $label)
                <div class="sc-settings-toggle-row">
                    <div><strong>{{ $label }}</strong></div>
                    <label class="sc-switch"><input type="checkbox" checked disabled><span></span></label>
                </div>
            @endforeach
        </div>

        {{-- ── Appearance (UI ready) ── --}}
        <div class="sc-dash-card sc-profile-card" id="appearance">
            <h2>Appearance</h2>
            <p class="sc-dash-card-sub">Customize how SarkariCourse looks for you.</p>
            <div class="sc-theme-options">
                <button type="button" class="sc-theme-chip active">☀️ Light</button>
                <button type="button" class="sc-theme-chip" disabled title="Coming soon">🌙 Dark</button>
                <button type="button" class="sc-theme-chip" disabled title="Coming soon">🖥️ System</button>
            </div>
        </div>

        {{-- ── Privacy (UI ready) ── --}}
        <div class="sc-dash-card sc-profile-card" id="privacy">
            <h2>Privacy</h2>
            <p class="sc-dash-card-sub">Control your data and visibility.</p>
            <div class="sc-settings-toggle-row">
                <div><strong>Show profile to other students</strong></div>
                <label class="sc-switch"><input type="checkbox" checked disabled><span></span></label>
            </div>
            <div class="sc-settings-toggle-row">
                <div><strong>Allow performance analytics</strong></div>
                <label class="sc-switch"><input type="checkbox" checked disabled><span></span></label>
            </div>
        </div>

        {{-- ── Language (UI ready) ── --}}
        <div class="sc-dash-card sc-profile-card" id="language">
            <h2>Language</h2>
            <p class="sc-dash-card-sub">Choose your preferred content language.</p>
            <select class="sc-select" disabled style="max-width:280px">
                <option>English</option>
                <option>Hindi</option>
            </select>
        </div>

        {{-- ── Danger zone ── --}}
        <div class="sc-dash-card sc-profile-card sc-danger-card" id="danger">
            <h2>Delete Account</h2>
            <p class="sc-dash-card-sub">Once your account is deleted, all data will be permanently removed.</p>
            <a href="{{ route('profile.edit') }}#danger" class="sc-btn sc-btn-outline sc-btn-danger">Manage in Profile Settings</a>
        </div>
    </div>
</div>

@endsection
