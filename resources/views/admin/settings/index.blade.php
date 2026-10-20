@extends('layouts.admin')
@section('title',__('admin.title_settings')) @section('page-title',__('admin.title_settings'))
@section('content')
<div class="card" style="max-width:900px;"><div class="card-header"><h6 class="card-title">{{ __('admin.title_settings') }}</h6></div><div class="card-body">
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf
<h6 style="color:var(--text-tertiary);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:1rem;">{{ __('admin.settings_general') }}</h6>
<div class="row g-3 mb-4">
<div class="col-md-4"><label class="form-label">{{ __('admin.settings_site_name') }}</label><input type="text" name="site_name" class="form-control" value="{{ $settings['site_name']->value[0] ?? 'Uraz Mining & Trading LTD' }}"></div>
<div class="col-md-8"><label class="form-label">{{ __('admin.settings_tagline') }}</label><input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline']->value ?? '' }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.settings_logo') }}</label><input type="file" name="site_logo" class="form-control" accept="image/*"></div>
<div class="col-md-6">
    <label class="form-label">{{ __('admin.settings_about_image') }}</label>
    @php $aboutImg = $settings['about_image']->value ?? null; @endphp
    @if($aboutImg)
    <div class="mb-2">
        <img src="{{ asset('storage/'.$aboutImg) }}" style="height:80px;border-radius:8px;object-fit:cover;">
    </div>
    @endif
    <input type="file" name="about_image" class="form-control" accept="image/*">
    <small style="color:var(--text-muted);">{{ __('admin.photo_hint') }} — {{ __('admin.slider_img_hint') }}</small>
