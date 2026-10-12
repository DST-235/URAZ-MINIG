@extends('layouts.admin')
@section('title',__('admin.title_contact')) @section('page-title',__('admin.title_contact'))
@section('content')

<div class="mb-3">
    <a href="{{ route('admin.contact.index') }}" class="btn btn-sm"
       style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-muted);">
        <i class="fas fa-arrow-left me-1"></i>{{ __('admin.back_to_list') }}
    </a>
</div>

<div class="row g-4">

    {{-- Contact info sidebar --}}
    <div class="col-12 col-lg-4 order-2 order-lg-1">
        <div class="card">
            <div class="card-body text-center pt-4 pb-3">
                <div class="msg-avatar-lg mx-auto mb-3">{{ strtoupper(substr($contact->name,0,1)) }}</div>
                <h5 style="color:var(--text-primary);margin:0;font-size:1rem;">{{ $contact->name }}</h5>
                <p style="color:var(--text-muted);font-size:0.82rem;margin:0.2rem 0 0;">{{ $contact->email }}</p>
            </div>

            <div class="card-body pt-0">
                <div class="info-list">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <div class="info-label">{{ __('admin.field_email') }}</div>
                            <div class="info-val" style="word-break:break-all;">{{ $contact->email }}</div>
                        </div>
                    </div>
                    @if($contact->phone)
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <div class="info-label">{{ __('admin.field_phone') }}</div>
                            <div class="info-val" dir="ltr">{{ $contact->phone }}</div>
                        </div>
                    </div>
                    @endif
                    @if($contact->company)
                    <div class="info-item">
                        <i class="fas fa-building"></i>
                        <div>
                            <div class="info-label">{{ __('admin.field_company') }}</div>
                            <div class="info-val">{{ $contact->company }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <div class="info-label">{{ __('admin.msg_received') }}</div>
                            <div class="info-val">{{ $contact->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                    <div class="info-item" style="border-bottom:none;">
                        <i class="fas fa-circle-dot" style="color:{{ $contact->is_read ? 'var(--success)' : 'var(--warning)' }};"></i>
                        <div>
                            <div class="info-label">{{ __('admin.col_status') }}</div>
                            <div class="info-val">
                                @if($contact->is_read)
                                    <span style="color:var(--success);">{{ __('admin.read') }}</span>
                                @else
                                    <span style="color:var(--warning);">{{ __('admin.unread') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-top d-flex flex-column gap-2"
                 style="border-color:var(--dark-700)!important;">
                <a href="mailto:{{ $contact->email }}?subject=Re:%20{{ rawurlencode($contact->subject ?? '') }}"
                   class="btn btn-primary w-100">
                    <i class="fas fa-reply me-2"></i>{{ __('admin.reply') }}
                </a>
                <form method="POST" action="{{ route('admin.contact.destroy',$contact) }}"
                      onsubmit="return confirm('{{ __('admin.delete_confirm') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash-alt me-2"></i>{{ __('admin.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Message content --}}
    <div class="col-12 col-lg-8 order-1 order-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-start justify-content-between gap-2 flex-wrap">
                    <div style="flex:1;min-width:0;">
                        <h5 style="color:var(--text-primary);margin:0;font-size:1.05rem;word-break:break-word;">
                            {{ $contact->subject ?: '(no subject)' }}
                        </h5>
                        <div style="font-size:0.8rem;color:var(--text-muted);margin-top:0.3rem;">
                            {{ __('admin.msg_from') }}
                            <strong style="color:var(--text-secondary);">{{ $contact->name }}</strong>
                            &lt;{{ $contact->email }}&gt;
                        </div>
                    </div>
                    <span class="badge flex-shrink-0"
                          style="background:{{ $contact->is_read ? 'rgba(16,185,129,0.12)':'rgba(245,158,11,0.15)' }};
                                 color:{{ $contact->is_read ? 'var(--success)':'var(--warning)' }};
                                 font-size:0.72rem;padding:0.35em 0.7em;align-self:flex-start;margin-top:0.1rem;">
                        {{ $contact->is_read ? __('admin.read') : __('admin.unread') }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="message-body">{{ $contact->message }}</div>
            </div>
            @if($contact->read_at)
            <div class="card-footer" style="font-size:0.75rem;color:var(--text-muted);">
                <i class="fas fa-eye me-1"></i> Read at {{ $contact->read_at->format('d M Y, H:i') }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.msg-avatar-lg {
    width: 60px; height: 60px; border-radius: 50%;
    background: var(--primary-500);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; font-weight: 700; color: #fff;
}
.info-list { border-top: 1px solid var(--dark-700); }
.info-item {
    display: flex; align-items: flex-start; gap: 0.75rem;
    padding: 0.65rem 0; border-bottom: 1px solid var(--dark-700);
}
.info-item i { margin-top: 0.15rem; font-size: 0.8rem; color: var(--text-muted); width: 14px; flex-shrink: 0; }
.info-label { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.06em; }
.info-val { font-size: 0.85rem; color: var(--text-primary); margin-top: 0.1rem; }
.message-body {
    color: var(--text-primary); line-height: 1.85; white-space: pre-wrap;
    font-size: 0.9rem; padding: 0.25rem 0;
}
</style>
@endpush
@endsection
