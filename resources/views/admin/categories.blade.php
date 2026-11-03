@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Categories</h2>
        <p>Yeh categories home page, courses filter aur course form har jagah use hoti hain.</p>
    </div>
    <button type="button" class="sa-btn sa-btn-primary" onclick="saOpenModal('addCategoryModal')">
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Category
    </button>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead><tr><th>Name</th><th>Slug</th><th>Active Courses</th><th style="text-align:right">Actions</th></tr></thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><strong>{{ $category->icon }} {{ $category->name }}</strong></td>
                            <td class="sa-table-sub">{{ $category->slug }}</td>
                            <td><span class="sa-badge sa-badge-primary">{{ $category->courses_count }}</span></td>
                            <td>
                                <div class="sa-table-actions" style="justify-content:flex-end">
                                    <button type="button" class="sa-icon-btn" title="Edit category" onclick="saOpenModal('editCategoryModal{{ $category->id }}')">
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Category delete karein?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sa-icon-btn sa-danger" title="Delete category">
                                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit modal for this category --}}
                        <div id="editCategoryModal{{ $category->id }}" class="sa-modal" aria-hidden="true">
                            <div class="sa-modal-backdrop" onclick="saCloseModal('editCategoryModal{{ $category->id }}')"></div>
                            <div class="sa-modal-dialog sa-modal-sm">
                                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="sa-modal-head">
                                        <h3>Edit Category</h3>
                                        <button type="button" class="sa-icon-btn" onclick="saCloseModal('editCategoryModal{{ $category->id }}')" aria-label="Close">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    <div class="sa-modal-body">
                                        <div class="sa-form-group">
                                            <label class="sa-label">Name</label>
                                            <input type="text" name="name" class="sa-input" value="{{ $category->name }}" required>
                                        </div>
                                        <div class="sa-form-group" style="margin-bottom:0">
                                            <label class="sa-label">Icon <span class="sa-optional">(emoji, optional)</span></label>
                                            <input type="text" name="icon" class="sa-input" value="{{ $category->icon }}" placeholder="🎓">
                                        </div>
                                    </div>
                                    <div class="sa-modal-foot">
                                        <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('editCategoryModal{{ $category->id }}')">Cancel</button>
                                        <button type="submit" class="sa-btn sa-btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="4" class="sa-table-empty">Abhi tak koi category nahi hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Category modal --}}
<div id="addCategoryModal" class="sa-modal" aria-hidden="true">
    <div class="sa-modal-backdrop" onclick="saCloseModal('addCategoryModal')"></div>
    <div class="sa-modal-dialog sa-modal-sm">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="sa-modal-head">
                <h3>Add Category</h3>
                <button type="button" class="sa-icon-btn" onclick="saCloseModal('addCategoryModal')" aria-label="Close">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="sa-modal-body">
                <div class="sa-form-group">
                    <label class="sa-label">Name</label>
                    <input type="text" name="name" class="sa-input @error('name') is-invalid @enderror" placeholder="e.g. SSC" required>
                    @error('name') <span class="sa-field-error">{{ $message }}</span> @enderror
                </div>
                <div class="sa-form-group" style="margin-bottom:0">
                    <label class="sa-label">Icon <span class="sa-optional">(emoji, optional)</span></label>
                    <input type="text" name="icon" class="sa-input" placeholder="🎓">
                </div>
            </div>
            <div class="sa-modal-foot">
                <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('addCategoryModal')">Cancel</button>
                <button type="submit" class="sa-btn sa-btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // If validation failed on submit, re-open the Add Category modal so errors are visible
    @if ($errors->any() && !$errors->has('icon'))
        document.addEventListener('DOMContentLoaded', function () { saOpenModal('addCategoryModal'); });
    @endif
</script>
@endpush
