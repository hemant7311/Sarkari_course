@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Website Settings</h2>
        <p>Manage site-wide branding, contact details and social links.</p>
    </div>
</div>

@if(session('status'))
    <div class="sa-alert sa-alert-success">{{ session('status') }}</div>
@endif

<form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ══════════════════ BRANDING ══════════════════ --}}
    <div class="sa-card">
        <div class="sa-card-head"><h3>🏷️ Branding</h3></div>
        <div class="sa-card-body">
            <div class="sa-form-grid">
                <div class="sa-form-group">
                    <label class="sa-label">Site Name</label>
                    <input type="text" name="site_name" class="sa-input" value="{{ old('site_name', $setting->site_name) }}" placeholder="Enter Site Name">
                </div>
                <div class="sa-form-group">
                    <label class="sa-label">Site Logo</label>
                    @if($setting->logo)
                        <div style="margin-bottom:8px"><img src="{{ $setting->logo_url }}" alt="Current logo" style="height:36px;"></div>
                    @endif
                    <label class="sa-upload" for="field-logo" style="padding:14px;">
                        <span class="sa-upload-text">🖼️ Click to upload a new logo</span>
                    </label>
                    <input type="file" name="logo" id="field-logo" class="sa-input" style="display:none" onchange="this.previousElementSibling.querySelector('.sa-upload-text').textContent = '🖼️ ' + (this.files[0]?.name || 'Click to upload a new logo')">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════ CONTACT INFO ══════════════════ --}}
    <div class="sa-card">
        <div class="sa-card-head"><h3>📞 Contact Information</h3></div>
        <div class="sa-card-body">
            <div class="sa-form-grid">
                <div class="sa-form-group">
                    <label class="sa-label">Contact Email</label>
                    <input type="email" name="email" class="sa-input" value="{{ old('email', $setting->email) }}" placeholder="Enter Email">
                </div>
                <div class="sa-form-group">
                    <label class="sa-label">Phone Number</label>
                    <input type="text" name="phone" class="sa-input" value="{{ old('phone', $setting->phone) }}" placeholder="Enter Mobile Number">
                </div>
                <div class="sa-form-group sa-full">
                    <label class="sa-label">Address</label>
                    <textarea name="address" rows="3" class="sa-textarea">{{ old('address', $setting->address) }}</textarea>
                </div>
                <div class="sa-form-group sa-full" style="margin-bottom:0">
                    <label class="sa-label">Footer Text</label>
                    <textarea name="footer_text" rows="3" class="sa-textarea">{{ old('footer_text', $setting->footer_text) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════ SOCIAL LINKS ══════════════════ --}}
    <div class="sa-card">
        <div class="sa-card-head"><h3>🔗 Social Links</h3></div>
        <div class="sa-card-body">
            <div class="sa-form-grid" style="grid-template-columns:repeat(3,1fr)">
                <div class="sa-form-group" style="margin-bottom:0">
                    <label class="sa-label">Facebook URL</label>
                    <input type="text" name="facebook" value="{{ old('facebook', $setting->facebook) }}" class="sa-input" placeholder="https://facebook.com/…">
                </div>
                <div class="sa-form-group" style="margin-bottom:0">
                    <label class="sa-label">Instagram URL</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $setting->instagram) }}" class="sa-input" placeholder="https://instagram.com/…">
                </div>
                <div class="sa-form-group" style="margin-bottom:0">
                    <label class="sa-label">YouTube URL</label>
                    <input type="text" name="youtube" value="{{ old('youtube', $setting->youtube) }}" class="sa-input" placeholder="https://youtube.com/…">
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="sa-btn sa-btn-primary" style="padding:13px 32px;">Save Settings</button>
</form>

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        .sa-card .sa-form-grid[style] { grid-template-columns: 1fr !important; }
    }
</style>
@endpush
