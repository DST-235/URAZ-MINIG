@php
    $loginLogo = \App\Models\Setting::get('site_logo');
    $loginName = \App\Models\Setting::get('site_name', 'STH');
@endphp
<a href="/" style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;">
    @if($loginLogo)
        <img src="{{ asset('storage/'.$loginLogo) }}" alt="{{ $loginName }}" style="max-height:70px;max-width:220px;object-fit:contain;">
    @else
        <div style="display:flex;align-items:center;gap:0.6rem;">
            <div style="width:48px;height:48px;background:linear-gradient(135deg,#1565C0,#00B4D8);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;font-weight:900;color:#fff;">
                {{ strtoupper(substr($loginName,0,1)) }}
            </div>
            <span style="font-size:1.75rem;font-weight:900;color:#fff;letter-spacing:-0.5px;">{{ $loginName }}</span>
        </div>
    @endif
</a>
