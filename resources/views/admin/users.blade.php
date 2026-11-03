@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>All Users</h2>
        <p>{{ $users->total() }} registered student{{ $users->total() === 1 ? '' : 's' }}</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <label class="sa-topbar-search" style="width:220px;">
            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="text" id="saUserSearch" placeholder="Search this page…">
        </label>
        <select class="sa-select" id="saUserSort" style="width:auto;">
            <option value="default">Sort: Newest</option>
            <option value="name-asc">Name A–Z</option>
            <option value="name-desc">Name Z–A</option>
        </select>
    </div>
</div>

<div class="sa-card">
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table" id="saUsersTable">
                <thead>
                    <tr>
                        <th>Name</th><th>Email</th><th>Phone</th><th>Joined</th><th>Status</th><th style="text-align:right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>
                            <div class="sa-table-name-cell">
                                <span class="sa-table-avatar">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                <strong>{{ $u->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone ?? '—' }}</td>
                        <td data-sort-date="{{ $u->created_at->timestamp }}">{{ $u->created_at->format('d M, Y') }}</td>
                        <td>
                            @if($u->email_verified_at)
                                <span class="sa-badge sa-badge-success">Verified</span>
                            @else
                                <span class="sa-badge sa-badge-warning">Unverified</span>
                            @endif
                        </td>
                        <td style="text-align:right">
                            <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Delete this user? This cannot be undone.');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sa-icon-btn sa-danger" aria-label="Delete {{ $u->name }}" title="Delete user">
                                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="sa-table-empty">Abhi tak koi user register nahi hua hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div style="padding:16px 20px; border-top:1px solid var(--sc-border);">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    (function () {
        var search = document.getElementById('saUserSearch');
        var sort = document.getElementById('saUserSort');
        var tbody = document.querySelector('#saUsersTable tbody');
        if (!tbody) return;
        var rows = Array.from(tbody.querySelectorAll('tr')).filter(r => !r.querySelector('.sa-table-empty'));

        search?.addEventListener('input', function () {
            var val = this.value.trim().toLowerCase();
            rows.forEach(function (r) { r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none'; });
        });

        sort?.addEventListener('change', function () {
            var sorted = rows.slice();
            if (this.value === 'name-asc') sorted.sort((a, b) => a.querySelector('strong').textContent.localeCompare(b.querySelector('strong').textContent));
            else if (this.value === 'name-desc') sorted.sort((a, b) => b.querySelector('strong').textContent.localeCompare(a.querySelector('strong').textContent));
            else sorted.sort((a, b) => b.querySelector('[data-sort-date]').dataset.sortDate - a.querySelector('[data-sort-date]').dataset.sortDate);
            sorted.forEach(function (r) { tbody.appendChild(r); });
        });
    })();
</script>
@endpush
