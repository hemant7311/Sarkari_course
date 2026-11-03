@extends('layouts.user')

@section('title', 'Profile Settings')

@section('content')

<div class="sc-dash-banner">
    <div>
        <h1>Profile Settings</h1>
        <p>Manage your account preferences and personalize your experience.</p>
    </div>
    <span class="sc-dash-banner-icon"><img src="{{ asset('images/settings/settings-gear-3d.webp') }}" alt="Settings gear illustration"></span>
</div>

<div class="sc-profile-layout">

    <div>

        {{-- ── Profile Information ── --}}
        <div class="sc-dash-card sc-profile-card">
            <h2>Profile Information</h2>
            <p class="sc-dash-card-sub">Update your personal information and profile details.</p>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="sc-profile-avatar-row" style="margin-bottom:22px">
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }}" class="sc-profile-avatar">
                    @else
                        <span class="sc-profile-avatar sc-user-fallback" style="display:flex;align-items:center;justify-content:center;font-size:1.4rem;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                    <div>
                        <strong>{{ $user->name }}</strong>
                        <span class="sc-member-since">Member since {{ $user->created_at->format('M Y') }}</span>
                        <label class="sc-btn sc-btn-outline sc-btn-sm" style="cursor:pointer;margin-top:8px;display:inline-flex;">
                            📷 Change Photo
                            <input type="file" name="profile_image" accept="image/*" hidden>
                        </label>
                    </div>
                </div>
                @error('profile_image') <span class="sc-field-error">{{ $message }}</span> @enderror

                <div class="sc-form-row">
                    <div>
                        <label class="sc-label" for="profName">Full Name</label>
                        <input type="text" id="profName" name="name" class="sc-input" value="{{ old('name', $user->name) }}" required>
                        @error('name') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="sc-label" for="profPhone">Mobile Number</label>
                        <input type="text" id="profPhone" name="phone" class="sc-input" value="{{ old('phone', $user->phone) }}">
                        @error('phone') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div style="margin-bottom:16px; position:relative;">
                    <label class="sc-label" for="profEmail">Email Address</label>
                    <input type="email" id="profEmail" name="email" class="sc-input" value="{{ old('email', $user->email) }}" required>
                    @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                        @if($user->hasVerifiedEmail())
                            <p class="sc-verify-note" style="color:var(--sc-success)">✓ Email verified</p>
                        @else
                            <p class="sc-verify-note">
                                Your email address is not verified.
                                <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display:inline">
                                    @csrf
                                    <button class="sc-link-btn">Click here to resend verification link.</button>
                                </form>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="sc-verify-sent">A new verification link has been sent.</p>
                            @endif
                        @endif
                    @endif
                </div>

                <div class="sc-form-actions">
                    <button type="submit" class="sc-btn sc-btn-primary">Save Changes</button>
                    @if (session('status') === 'profile-updated')
                        <span class="sc-saved-flag"><span class="sc-saved-lottie" data-lottie="/lottie/success-check.json" data-lottie-loop="false"></span> Saved!</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- ── Security / Password ── --}}
        <div class="sc-dash-card sc-profile-card">
            <h2>Security</h2>
            <p class="sc-dash-card-sub">Update your password to keep your account secure.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div style="margin-bottom:16px">
                    <label class="sc-label" for="currentPassword">Current Password</label>
                    <input type="password" id="currentPassword" name="current_password" class="sc-input">
                    @error('current_password', 'updatePassword') <span class="sc-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="sc-form-row">
                    <div>
                        <label class="sc-label" for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="password" class="sc-input">
                        @error('password', 'updatePassword') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="sc-label" for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" name="password_confirmation" class="sc-input">
                    </div>
                </div>

                <div class="sc-form-actions">
                    <button type="submit" class="sc-btn sc-btn-primary">Update Password</button>
                    @if (session('status') === 'password-updated')
                        <span class="sc-saved-flag"><span class="sc-saved-lottie" data-lottie="/lottie/success-check.json" data-lottie-loop="false"></span> Saved!</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="sc-profile-sidebar">

        {{-- ── Achievements (UI ready — no backend data source yet) ── --}}
        <div class="sc-dash-card sc-profile-card">
            <h2>Achievements</h2>
            <p class="sc-dash-card-sub">Certificates and milestones will appear here as you complete courses.</p>
            <div class="sc-achievement-grid">
                <div class="sc-achievement-item"><span>📚</span><strong>{{ $user->courses()->count() }}</strong><small>Enrolled</small></div>
                <div class="sc-achievement-item"><span>🏆</span><strong>0</strong><small>Certificates</small></div>
            </div>
            <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline sc-btn-sm" style="width:100%;margin-top:16px;justify-content:center;">Browse Courses</a>
        </div>

        {{-- ── Danger zone ── --}}
        <div class="sc-dash-card sc-profile-card sc-danger-card">
            <h2>Delete Account</h2>
            <p class="sc-dash-card-sub">Once your account is deleted, all data will be permanently removed. Please enter your password before deleting.</p>
            <a href="javascript:void(0)" class="sc-btn sc-btn-outline sc-btn-danger" style="width:100%;justify-content:center;" onclick="document.getElementById('scDeleteModal').classList.add('is-open')">Delete Account</a>
        </div>
    </div>
</div>

{{-- ── Delete confirmation modal ── --}}
<div id="scDeleteModal" class="sc-video-modal" aria-hidden="true">
    <div class="sc-video-modal-backdrop" onclick="document.getElementById('scDeleteModal').classList.remove('is-open')"></div>
    <div class="sc-modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <h3>Delete Account?</h3>
            <p>This action cannot be undone. Please confirm your password.</p>
            <label class="sc-label" for="deletePassword">Password</label>
            <input type="password" id="deletePassword" name="password" class="sc-input" placeholder="Enter your password">
            @error('password', 'userDeletion') <span class="sc-field-error">{{ $message }}</span> @enderror
            <div class="sc-modal-actions">
                <button type="button" class="sc-btn sc-btn-outline" onclick="document.getElementById('scDeleteModal').classList.remove('is-open')">Cancel</button>
                <button type="submit" class="sc-btn-danger" style="border-radius:var(--r-md); padding:12px 22px; font-weight:600; cursor:pointer;">Delete Account</button>
            </div>
        </form>
    </div>
</div>

@endsection
