@extends('layouts.admin')

@section('title', 'Courses')

@section('content')

@if ($errors->any())
    <div class="sa-alert" style="background:#FEF2F2;color:#991B1B;border:1px solid #FECACA;">
        <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="sa-page-head">
    <div>
        <h2>All Courses</h2>
        <p>{{ $courses->total() }} course{{ $courses->total() === 1 ? '' : 's' }} on the platform</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <label class="sa-topbar-search" style="width:200px;">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="text" id="saCourseSearch" placeholder="Search this page…">
        </label>
        <button type="button" class="sa-btn sa-btn-primary" onclick="resetCourseForm(); toggleCourseForm();">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Course
        </button>
    </div>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table" id="saCoursesTable">
                <thead>
                    <tr><th>Course Title</th><th>Teacher</th><th>Category</th><th>Level</th><th>Price</th><th>Status</th><th style="text-align:right">Action</th></tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td><strong>{{ $course->title }}</strong></td>
                            <td><span class="sa-table-sub">{{ $course->teacher_name }}</span></td>
                            <td>{{ $course->category }}</td>
                            <td>
                                @php
                                    $levelBadge = match(strtolower($course->level)) {
                                        'beginner' => 'sa-badge-success',
                                        'intermediate' => 'sa-badge-warning',
                                        default => 'sa-badge-danger',
                                    };
                                @endphp
                                <span class="sa-badge {{ $levelBadge }}">{{ $course->level }}</span>
                            </td>
                            <td>₹{{ number_format($course->price) }}</td>
                            <td>
                                <span class="sa-badge {{ $course->status === 'Active' ? 'sa-badge-success' : 'sa-badge-muted' }}">{{ $course->status }}</span>
                            </td>
                            <td>
                                <div class="sa-table-actions" style="justify-content:flex-end">
                                    <a href="{{ route('admin.chapters', $course) }}" class="sa-icon-btn" title="Manage Chapters">
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                                    </a>
                                    <button type="button" class="sa-icon-btn" title="Edit course" onclick='editCourse(@json($course))'>
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                                    </button>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sa-icon-btn sa-danger" title="Delete course">
                                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="sa-table-empty">No courses added yet. Click "Add Course" to create your first one.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($courses->hasPages())
            <div style="padding:16px 20px; border-top:1px solid var(--sc-border);">
                {{ $courses->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ══════════════════ ADD/EDIT COURSE MODAL ══════════════════ --}}
<div id="courseFormCard" class="sa-modal" aria-hidden="true">
    <div class="sa-modal-backdrop" onclick="toggleCourseForm()"></div>
    <div class="sa-modal-dialog sa-modal-lg">
        <div class="sa-modal-head">
            <h3 id="courseFormTitle">Add New Course</h3>
            <button type="button" class="sa-icon-btn" onclick="toggleCourseForm()" aria-label="Close">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form id="courseForm" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="courseFormMethod" value="POST">

            <div class="sa-modal-body">
                <div class="sa-form-grid">
                    <div class="sa-form-group sa-full">
                        <label class="sa-label">Course Title</label>
                        <input type="text" name="title" id="field-title" class="sa-input" placeholder="Enter course title">
                    </div>

                    <div class="sa-form-group">
                        <label class="sa-label">Teacher Name</label>
                        <input type="text" name="teacher_name" id="field-teacher_name" class="sa-input" placeholder="Enter teacher name">
                    </div>

                    <div class="sa-form-group">
                        <label class="sa-label">Category</label>
                        <select name="category" id="field-category" class="sa-select">
                            @forelse($categories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @empty
                                <option value="">Pehle ek category add karein</option>
                            @endforelse
                        </select>
                        <p class="sa-form-hint">Naya category chahiye to <a href="{{ route('admin.categories') }}" target="_blank" style="color:var(--sc-primary)">Categories page</a> se add karein.</p>
                    </div>

                    <div class="sa-form-group">
                        <label class="sa-label">Level</label>
                        <select name="level" id="field-level" class="sa-select">
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Advanced</option>
                        </select>
                    </div>

                    <div class="sa-form-group">
                        <label class="sa-label">Status</label>
                        <select name="status" id="field-status" class="sa-select">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                    <div class="sa-form-group">
                        <label class="sa-label">Price (₹)</label>
                        <input type="number" name="price" id="field-price" class="sa-input" placeholder="0">
                    </div>

                    <div class="sa-form-group sa-full">
                        <label class="sa-label">Thumbnail</label>
                        <label class="sa-upload" for="field-thumbnail">
                            <span class="sa-upload-icon">🖼️</span>
                            <span class="sa-upload-text">Click to upload thumbnail</span>
                            <span class="sa-upload-hint">Leave empty to keep the existing image when editing.</span>
                        </label>
                        <input type="file" name="thumbnail" id="field-thumbnail" class="sa-input" style="display:none">
                    </div>

                    <div class="sa-form-group sa-full">
                        <label class="sa-label">Description</label>
                        <textarea name="description" id="field-description" rows="4" class="sa-textarea" placeholder="Course description..."></textarea>
                    </div>
                </div>
            </div>

            <div class="sa-modal-foot">
                <button type="button" class="sa-btn sa-btn-outline" onclick="toggleCourseForm()">Cancel</button>
                <button type="submit" class="sa-btn sa-btn-primary">Save Course</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleCourseForm() {
    const modal = document.getElementById('courseFormCard');
    modal.classList.toggle('is-open');
    modal.setAttribute('aria-hidden', String(!modal.classList.contains('is-open')));
}

function resetCourseForm() {
    const form = document.getElementById('courseForm');
    form.reset();
    form.action = "{{ route('courses.store') }}";
    document.getElementById('courseFormMethod').value = 'POST';
    document.getElementById('courseFormTitle').innerText = 'Add New Course';
}

function editCourse(course) {
    const form = document.getElementById('courseForm');
    form.action = "{{ url('/admin/addcourses') }}/" + course.id;
    document.getElementById('courseFormMethod').value = 'PUT';
    document.getElementById('courseFormTitle').innerText = 'Edit Course';

    document.getElementById('field-title').value = course.title ?? '';
    document.getElementById('field-teacher_name').value = course.teacher_name ?? '';
    document.getElementById('field-category').value = course.category ?? '';
    document.getElementById('field-level').value = course.level ?? '';
    document.getElementById('field-status').value = course.status ?? 'Active';
    document.getElementById('field-price').value = course.price ?? 0;
    document.getElementById('field-description').value = course.description ?? '';

    document.getElementById('courseFormCard').classList.add('is-open');
    document.getElementById('courseFormCard').setAttribute('aria-hidden', 'false');
}

// Show chosen filename on the upload dropzone
document.getElementById('field-thumbnail')?.addEventListener('change', function () {
    const label = this.previousElementSibling.querySelector('.sa-upload-text');
    if (this.files[0]) label.textContent = this.files[0].name;
});

// Client-side search (this table only — no backend query param exists for it)
(function () {
    const search = document.getElementById('saCourseSearch');
    const rows = Array.from(document.querySelectorAll('#saCoursesTable tbody tr')).filter(r => !r.querySelector('.sa-table-empty'));
    search?.addEventListener('input', function () {
        const val = this.value.trim().toLowerCase();
        rows.forEach((r) => { r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none'; });
    });
})();
</script>
@endpush
