@extends('layouts.admin')

@section('title', 'Chapters - '.$course->title)

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Chapters — {{ $course->title }}</h2>
        <p>Is course ke liye video chapters manage karein. "Free Preview" wale chapters bina enroll kiye bhi dekhe ja sakte hain. Video hamesha hamari site par hi play hoga, YouTube par nahi.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="{{ route('addcourses') }}" class="sa-btn sa-btn-outline">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Courses
        </a>
        <button type="button" class="sa-btn sa-btn-primary" onclick="saOpenModal('addChapterModal')">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Chapter
        </button>
    </div>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead><tr><th>#</th><th>Title</th><th>Duration</th><th>Preview</th><th style="text-align:right">Actions</th></tr></thead>
                <tbody>
                    @forelse($chapters as $index => $chapter)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $chapter->title }}</strong></td>
                            <td>{{ $chapter->duration_minutes ? $chapter->duration_minutes.' min' : '—' }}</td>
                            <td>
                                @if($chapter->is_preview)
                                    <span class="sa-badge sa-badge-success">Free Preview</span>
                                @else
                                    <span class="sa-badge sa-badge-muted">Enrolled Only</span>
                                @endif
                            </td>
                            <td>
                                <div class="sa-table-actions" style="justify-content:flex-end">
                                    <button type="button" class="sa-icon-btn" title="Edit chapter" onclick="saOpenModal('editChapterModal{{ $chapter->id }}')">
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.chapters.destroy', [$course, $chapter]) }}" method="POST" onsubmit="return confirm('Chapter delete karein?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sa-icon-btn sa-danger" title="Delete chapter">
                                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div id="editChapterModal{{ $chapter->id }}" class="sa-modal" aria-hidden="true">
                            <div class="sa-modal-backdrop" onclick="saCloseModal('editChapterModal{{ $chapter->id }}')"></div>
                            <div class="sa-modal-dialog">
                                <form action="{{ route('admin.chapters.update', [$course, $chapter]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="sa-modal-head">
                                        <h3>Edit Chapter</h3>
                                        <button type="button" class="sa-icon-btn" onclick="saCloseModal('editChapterModal{{ $chapter->id }}')" aria-label="Close">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    <div class="sa-modal-body">
                                        @include('admin.partials.chapter-form-fields', ['chapter' => $chapter])
                                    </div>
                                    <div class="sa-modal-foot">
                                        <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('editChapterModal{{ $chapter->id }}')">Cancel</button>
                                        <button type="submit" class="sa-btn sa-btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="5" class="sa-table-empty">Abhi tak koi chapter nahi hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="addChapterModal" class="sa-modal" aria-hidden="true">
    <div class="sa-modal-backdrop" onclick="saCloseModal('addChapterModal')"></div>
    <div class="sa-modal-dialog">
        <form action="{{ route('admin.chapters.store', $course) }}" method="POST">
            @csrf
            <div class="sa-modal-head">
                <h3>Add Chapter</h3>
                <button type="button" class="sa-icon-btn" onclick="saCloseModal('addChapterModal')" aria-label="Close">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="sa-modal-body">
                @include('admin.partials.chapter-form-fields')
            </div>
            <div class="sa-modal-foot">
                <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('addChapterModal')">Cancel</button>
                <button type="submit" class="sa-btn sa-btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function () { saOpenModal('addChapterModal'); });
    @endif
</script>
@endpush
