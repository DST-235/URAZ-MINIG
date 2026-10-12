@extends('layouts.admin')
@section('title',__('admin.title_contact')) @section('page-title',__('admin.title_contact'))
@section('content')

{{-- Stats strip --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-sm-3">
        <div class="stat-card text-center">
            <div style="font-size:1.75rem;font-weight:700;color:var(--primary-400);">{{ $messages->total() }}</div>
            <div style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;">Total</div>
        </div>
    </div>
    <div class="col-6 col-sm-3">
        <div class="stat-card text-center">
            <div style="font-size:1.75rem;font-weight:700;color:var(--warning);">{{ $unreadCount }}</div>
            <div style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.08em;">{{ __('admin.unread') }}</div>
        </div>
    </div>
</div>

{{-- Desktop table --}}
<div class="card d-none d-md-block">
    <div class="card-body p-0">
        @if($messages->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox" style="font-size:3rem;color:var(--text-muted);opacity:0.35;"></i>
                <p class="mt-3 mb-0" style="color:var(--text-muted);">No messages yet.</p>
            </div>
        @else
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:46px;"></th>
                    <th>{{ __('admin.col_from') }}</th>
                    <th>{{ __('admin.col_subject') }}</th>
                    <th style="width:130px;">{{ __('admin.col_date') }}</th>
                    <th style="width:95px;">{{ __('admin.col_status') }}</th>
                    <th style="width:60px;"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($messages as $m)
            <tr class="contact-row{{ !$m->is_read ? ' unread-row' : '' }}"
                onclick="window.location='{{ route('admin.contact.show',$m) }}'"
                style="cursor:pointer;">
                <td>
                    <div class="msg-avatar" style="background:{{ !$m->is_read ? 'var(--primary-500)' : 'var(--bg-tertiary)' }};">
                        {{ strtoupper(substr($m->name,0,1)) }}
                    </div>
                </td>
                <td>
                    <div style="font-weight:{{ !$m->is_read ? '700' : '500' }};color:var(--text-primary);font-size:0.875rem;">{{ $m->name }}</div>
                    <div style="font-size:0.75rem;color:var(--text-muted);">{{ $m->email }}</div>
                </td>
                <td>
                    <span style="font-weight:{{ !$m->is_read ? '600' : '400' }};color:var(--text-primary);font-size:0.875rem;">
                        {{ $m->subject ?: '(no subject)' }}
                    </span>
                    <span style="color:var(--text-muted);font-size:0.82rem;"> — {{ Str::limit($m->message, 65) }}</span>
                </td>
                <td style="font-size:0.78rem;color:var(--text-muted);white-space:nowrap;">
                    {{ $m->created_at->format('d M Y') }}<br>
                    <span style="font-size:0.72rem;">{{ $m->created_at->format('H:i') }}</span>
                </td>
                <td>
                    @if(!$m->is_read)
                        <span class="badge" style="background:rgba(245,158,11,0.15);color:var(--warning);font-size:0.7rem;padding:0.3em 0.6em;">{{ __('admin.unread') }}</span>
                    @else
                        <span class="badge" style="background:rgba(16,185,129,0.1);color:var(--success);font-size:0.7rem;padding:0.3em 0.6em;">{{ __('admin.read') }}</span>
                    @endif
                </td>
                <td onclick="event.stopPropagation();">
                    <form method="POST" action="{{ route('admin.contact.destroy',$m) }}"
                          onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm del-btn" title="{{ __('admin.delete') }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

{{-- Mobile card list --}}
<div class="d-md-none">
    @forelse($messages as $m)
    <div class="card mb-2 contact-card{{ !$m->is_read ? ' unread-card' : '' }}"
         onclick="window.location='{{ route('admin.contact.show',$m) }}'"
         style="cursor:pointer;">
        <div class="card-body py-3">
            <div class="d-flex align-items-center gap-3">
                <div class="msg-avatar flex-shrink-0"
                     style="background:{{ !$m->is_read ? 'var(--primary-500)' : 'var(--bg-tertiary)' }};">
                    {{ strtoupper(substr($m->name,0,1)) }}
                </div>
                <div style="flex:1;min-width:0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-weight:{{ !$m->is_read ? '700' : '500' }};color:var(--text-primary);font-size:0.875rem;">{{ $m->name }}</span>
                        <span style="font-size:0.72rem;color:var(--text-muted);white-space:nowrap;padding-left:0.5rem;">{{ $m->created_at->format('d M') }}</span>
                    </div>
                    <div style="font-size:0.75rem;color:var(--text-muted);">{{ $m->email }}</div>
                    <div style="font-size:0.8rem;color:var(--text-secondary);margin-top:0.2rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        <strong>{{ $m->subject ?: '(no subject)' }}</strong>
                        <span style="color:var(--text-muted);"> — {{ Str::limit($m->message,45) }}</span>
                    </div>
                </div>
            </div>
            @if(!$m->is_read)
            <div class="mt-2 ps-1">
                <span class="badge" style="background:rgba(245,158,11,0.15);color:var(--warning);font-size:0.68rem;">{{ __('admin.unread') }}</span>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="fas fa-inbox" style="font-size:3rem;color:var(--text-muted);opacity:0.35;"></i>
        <p class="mt-3 mb-0" style="color:var(--text-muted);">No messages yet.</p>
    </div>
    @endforelse
</div>

<div class="mt-3">{{ $messages->links() }}</div>

@push('styles')
<style>
.msg-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.875rem; color: #fff; flex-shrink: 0;
}
.contact-row td { vertical-align: middle; }
.contact-row:hover { background: var(--bg-secondary) !important; }
.unread-row { background: rgba(59,130,246,0.05) !important; }
.unread-card { border-left: 3px solid var(--primary-500) !important; }
.contact-card:hover { background: var(--bg-secondary) !important; }
.del-btn {
    background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
    color: var(--danger); padding: 0.3rem 0.55rem; font-size: 0.78rem;
}
.del-btn:hover { background: rgba(239,68,68,0.22); color: var(--danger); }
</style>
@endpush
@endsection
