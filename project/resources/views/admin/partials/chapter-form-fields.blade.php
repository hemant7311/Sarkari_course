@php $chapter = $chapter ?? null; @endphp

<div class="sa-form-group">
    <label class="sa-label">Title</label>
    <input type="text" name="title" class="sa-input" value="{{ old('title', $chapter->title ?? '') }}" required>
</div>

<div class="sa-form-group">
    <label class="sa-label">YouTube Video Link</label>
    <input type="text" name="video_url" class="sa-input" value="{{ old('video_url', $chapter->video_url ?? '') }}" placeholder="https://www.youtube.com/watch?v=...">
    <p class="sa-form-hint">Koi bhi normal YouTube link daalein — video hamari site par hi embed hokar play hoga, user YouTube par redirect nahi hoga.</p>
</div>

<div class="sa-form-grid">
    <div class="sa-form-group">
        <label class="sa-label">Duration <span class="sa-optional">(minutes)</span></label>
        <input type="number" name="duration_minutes" min="0" class="sa-input" value="{{ old('duration_minutes', $chapter->duration_minutes ?? '') }}">
    </div>
    <div class="sa-form-group" style="display:flex; align-items:center;">
        <input type="hidden" name="is_preview" value="0">
        <label class="sa-switch" style="margin-top:22px;margin-right:10px;">
            <input type="checkbox" name="is_preview" value="1" id="isPreview{{ $chapter->id ?? 'new' }}" {{ old('is_preview', $chapter->is_preview ?? false) ? 'checked' : '' }}>
            <span></span>
        </label>
        <label for="isPreview{{ $chapter->id ?? 'new' }}" class="sa-label" style="margin:22px 0 0;cursor:pointer;">Free Preview <span class="sa-optional">(bina enroll dekha ja sake)</span></label>
    </div>
</div>