</div>
</div>
<h6 style="color:var(--text-tertiary);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:1rem;">{{ __('admin.settings_contact') }}</h6>
<div class="row g-3 mb-4">
<div class="col-md-6"><label class="form-label">{{ __('admin.field_email') }}</label><input type="email" name="site_email" class="form-control" value="{{ $settings['site_email']->value ?? '' }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.field_phone') }}</label><input type="text" name="site_phone" class="form-control" dir="ltr" value="{{ $settings['site_phone']->value ?? '' }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.settings_phone2') }}</label><input type="text" name="site_phone2" class="form-control" dir="ltr" value="{{ $settings['site_phone2']->value ?? '' }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.field_address') }}</label><input type="text" name="site_address" class="form-control" value="{{ $settings['site_address']->value ?? '' }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.settings_city') }}</label><input type="text" name="site_city" class="form-control" value="{{ $settings['site_city']->value ?? '' }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('admin.settings_country') }}</label><input type="text" name="site_country" class="form-control" value="{{ $settings['site_country']->value ?? '' }}"></div>
</div>
<h6 style="color:var(--text-tertiary);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:1rem;">{{ __('admin.settings_social') }}</h6>
<div class="row g-3 mb-4">
<div class="col-md-6"><label class="form-label">{{ __('admin.settings_facebook') }}</label><input type="text" name="facebook" class="form-control" value="{{ $settings['facebook']->value ?? '' }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.settings_linkedin') }}</label><input type="text" name="linkedin" class="form-control" value="{{ $settings['linkedin']->value ?? '' }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.settings_twitter') }}</label><input type="text" name="twitter" class="form-control" value="{{ $settings['twitter']->value ?? '' }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('admin.settings_instagram') }}</label><input type="text" name="instagram" class="form-control" value="{{ $settings['instagram']->value ?? '' }}"></div>
</div>
<h6 style="color:var(--text-tertiary);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:1rem;">{{ __('admin.settings_about_short') }}</h6>
<div class="mb-4"><textarea name="about_short" class="form-control" rows="3">{{ is_array($settings['about_short']->value ?? null) ? ($settings['about_short']->value[app()->getLocale()] ?? $settings['about_short']->value['en'] ?? '') : ($settings['about_short']->value ?? '') }}</textarea></div>
{{-- ── Appearance & Colors ─────────────────────────────────────── --}}
<div class="d-flex align-items-center justify-content-between mb-3" style="margin-top:0.5rem;">
    <h6 style="color:var(--text-tertiary);font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;margin:0;">
        {{ __('admin.settings_appearance') }}
    </h6>
    <button type="button" id="btnResetColors"
            style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:var(--danger);
                   padding:0.3rem 0.8rem;border-radius:6px;font-size:0.75rem;cursor:pointer;">
        <i class="fas fa-rotate-left me-1"></i> Reset to Default
    </button>
</div>

{{-- Harmony Generator --}}
<div class="harmony-box mb-4">
    <div class="harmony-head">
        <i class="fas fa-wand-magic-sparkles me-2" style="color:var(--warning);"></i>
        Color Harmony Generator
    </div>
    <div class="harmony-body">
        <p style="font-size:0.82rem;color:var(--text-muted);margin-bottom:0.85rem;">
            Pick your brand color — we'll auto-generate a harmonious palette for every zone below.
        </p>
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <div class="d-flex align-items-center gap-2">
                <input type="color" id="harmonyColor" class="color-swatch-sm" value="#C9A227">
                <input type="text"  id="harmonyHex"   class="form-control form-control-sm"
                       style="width:92px;font-family:monospace;font-size:0.82rem;" maxlength="7" value="#C9A227">
                <span style="font-size:0.78rem;color:var(--text-muted);">Brand color</span>
            </div>
            <div class="d-flex gap-1 flex-wrap">
                <button type="button" class="scheme-btn active" data-scheme="analogous">Analogous</button>
                <button type="button" class="scheme-btn" data-scheme="complementary">Complementary</button>
                <button type="button" class="scheme-btn" data-scheme="monochrome">Monochrome</button>
            </div>
            <button type="button" id="btnGenerate" class="btn btn-warning btn-sm">
                <i class="fas fa-wand-magic-sparkles me-1"></i> Generate Palette
            </button>
        </div>
    </div>
</div>

{{-- Public Website Zones --}}
<div class="zone-group-label">
    <i class="fas fa-globe me-2"></i> Public Website
</div>
<div class="row g-3 mb-4">
    @php
        $zones_public = [
            ['id'=>'colorPublicBg',      'name'=>'public_bg',      'default'=>'#1A140F',
             'label'=>'Navbar & Footer',      'desc'=>'Header, footer & hero dark layer',
             'preview'=>'linear-gradient(135deg,#1A140F 0%,#C9A227 100%)'],
            ['id'=>'colorPublicPrimary', 'name'=>'public_primary', 'default'=>'#C9A227',
             'label'=>'Primary Color',        'desc'=>'Buttons, links & headings',
             'preview'=>'#C9A227'],
            ['id'=>'colorPublicAccent',  'name'=>'public_accent',  'default'=>'#B56A3C',
             'label'=>'Accent Color',         'desc'=>'Highlights, badges & stats',
             'preview'=>'#B56A3C'],
        ];
    @endphp
    @foreach($zones_public as $z)
    <div class="col-12 col-sm-6 col-md-4">
        <div class="color-zone-card" data-default="{{ $z['default'] }}">
            <div class="zone-prev" id="prev_{{ $z['id'] }}"
                 style="background:{{ $settings[$z['name']]->value ?? $z['preview'] }};"></div>
            <div class="zone-body-inner">
                <div class="zone-title">{{ $z['label'] }}</div>
                <div class="zone-desc">{{ $z['desc'] }}</div>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <input type="color" name="{{ $z['name'] }}" id="{{ $z['id'] }}"
                           class="color-swatch-sm"
                           value="{{ $settings[$z['name']]->value ?? $z['default'] }}">
                    <input type="text" class="form-control form-control-sm color-hex-inp"
                           style="font-family:monospace;font-size:0.8rem;" maxlength="7"
                           data-swatch="{{ $z['id'] }}" data-prev="prev_{{ $z['id'] }}"
                           value="{{ $settings[$z['name']]->value ?? $z['default'] }}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Admin Panel Zones --}}
<div class="zone-group-label">
    <i class="fas fa-gauge-high me-2"></i> Admin Panel
</div>
<div class="row g-3 mb-4">
    @php
        $zones_admin = [
            ['id'=>'colorAdminBg',      'name'=>'admin_bg',         'default'=>'#15120F',
             'label'=>'Page Background',     'desc'=>'Main app background (darkest layer)',
             'preview'=>'#15120F'],
            ['id'=>'colorAdminSurface',  'name'=>'admin_surface_bg', 'default'=>'#201B16',
             'label'=>'Sidebar & Cards',     'desc'=>'Sidebar, header, cards & panels',
             'preview'=>'linear-gradient(180deg,#201B16,#15120F)'],
            ['id'=>'colorAdminPrimary', 'name'=>'admin_primary',    'default'=>'#C9A227',
             'label'=>'Primary Color',       'desc'=>'Buttons, active states & links',
             'preview'=>'#C9A227'],
        ];
    @endphp
    @foreach($zones_admin as $z)
    <div class="col-12 col-sm-6 col-md-4">
        <div class="color-zone-card" data-default="{{ $z['default'] }}">
            <div class="zone-prev" id="prev_{{ $z['id'] }}"
                 style="background:{{ $settings[$z['name']]->value ?? $z['preview'] }};"></div>
            <div class="zone-body-inner">
                <div class="zone-title">{{ $z['label'] }}</div>
                <div class="zone-desc">{{ $z['desc'] }}</div>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <input type="color" name="{{ $z['name'] }}" id="{{ $z['id'] }}"
                           class="color-swatch-sm"
                           value="{{ $settings[$z['name']]->value ?? $z['default'] }}">
                    <input type="text" class="form-control form-control-sm color-hex-inp"
                           style="font-family:monospace;font-size:0.8rem;" maxlength="7"
                           data-swatch="{{ $z['id'] }}" data-prev="prev_{{ $z['id'] }}"
                           value="{{ $settings[$z['name']]->value ?? $z['default'] }}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<button type="submit" class="btn btn-primary">{{ __('admin.save_settings') }}</button>
</form></div></div>

@push('styles')
<style>
.color-swatch-sm {
    width: 40px; height: 34px; padding: 2px 3px;
    border: 1px solid var(--dark-600); border-radius: 7px;
    cursor: pointer; background: none; flex-shrink: 0;
}
.color-zone-card {
    background: var(--bg-tertiary); border: 1px solid var(--dark-600);
    border-radius: 12px; overflow: hidden; transition: border-color .2s;
}
.color-zone-card:hover { border-color: var(--primary-400); }
.zone-prev { height: 64px; transition: background .25s ease; }
.zone-body-inner { padding: 0.85rem 1rem 1rem; }
.zone-title { font-size: 0.85rem; font-weight: 600; color: var(--text-primary); }
.zone-desc  { font-size: 0.73rem; color: var(--text-muted); margin-top: 0.1rem; line-height: 1.3; }
.zone-group-label {
    font-size: 0.72rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.1em; color: var(--text-tertiary);
    padding-bottom: 0.5rem; margin-bottom: 0.75rem;
    border-bottom: 1px solid var(--dark-700);
    display: flex; align-items: center;
}
.harmony-box {
    background: linear-gradient(135deg, rgba(59,130,246,.07), rgba(245,158,11,.05));
    border: 1px solid rgba(59,130,246,.2); border-radius: 12px; overflow: hidden;
}
.harmony-head {
    padding: .7rem 1rem; font-size: .84rem; font-weight: 600;
    color: var(--text-primary); border-bottom: 1px solid rgba(59,130,246,.15);
    display: flex; align-items: center;
}
.harmony-body { padding: 1rem; }
.scheme-btn {
    font-size: 0.71rem; padding: 0.28rem 0.7rem; border-radius: 5px;
    background: var(--bg-tertiary); border: 1px solid var(--dark-600);
    color: var(--text-muted); cursor: pointer; transition: all .15s;
}
.scheme-btn.active  { background: var(--primary-600); border-color: var(--primary-500); color: #fff; }
.scheme-btn:hover:not(.active) { border-color: var(--primary-400); color: var(--text-primary); }
</style>
@endpush

@push('scripts')
<script>
(function () {

/* ── helpers ─────────────────────────────────────────────── */
function hexToHsl(hex) {
    var r=parseInt(hex.slice(1,3),16)/255, g=parseInt(hex.slice(3,5),16)/255, b=parseInt(hex.slice(5,7),16)/255;
    var max=Math.max(r,g,b), min=Math.min(r,g,b), h=0, s=0, l=(max+min)/2;
    if(max!==min){
        var d=max-min; s=l>.5?d/(2-max-min):d/(max+min);
        if(max===r)h=((g-b)/d+(g<b?6:0))/6;
        else if(max===g)h=((b-r)/d+2)/6;
        else h=((r-g)/d+4)/6;
    }
    return [h*360,s*100,l*100];
}
function hslToHex(h,s,l){
    h=((h%360)+360)%360; s=Math.max(0,Math.min(100,s)); l=Math.max(0,Math.min(100,l));
    var h1=h/360,s1=s/100,l1=l/100,r,g,b;
    if(s1===0){r=g=b=l1;}else{
        function q2(p,q,t){if(t<0)t+=1;if(t>1)t-=1;if(t<1/6)return p+(q-p)*6*t;if(t<.5)return q;if(t<2/3)return p+(q-p)*(2/3-t)*6;return p;}
        var q=l1<.5?l1*(1+s1):l1+s1-l1*s1, p=2*l1-q;
        r=q2(p,q,h1+1/3); g=q2(p,q,h1); b=q2(p,q,h1-1/3);
    }
    return '#'+[r,g,b].map(function(x){return Math.round(x*255).toString(16).padStart(2,'0');}).join('');
}
function applyZone(swatchId, color){
    var sw=document.getElementById(swatchId);
    var hx=document.querySelector('[data-swatch="'+swatchId+'"]');
    var pv=document.getElementById(hx&&hx.dataset.prev);
    if(sw)sw.value=color;
    if(hx)hx.value=color;
    if(pv)pv.style.background=color;
}

/* ── swatch ↔ hex ↔ preview sync ─────────────────────────── */
document.querySelectorAll('.color-hex-inp').forEach(function(hx){
    var sw=document.getElementById(hx.dataset.swatch);
    var pv=document.getElementById(hx.dataset.prev);
    function sync(c){if(sw)sw.value=c;hx.value=c;if(pv)pv.style.background=c;}
    if(sw)sw.addEventListener('input',function(){sync(sw.value);});
    hx.addEventListener('input',function(){if(/^#[0-9a-fA-F]{6}$/.test(hx.value))sync(hx.value);});
});

/* ── harmony brand color sync ────────────────────────────── */
var hc=document.getElementById('harmonyColor'), hh=document.getElementById('harmonyHex');
hc.addEventListener('input',function(){hh.value=hc.value;});
hh.addEventListener('input',function(){if(/^#[0-9a-fA-F]{6}$/.test(hh.value))hc.value=hh.value;});

/* ── scheme buttons ──────────────────────────────────────── */
document.querySelectorAll('.scheme-btn').forEach(function(b){
    b.addEventListener('click',function(){
        document.querySelectorAll('.scheme-btn').forEach(function(x){x.classList.remove('active');});
        b.classList.add('active');
    });
});

/* ── generate palette ────────────────────────────────────── */
document.getElementById('btnGenerate').addEventListener('click',function(){
    var brand=document.getElementById('harmonyColor').value;
    var scheme=document.querySelector('.scheme-btn.active').dataset.scheme;
    var hsl=hexToHsl(brand), H=hsl[0], S=hsl[1], L=hsl[2];

    var accent;
    if(scheme==='complementary') accent=hslToHex(H+180,S,L);
    else if(scheme==='monochrome') accent=hslToHex(H,Math.max(S-15,10),Math.min(L+22,80));
    else accent=hslToHex(H+38,S,L);

    var darkBase   = hslToHex(H, Math.min(S*.75,80), Math.max(Math.min(L*.18,16), 4));
    var adminBg    = hslToHex(H, Math.min(S*.65,70), Math.max(Math.min(L*.12,13), 3));
    var adminSurf  = hslToHex(H, Math.min(S*.55,60), Math.max(Math.min(L*.22,22), 8));

    applyZone('colorPublicBg',     darkBase);
    applyZone('colorPublicPrimary',brand);
    applyZone('colorPublicAccent', accent);
    applyZone('colorAdminBg',      adminBg);
    applyZone('colorAdminSurface', adminSurf);
    applyZone('colorAdminPrimary', brand);
});

/* ── reset to defaults ───────────────────────────────────── */
document.getElementById('btnResetColors').addEventListener('click',function(){
    document.querySelectorAll('.color-zone-card').forEach(function(card){
        var def=card.dataset.default;
        var sw=card.querySelector('.color-swatch-sm');
        var hx=card.querySelector('.color-hex-inp');
        var pv=card.querySelector('.zone-prev');
        if(sw)sw.value=def;
        if(hx)hx.value=def;
        if(pv)pv.style.background=def;
    });
});

})();
</script>
@endpush
@endsection
