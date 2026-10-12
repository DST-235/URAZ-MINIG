@extends('layouts.admin')
@section('title',__('admin.title_users'))
@section('page-title',__('admin.title_users'))

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="mb-0">{{ __('admin.title_users') }}</h4>
        <p class="mb-0 mt-1" style="color:var(--text-muted);font-size:0.82rem;">{{ $users->total() }} {{ __('admin.users_total') }}</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> {{ __('admin.form_new_user') }}
    </a>
</div>

<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="{{ __('admin.search') }}…" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select form-select-sm">
                    <option value="">{{ __('admin.users_all_roles') }}</option>
                    <option value="admin"  {{ request('role')=='admin'  ? 'selected':'' }}>{{ __('admin.users_role_admin') }}</option>
                    <option value="member" {{ request('role')=='member' ? 'selected':'' }}>{{ __('admin.users_role_member') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm w-100"><i class="fas fa-search me-1"></i>{{ __('admin.search') }}</button>
            </div>
            @if(request('search') || request('role'))
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm w-100">{{ __('admin.clear') }}</a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="padding:0.9rem 1.25rem;">{{ __('admin.col_user') }}</th>
                        <th>{{ __('admin.col_role') }}</th>
                        <th>{{ __('admin.col_position') }}</th>
                        <th>{{ __('admin.col_status') }}</th>
                        <th>{{ __('admin.col_joined') }}</th>
                        <th style="text-align:right;padding-right:1.25rem;">{{ __('admin.col_actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td style="padding:0.75rem 1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="{{ $user->name }}"
                                         style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid var(--dark-600);">
                                @else
                                    <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--primary-600),var(--primary-800));display:flex;align-items:center;justify-content:center;font-size:1rem;font-weight:700;color:#fff;flex-shrink:0;">
                                        {{ strtoupper(substr($user->name,0,1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight:500;color:var(--text-primary);font-size:0.875rem;">{{ $user->name }}</div>
                                    <div style="color:var(--text-muted);font-size:0.78rem;">{{ $user->email }}</div>
                                    @if($user->phone)
                                    <div dir="ltr" style="color:var(--text-disabled);font-size:0.75rem;"><i class="fas fa-phone me-1" style="font-size:0.65rem;"></i>{{ $user->phone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">{{ $user->role === 'admin' ? __('admin.users_role_admin') : __('admin.users_role_member') }}</span>
                        </td>
                        <td style="color:var(--text-muted);font-size:0.82rem;">{{ $user->position ?: '—' }}</td>
                        <td>
                            <div class="form-check form-switch mb-0" style="padding-left:2.5em;">
                                <input class="form-check-input status-toggle" type="checkbox"
                                    data-id="{{ $user->id }}"
                                    {{ $user->is_active ? 'checked' : '' }}
                                    {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                    style="cursor:{{ $user->id === auth()->id() ? 'not-allowed' : 'pointer' }};">
                            </div>
                        </td>
                        <td style="color:var(--text-muted);font-size:0.82rem;">{{ $user->created_at->format('d M Y') }}</td>
                        <td style="text-align:right;padding-right:1.25rem;">
                            <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-sm btn-outline-secondary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy',$user) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color:var(--text-muted);">
                            <i class="fas fa-users fa-2x mb-2 d-block"></i>{{ __('admin.users_not_found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-4 py-3 border-top" style="border-color:var(--dark-700)!important;">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.status-toggle').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const id = this.dataset.id;
        const el = this;
        fetch(`/admin/users/${id}/toggle-active`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.error) { el.checked = !el.checked; alert(data.error); }
        })
        .catch(() => { el.checked = !el.checked; });
    });
});
</script>
@endpush
