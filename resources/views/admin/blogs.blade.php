@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Blog Posts</h2>
        <p>Yahan se aap blog page ke liye articles publish kar sakte hain.</p>
    </div>
    <button type="button" class="sa-btn sa-btn-primary" onclick="saOpenModal('addBlogModal')">
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Blog Post
    </button>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead><tr><th>Thumbnail</th><th>Title</th><th>Category</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td>
                                @if($blog->thumbnail_url)
                                    <img src="{{ $blog->thumbnail_url }}" alt="" loading="lazy" style="width:56px;height:40px;object-fit:cover;border-radius:8px;">
                                @else
                                    <span class="sa-table-sub">No image</span>
                                @endif
                            </td>
                            <td><strong>{{ $blog->title }}</strong></td>
                            <td>{{ $blog->category ?? '—' }}</td>
                            <td><span class="sa-badge {{ $blog->status === 'Published' ? 'sa-badge-success' : 'sa-badge-muted' }}">{{ $blog->status }}</span></td>
                            <td>
                                <div class="sa-table-actions" style="justify-content:flex-end">
                                    <button type="button" class="sa-icon-btn" title="Edit post" onclick="saOpenModal('editBlogModal{{ $blog->id }}')">
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Blog post delete karein?');" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sa-icon-btn sa-danger" title="Delete post">
                                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div id="editBlogModal{{ $blog->id }}" class="sa-modal" aria-hidden="true">
                            <div class="sa-modal-backdrop" onclick="saCloseModal('editBlogModal{{ $blog->id }}')"></div>
                            <div class="sa-modal-dialog sa-modal-lg">
                                <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="sa-modal-head">
                                        <h3>Edit Blog Post</h3>
                                        <button type="button" class="sa-icon-btn" onclick="saCloseModal('editBlogModal{{ $blog->id }}')" aria-label="Close">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    <div class="sa-modal-body">
                                        @include('admin.partials.blog-form-fields', ['blog' => $blog])
                                    </div>
                                    <div class="sa-modal-foot">
                                        <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('editBlogModal{{ $blog->id }}')">Cancel</button>
                                        <button type="submit" class="sa-btn sa-btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="5" class="sa-table-empty">Abhi tak koi blog post nahi hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($blogs->hasPages())
            <div style="padding:16px 20px; border-top:1px solid var(--sc-border);">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</div>

<div id="addBlogModal" class="sa-modal" aria-hidden="true">
    <div class="sa-modal-backdrop" onclick="saCloseModal('addBlogModal')"></div>
    <div class="sa-modal-dialog sa-modal-lg">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sa-modal-head">
                <h3>Add Blog Post</h3>
                <button type="button" class="sa-icon-btn" onclick="saCloseModal('addBlogModal')" aria-label="Close">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="sa-modal-body">
                @include('admin.partials.blog-form-fields')
            </div>
            <div class="sa-modal-foot">
                <button type="button" class="sa-btn sa-btn-outline" onclick="saCloseModal('addBlogModal')">Cancel</button>
                <button type="submit" class="sa-btn sa-btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function () { saOpenModal('addBlogModal'); });
    @endif
</script>
@endpush
