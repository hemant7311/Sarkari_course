@php $blog = $blog ?? null; @endphp

<div class="sa-form-group">
    <label class="sa-label">Title</label>
    <input type="text" name="title" class="sa-input" value="{{ old('title', $blog->title ?? '') }}" required>
</div>

<div class="sa-form-grid">
    <div class="sa-form-group">
        <label class="sa-label">Category</label>
        <input type="text" name="category" class="sa-input" value="{{ old('category', $blog->category ?? '') }}" placeholder="e.g. Exam Strategy">
    </div>
    <div class="sa-form-group">
        <label class="sa-label">Status</label>
        <select name="status" class="sa-select">
            <option value="Draft" {{ (old('status', $blog->status ?? '') === 'Draft') ? 'selected' : '' }}>Draft</option>
            <option value="Published" {{ (old('status', $blog->status ?? '') === 'Published') ? 'selected' : '' }}>Published</option>
        </select>
    </div>
</div>

<div class="sa-form-group">
    <label class="sa-label">Thumbnail</label>
    <label class="sa-upload" for="field-blog-thumbnail-{{ $blog->id ?? 'new' }}">
        <span class="sa-upload-icon">🖼️</span>
        <span class="sa-upload-text">Click to upload thumbnail</span>
        <span class="sa-upload-hint">Edit karte waqt khali chhodein agar image change nahi karni.</span>
    </label>
    <input type="file" name="thumbnail" id="field-blog-thumbnail-{{ $blog->id ?? 'new' }}" class="sa-input" accept="image/*" style="display:none" onchange="this.previousElementSibling.querySelector('.sa-upload-text').textContent = this.files[0]?.name || 'Click to upload thumbnail'">
</div>

<div class="sa-form-group">
    <label class="sa-label">Excerpt <span class="sa-optional">(short summary)</span></label>
    <textarea name="excerpt" class="sa-textarea" rows="2">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
</div>

<div class="sa-form-group">
    <label class="sa-label">Content</label>
    <textarea name="content" class="sa-textarea" rows="6" required>{{ old('content', $blog->content ?? '') }}</textarea>
</div>

<div style="height:1px;background:var(--sc-border);margin:20px 0;"></div>
<p style="font-size:.78rem;color:var(--sc-muted);margin-bottom:14px;">SEO (on-page)</p>

<div class="sa-form-group">
    <label class="sa-label">Meta Title</label>
    <input type="text" name="meta_title" class="sa-input" value="{{ old('meta_title', $blog->meta_title ?? '') }}">
</div>

<div class="sa-form-group" style="margin-bottom:0">
    <label class="sa-label">Meta Description</label>
    <textarea name="meta_description" class="sa-textarea" rows="2">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
</div>
