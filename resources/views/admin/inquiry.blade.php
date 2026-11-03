@extends('layouts.admin')

@section('title', 'Inquiries')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Inquiry Management</h2>
        <p>{{ $inquiries->total() }} inquir{{ $inquiries->total() === 1 ? 'y' : 'ies' }} from the contact form</p>
    </div>
    <label class="sa-topbar-search" style="width:220px;">
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" id="saInquirySearch" placeholder="Search this page…">
    </label>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table" id="saInquiryTable">
                <thead>
                    <tr><th>Customer</th><th>Mobile</th><th>Email</th><th>Course</th><th>Message</th><th>Date</th><th>Status</th><th style="text-align:right">Action</th></tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                    <tr>
                        <td><strong>{{ $inquiry->name }}</strong></td>
                        <td>{{ $inquiry->mobile ?? '—' }}</td>
                        <td>{{ $inquiry->email }}</td>
                        <td>{{ $inquiry->course ?? '—' }}</td>
                        <td class="sa-table-sub">{{ \Illuminate\Support\Str::limit($inquiry->message, 30) }}</td>
                        <td>{{ $inquiry->created_at->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('inquiry.update', $inquiry) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PUT')
                                <select name="status" class="sa-select" style="width:auto;padding:7px 10px;font-size:.78rem;" onchange="this.form.submit()">
                                    <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ $inquiry->status === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $inquiry->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="sa-table-actions" style="justify-content:flex-end">
                                <button type="button" class="sa-icon-btn" title="View" onclick="saOpenModal('viewInquiry{{ $inquiry->id }}')">
                                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                                <form action="{{ route('inquiry.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Inquiry delete karein?');" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sa-icon-btn sa-danger" title="Delete">
                                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div id="viewInquiry{{ $inquiry->id }}" class="sa-modal" aria-hidden="true">
                        <div class="sa-modal-backdrop" onclick="saCloseModal('viewInquiry{{ $inquiry->id }}')"></div>
                        <div class="sa-modal-dialog sa-modal-sm">
                            <div class="sa-modal-head">
                                <h3>Inquiry from {{ $inquiry->name }}</h3>
                                <button type="button" class="sa-icon-btn" onclick="saCloseModal('viewInquiry{{ $inquiry->id }}')" aria-label="Close">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="sa-modal-body" style="font-size:.88rem; line-height:1.9;">
                                <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                                <p><strong>Mobile:</strong> {{ $inquiry->mobile ?? '—' }}</p>
                                <p><strong>Course:</strong> {{ $inquiry->course ?? '—' }}</p>
                                <p style="margin-bottom:6px"><strong>Message:</strong></p>
                                <p style="color:var(--sc-paragraph)">{{ $inquiry->message }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="8" class="sa-table-empty">Abhi tak koi inquiry nahi hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; padding:16px 20px; border-top:1px solid var(--sc-border);">
            <span style="font-size:.78rem;color:var(--sc-muted);">Showing {{ $inquiries->firstItem() ?? 0 }} to {{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() }} entries</span>
            {{ $inquiries->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    (function () {
        const search = document.getElementById('saInquirySearch');
        const rows = Array.from(document.querySelectorAll('#saInquiryTable tbody tr')).filter(r => !r.querySelector('.sa-table-empty'));
        search?.addEventListener('input', function () {
            const val = this.value.trim().toLowerCase();
            rows.forEach((r) => { r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none'; });
        });
    })();
</script>
@endpush
