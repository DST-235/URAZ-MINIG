<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','Admin') — STH Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.js"></script>
<style>
[dir="rtl"] { direction: rtl; }
[dir="rtl"] .sidebar { left: auto; right: 0; border-right: none; border-left: 1px solid var(--dark-700); }
[dir="rtl"] .main-content { margin-left: 0; margin-right: var(--sidebar-width); }
[dir="rtl"] .main-content.sidebar-collapsed { margin-left: 0; margin-right: var(--sidebar-width-collapsed); }
@media (max-width: 991.98px) {
    [dir="rtl"] .sidebar { transform: translateX(100%); }
    [dir="rtl"] .sidebar.show { transform: translateX(0); }
    [dir="rtl"] .main-content { margin-right: 0; }
}
[dir="rtl"] .nav-link::before { left: auto; right: 0; border-radius: 3px 0 0 3px; }
[dir="rtl"] .dropdown-content { right: auto; left: 0; }
:root {
    --primary-50: #eff6ff; --primary-100: #dbeafe; --primary-200: #bfdbfe;
    --primary-300: #93c5fd; --primary-400: #60a5fa; --primary-500: #3b82f6;
    --primary-600: #2563eb; --primary-700: #1d4ed8; --primary-800: #1e40af; --primary-900: #1e3a8a;
    --dark-50: #f8fafc; --dark-100: #f1f5f9; --dark-200: #e2e8f0; --dark-300: #cbd5e1;
    --dark-400: #94a3b8; --dark-500: #64748b; --dark-600: #475569; --dark-700: #334155;
    --dark-800: #1e293b; --dark-900: #0f172a;
    --bg-primary: #0f172a; --bg-secondary: #1e293b; --bg-tertiary: #334155;
    --bg-surface: #475569; --bg-glass: rgba(30,41,59,0.95);
    --text-primary: #ffffff; --text-secondary: #f1f5f9; --text-tertiary: #e2e8f0;
    --text-muted: #cbd5e1; --text-disabled: #94a3b8; --text-link: #60a5fa; --text-link-hover: #93c5fd;
    --success: #10b981; --warning: #f59e0b; --danger: #ef4444; --info: #06b6d4;
    --border-radius: 8px; --border-radius-sm: 6px; --border-radius-lg: 12px;
    --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);
    --sidebar-width: 280px; --sidebar-width-collapsed: 70px; --header-height: 60px;
    --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
* { box-sizing: border-box; }
body { font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; background:var(--bg-primary); color:var(--text-primary); line-height:1.5; -webkit-font-smoothing:antialiased; overflow-x:hidden; font-size:14px; }
h1,h2,h3,h4,h5,h6 { color:var(--text-primary); font-weight:600; }
p { color:var(--text-secondary); font-size:0.875rem; }
a { color:var(--text-link); text-decoration:none; transition:var(--transition); }
a:hover { color:var(--text-link-hover); }
::-webkit-scrollbar { width:4px; height:4px; }
::-webkit-scrollbar-track { background:var(--bg-secondary); }
::-webkit-scrollbar-thumb { background:var(--bg-surface); border-radius:2px; }
.app-wrapper { display:flex; min-height:100vh; }
.sidebar { position:fixed; top:0; left:0; width:var(--sidebar-width); height:100vh; background:linear-gradient(180deg,var(--bg-secondary) 0%,var(--bg-primary) 100%); border-right:1px solid var(--dark-700); transition:var(--transition); z-index:1050; overflow-y:auto; box-shadow:var(--shadow-xl); }
.sidebar.collapsed { width:var(--sidebar-width-collapsed); }
.sidebar-header { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.5rem; border-bottom:1px solid var(--dark-700); min-height:var(--header-height); }
.sidebar-logo { display:flex; align-items:center; gap:0.75rem; text-decoration:none; }
.sidebar-logo-icon { width:36px; height:36px; background:linear-gradient(135deg,var(--primary-500),var(--primary-700)); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; color:#fff; font-weight:700; flex-shrink:0; }
.sidebar-logo-text { font-size:1.25rem; font-weight:700; color:var(--text-primary); white-space:nowrap; }
.sidebar-logo-sub { font-size:0.65rem; color:var(--text-muted); display:block; }
.sidebar-toggle { background:none; border:none; color:var(--text-muted); cursor:pointer; padding:0.25rem; border-radius:4px; transition:var(--transition); }
.sidebar-toggle:hover { color:var(--text-primary); background:var(--bg-tertiary); }
.sidebar-nav { padding:1rem 0; }
.nav-section-title { font-size:0.65rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:var(--text-disabled); padding:0.75rem 1.5rem 0.25rem; white-space:nowrap; overflow:hidden; }
.nav-link { display:flex; align-items:center; gap:0.75rem; padding:0.65rem 1.5rem; color:var(--text-muted); font-size:0.875rem; font-weight:400; text-decoration:none; transition:var(--transition); position:relative; border-left:3px solid transparent; white-space:nowrap; }
[dir="rtl"] .nav-link { border-left:none; border-right:3px solid transparent; }
.nav-link:hover { color:var(--text-primary); background:rgba(255,255,255,0.05); border-left-color:var(--primary-400); }
[dir="rtl"] .nav-link:hover { border-right-color:var(--primary-400); border-left-color:transparent; }
.nav-link.active { color:var(--primary-400); background:rgba(59,130,246,0.1); border-left-color:var(--primary-400); font-weight:500; }
[dir="rtl"] .nav-link.active { border-right-color:var(--primary-400); border-left-color:transparent; }
.nav-link i { width:18px; text-align:center; font-size:0.9rem; flex-shrink:0; }
.nav-link .badge { margin-left:auto; }
.main-content { flex:1; margin-left:var(--sidebar-width); min-height:100vh; transition:var(--transition); display:flex; flex-direction:column; }
.main-content.sidebar-collapsed { margin-left:var(--sidebar-width-collapsed); }
.top-header { height:var(--header-height); background:var(--bg-glass); backdrop-filter:blur(10px); border-bottom:1px solid var(--dark-700); display:flex; align-items:center; justify-content:space-between; padding:0 1.5rem; position:sticky; top:0; z-index:100; }
.header-left { display:flex; align-items:center; gap:1rem; }
.header-right { display:flex; align-items:center; gap:0.75rem; }
.page-title-header { font-size:1rem; font-weight:600; color:var(--text-primary); }
.page-content { padding:1.5rem; flex:1; }
.card { background:var(--bg-secondary); border:1px solid var(--dark-700); border-radius:var(--border-radius-lg); }
.card-header { background:transparent; border-bottom:1px solid var(--dark-700); padding:1rem 1.25rem; }
.card-body { padding:1.25rem; }
.card-title { color:var(--text-primary); font-weight:600; margin-bottom:0; }
.stat-card { background:linear-gradient(135deg,var(--bg-secondary),var(--bg-tertiary)); border:1px solid var(--dark-700); border-radius:var(--border-radius-lg); padding:1.25rem; transition:var(--transition); }
.stat-card:hover { transform:translateY(-2px); border-color:var(--primary-600); }
.stat-icon { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; }
.btn-primary { background:var(--primary-600); border-color:var(--primary-600); }
.btn-primary:hover { background:var(--primary-700); border-color:var(--primary-700); }
.form-control,.form-select { background:var(--bg-tertiary); border:1px solid var(--dark-600); color:var(--text-primary); }
.form-control:focus,.form-select:focus { background:var(--bg-tertiary); border-color:var(--primary-500); color:var(--text-primary); box-shadow:0 0 0 0.2rem rgba(59,130,246,0.25); }
.form-control::placeholder { color:var(--text-disabled); }
.form-label { color:var(--text-tertiary); font-size:0.85rem; font-weight:500; }
.table { color:var(--text-secondary); }
.table th { color:var(--text-muted); font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; font-weight:600; border-color:var(--dark-700); }
.table td { border-color:var(--dark-700); vertical-align:middle; }
.table tbody tr:hover { background:rgba(255,255,255,0.03); }
.badge { font-size:0.7rem; }
.lang-tab { padding:0.4rem 0.9rem; border-radius:6px; cursor:pointer; font-size:0.8rem; font-weight:500; transition:var(--transition); border:1px solid var(--dark-600); background:var(--bg-tertiary); color:var(--text-muted); display:inline-block; margin-right:4px; }
.lang-tab.active { background:var(--primary-600); border-color:var(--primary-600); color:#fff; }
.lang-content { display:none; }
.lang-content.active { display:block; }
.alert-success { background:rgba(16,185,129,0.15); border-color:rgba(16,185,129,0.3); color:#34d399; }
.alert-danger { background:rgba(239,68,68,0.15); border-color:rgba(239,68,68,0.3); color:#f87171; }
@media (max-width:991.98px) {
    .sidebar { transform:translateX(-100%); }
    .sidebar.show { transform:translateX(0); }
    .main-content { margin-left:0 !important; }
    .sidebar-overlay { display:block; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1049; }
}
.sidebar.collapsed .nav-section-title,.sidebar.collapsed .nav-link span,.sidebar.collapsed .sidebar-logo-text { display:none; }
.sidebar.collapsed .nav-link { padding:0.65rem; justify-content:center; }
.sidebar.collapsed .nav-link i { margin:0; }
.unread-badge { display:inline-flex; align-items:center; justify-content:center; width:18px; height:18px; background:var(--danger); border-radius:50%; font-size:0.65rem; font-weight:700; color:#fff; }

/* ── Sidebar accordion groups ── */
.nav-group-toggle { display:flex; align-items:center; gap:0.75rem; width:100%; padding:0.65rem 1.5rem; background:none; border:none; color:var(--text-muted); font-size:0.72rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; cursor:pointer; transition:var(--transition); white-space:nowrap; }
.nav-group-toggle:hover { color:var(--text-primary); }
.nav-group-toggle .toggle-chevron { margin-left:auto; font-size:0.65rem; transition:transform 0.25s ease; }
[dir="rtl"] .nav-group-toggle .toggle-chevron { margin-left:0; margin-right:auto; }
.nav-group-toggle.open .toggle-chevron { transform:rotate(180deg); }
.nav-group-items { overflow:hidden; max-height:0; transition:max-height 0.3s ease; }
.nav-group-items.open { max-height:600px; }
.sidebar.collapsed .nav-group-toggle span, .sidebar.collapsed .nav-group-toggle .toggle-chevron { display:none; }
.sidebar.collapsed .nav-group-items { max-height:none; overflow:visible; }

/* ===== COMPREHENSIVE BOOTSTRAP DARK OVERRIDES ===== */
/* Force everything in admin to use dark theme */
.page-content, .main-content, .app-wrapper { background:var(--bg-primary) !important; }

/* Dropdowns */
.dropdown-menu { background:var(--bg-secondary) !important; border:1px solid var(--dark-600) !important; box-shadow:0 8px 24px rgba(0,0,0,0.4) !important; }
.dropdown-item { color:var(--text-secondary) !important; font-size:0.875rem; }
.dropdown-item:hover,.dropdown-item:focus { background:var(--bg-tertiary) !important; color:var(--text-primary) !important; }
.dropdown-divider { border-color:var(--dark-600) !important; }
.dropdown-header { color:var(--text-muted) !important; }

/* Buttons */
.btn-secondary { background:var(--bg-tertiary) !important; border-color:var(--dark-600) !important; color:var(--text-secondary) !important; }
.btn-secondary:hover { background:var(--bg-surface) !important; color:var(--text-primary) !important; }
.btn-outline-secondary { border-color:var(--dark-600) !important; color:var(--text-muted) !important; background:transparent !important; }
.btn-outline-secondary:hover { background:var(--bg-tertiary) !important; color:var(--text-primary) !important; }
.btn-danger { background:#dc2626 !important; border-color:#dc2626 !important; color:#fff !important; }
.btn-danger:hover { background:#b91c1c !important; }
.btn-sm { font-size:0.78rem !important; padding:0.3rem 0.65rem !important; }
.btn:focus { box-shadow:none !important; }

/* Forms */
input[type="text"],input[type="email"],input[type="password"],input[type="number"],input[type="date"],input[type="url"],input[type="tel"],input[type="search"],textarea,select { background:var(--bg-tertiary) !important; border:1px solid var(--dark-600) !important; color:var(--text-primary) !important; border-radius:var(--border-radius-sm) !important; }
input[type="text"]:focus,input[type="email"]:focus,input[type="password"]:focus,input[type="number"]:focus,input[type="date"]:focus,input[type="url"]:focus,textarea:focus,select:focus { border-color:var(--primary-500) !important; outline:none !important; box-shadow:0 0 0 3px rgba(59,130,246,0.15) !important; background:var(--bg-tertiary) !important; color:var(--text-primary) !important; }
input::placeholder,textarea::placeholder { color:var(--text-disabled) !important; }
input[type="file"].form-control { background:var(--bg-tertiary) !important; color:var(--text-muted) !important; }
input[type="file"]::file-selector-button { background:var(--bg-surface) !important; border:1px solid var(--dark-600) !important; color:var(--text-secondary) !important; padding:0.35rem 0.75rem; border-radius:4px; margin-right:0.75rem; cursor:pointer; }
.form-check-input { background-color:var(--bg-tertiary) !important; border-color:var(--dark-500) !important; }
.form-check-input:checked { background-color:var(--primary-600) !important; border-color:var(--primary-600) !important; }
.form-check-label { color:var(--text-muted) !important; font-size:0.82rem; }

/* Tables */
.table { --bs-table-bg: transparent !important; --bs-table-striped-bg: rgba(255,255,255,0.02) !important; --bs-table-hover-bg: rgba(255,255,255,0.04) !important; --bs-table-color: var(--text-secondary) !important; --bs-table-border-color: var(--dark-700) !important; color:var(--text-secondary) !important; }
.table > :not(caption) > * > * { background-color:transparent !important; color:inherit !important; border-bottom-color:var(--dark-700) !important; }
.table-responsive { border-color:var(--dark-700) !important; }

/* Pagination */
.pagination { --bs-pagination-bg: var(--bg-tertiary); --bs-pagination-border-color: var(--dark-600); --bs-pagination-color: var(--text-muted); --bs-pagination-hover-bg: var(--bg-surface); --bs-pagination-hover-color: var(--text-primary); --bs-pagination-active-bg: var(--primary-600); --bs-pagination-active-border-color: var(--primary-600); --bs-pagination-disabled-bg: var(--bg-secondary); --bs-pagination-disabled-color: var(--text-disabled); }
.page-link { background:var(--bg-tertiary) !important; border-color:var(--dark-600) !important; color:var(--text-muted) !important; }
.page-link:hover { background:var(--bg-surface) !important; color:var(--text-primary) !important; }
.page-item.active .page-link { background:var(--primary-600) !important; border-color:var(--primary-600) !important; color:#fff !important; }
.page-item.disabled .page-link { background:var(--bg-secondary) !important; color:var(--text-disabled) !important; }

/* Modal */
.modal-content { background:var(--bg-secondary) !important; border:1px solid var(--dark-600) !important; color:var(--text-primary) !important; }
.modal-header { border-bottom-color:var(--dark-700) !important; }
.modal-footer { border-top-color:var(--dark-700) !important; }
.modal-backdrop { background:rgba(0,0,0,0.7) !important; }

/* Alert overrides */
.alert { border-radius:var(--border-radius) !important; font-size:0.875rem; }
.alert-success { background:rgba(16,185,129,0.12) !important; border-color:rgba(16,185,129,0.25) !important; color:#34d399 !important; }
.alert-danger  { background:rgba(239,68,68,0.12) !important; border-color:rgba(239,68,68,0.25) !important; color:#f87171 !important; }
.alert-warning { background:rgba(245,158,11,0.12) !important; border-color:rgba(245,158,11,0.25) !important; color:#fbbf24 !important; }
.alert-info    { background:rgba(6,182,212,0.12) !important; border-color:rgba(6,182,212,0.25) !important; color:#22d3ee !important; }
.btn-close { filter:invert(1) !important; }

/* Code */
code { background:var(--bg-tertiary) !important; color:var(--info) !important; padding:0.1rem 0.4rem; border-radius:4px; font-size:0.82rem; }

/* HR */
hr { border-color:var(--dark-700) !important; }

/* Select2 / custom selects */
option { background:var(--bg-secondary) !important; color:var(--text-primary) !important; }

/* Small helper */
small, .small { color:var(--text-muted) !important; }

/* Mobile responsiveness */
@media (max-width: 576px) {
    .page-content { padding: 1rem 0.75rem !important; }
    .top-header { padding: 0 0.75rem; }
    .card-body { padding: 1rem !important; }
    .card-header { padding: 0.75rem 1rem !important; }
    .stat-card { padding: 1rem !important; }
}
</style>
@php
    $dynAdmin       = \App\Models\Setting::get('admin_primary');
    $dynAdminBg     = \App\Models\Setting::get('admin_bg');
    $dynAdminSurf   = \App\Models\Setting::get('admin_surface_bg');
@endphp
@if($dynAdmin || $dynAdminBg || $dynAdminSurf)
<style>
:root {
    @if($dynAdminBg)
    --bg-primary: {{ $dynAdminBg }};
    @endif
    @if($dynAdminSurf)
    --bg-secondary: {{ $dynAdminSurf }};
    --bg-tertiary:  color-mix(in srgb, {{ $dynAdminSurf }} 72%, #94a3b8);
    --bg-surface:   color-mix(in srgb, {{ $dynAdminSurf }} 50%, #94a3b8);
    --bg-glass:     color-mix(in srgb, {{ $dynAdminSurf }} 95%, transparent);
    @elseif($dynAdminBg)
    --bg-secondary: color-mix(in srgb, {{ $dynAdminBg }} 72%, #94a3b8);
    --bg-tertiary:  color-mix(in srgb, {{ $dynAdminBg }} 52%, #94a3b8);
    --bg-surface:   color-mix(in srgb, {{ $dynAdminBg }} 36%, #94a3b8);
    @endif
    @if($dynAdmin)
    --primary-500: {{ $dynAdmin }};
    --primary-600: color-mix(in srgb, {{ $dynAdmin }} 78%, #000);
    --primary-700: color-mix(in srgb, {{ $dynAdmin }} 60%, #000);
    --primary-400: color-mix(in srgb, {{ $dynAdmin }} 78%, #fff);
    --primary-300: color-mix(in srgb, {{ $dynAdmin }} 58%, #fff);
    --primary-200: color-mix(in srgb, {{ $dynAdmin }} 35%, #fff);
    --primary-100: color-mix(in srgb, {{ $dynAdmin }} 15%, #fff);
    --primary-50:  color-mix(in srgb, {{ $dynAdmin }}  8%, #fff);
    @endif
}
</style>
@endif
    @stack('styles')
</head>
<body>
<div class="app-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                @php $adminLogo = \App\Models\Setting::get('site_logo'); $adminName = \App\Models\Setting::get('site_name','STH'); @endphp
                @if($adminLogo)
                    <img src="{{ asset('storage/'.$adminLogo) }}" alt="{{ $adminName }}" style="height:34px;max-width:120px;object-fit:contain;">
                @else
                    <div class="sidebar-logo-icon">{{ strtoupper(substr($adminName,0,1)) }}</div>
                    <div>
                        <span class="sidebar-logo-text">{{ $adminName }}</span>
                        <span class="sidebar-logo-sub">{{ __('messages.admin_panel') }}</span>
                    </div>
                @endif
            </a>
            <button class="sidebar-toggle d-none d-lg-flex" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        @php
            $inContent = request()->routeIs('admin.sliders*','admin.services*','admin.projects*','admin.team*','admin.blog*','admin.testimonials*','admin.stats*','admin.faqs*','admin.pages*');
            $inComms   = request()->routeIs('admin.contact*');
            $inSystem  = request()->routeIs('admin.users*','admin.settings*');
            $unread    = \App\Models\ContactMessage::unread()->count();
        @endphp
        <nav class="sidebar-nav">

            {{-- MAIN --}}
            <div class="nav-section-title"><span>{{ __('messages.admin_main') }}</span></div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i><span>{{ __('messages.admin_dashboard') }}</span>
            </a>

            {{-- CONTENT group --}}
            <button class="nav-group-toggle {{ $inContent ? 'open' : '' }}" data-target="group-content">
                <i class="fas fa-layer-group" style="width:18px;text-align:center;font-size:0.9rem;"></i>
                <span>{{ __('messages.admin_content') }}</span>
                <i class="fas fa-chevron-down toggle-chevron"></i>
            </button>
            <div class="nav-group-items {{ $inContent ? 'open' : '' }}" id="group-content">
                <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i><span>{{ __('messages.admin_sliders') }}</span>
                </a>
                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i><span>{{ __('messages.admin_services') }}</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i><span>{{ __('messages.admin_portfolio') }}</span>
                </a>
                <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i><span>{{ __('messages.admin_team') }}</span>
                </a>
                <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i><span>{{ __('messages.admin_blog') }}</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                    <i class="fas fa-quote-left"></i><span>{{ __('messages.admin_testimonials') }}</span>
                </a>
                <a href="{{ route('admin.stats.index') }}" class="nav-link {{ request()->routeIs('admin.stats*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i><span>{{ __('messages.admin_stats') }}</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                    <i class="fas fa-question-circle"></i><span>{{ __('messages.admin_faqs') }}</span>
                </a>
                <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i><span>{{ __('messages.admin_pages') }}</span>
                </a>
            </div>

            {{-- COMMUNICATION group --}}
            <button class="nav-group-toggle {{ $inComms ? 'open' : '' }}" data-target="group-comms">
                <i class="fas fa-envelope" style="width:18px;text-align:center;font-size:0.9rem;"></i>
                <span>{{ __('messages.admin_communication') }}</span>
                @if($unread > 0)<span class="unread-badge">{{ $unread }}</span>@endif
                <i class="fas fa-chevron-down toggle-chevron"></i>
            </button>
            <div class="nav-group-items {{ $inComms ? 'open' : '' }}" id="group-comms">
                <a href="{{ route('admin.contact.index') }}" class="nav-link {{ request()->routeIs('admin.contact*') ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i><span>{{ __('messages.admin_messages') }}</span>
                    @if($unread > 0)<span class="unread-badge ms-auto">{{ $unread }}</span>@endif
                </a>
            </div>

            {{-- SYSTEM group --}}
            <button class="nav-group-toggle {{ $inSystem ? 'open' : '' }}" data-target="group-system">
                <i class="fas fa-shield-alt" style="width:18px;text-align:center;font-size:0.9rem;"></i>
                <span>{{ __('messages.admin_system') }}</span>
                <i class="fas fa-chevron-down toggle-chevron"></i>
            </button>
            <div class="nav-group-items {{ $inSystem ? 'open' : '' }}" id="group-system">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i><span>{{ __('messages.admin_users') }}</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h"></i><span>{{ __('messages.admin_settings') }}</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="nav-link">
                    <i class="fas fa-external-link-alt"></i><span>{{ __('messages.admin_view_website') }}</span>
                </a>
                <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#qrCodeModal" style="width:100%;background:none;border:none;text-align:start;">
                    <i class="fas fa-qrcode"></i><span>{{ __('messages.admin_download_qr') }}</span>
                </button>
            </div>

        </nav>
    </aside>
    <div class="sidebar-overlay d-none" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <header class="top-header">
            <div class="header-left">
                <button class="sidebar-toggle d-lg-none" id="mobileSidebarToggle" style="background:none;border:none;color:var(--text-muted);font-size:1.1rem;cursor:pointer;">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="page-title-header d-none d-md-block">@yield('page-title','Dashboard')</span>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" style="border-color:var(--dark-600);color:var(--text-muted);background:var(--bg-tertiary);">
                        <i class="fas fa-globe me-1"></i>{{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="background:var(--bg-secondary);border-color:var(--dark-600);">
                        <li><a class="dropdown-item" href="{{ route('lang.switch','en') }}" style="color:var(--text-secondary);">🇬🇧 English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch','fr') }}" style="color:var(--text-secondary);">🇫🇷 Français</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch','ar') }}" style="color:var(--text-secondary);">🇸🇦 العربية</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm d-flex align-items-center gap-2" data-bs-toggle="dropdown" style="background:var(--bg-tertiary);border:1px solid var(--dark-600);color:var(--text-secondary);">
                        <i class="fas fa-user-circle"></i>
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down" style="font-size:0.65rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="background:var(--bg-secondary);border-color:var(--dark-600);">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}" style="color:var(--text-secondary);"><i class="fas fa-user me-2"></i>{{ __('messages.admin_profile') }}</a></li>
                        <li><hr class="dropdown-divider" style="border-color:var(--dark-600);"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="color:#f87171;"><i class="fas fa-sign-out-alt me-2"></i>{{ __('messages.admin_logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const overlay = document.getElementById('sidebarOverlay');

// Desktop toggle
document.getElementById('sidebarToggle')?.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('sidebar-collapsed');
});
// Mobile toggle
document.getElementById('mobileSidebarToggle')?.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    overlay.classList.toggle('d-none');
});
overlay?.addEventListener('click', () => {
    sidebar.classList.remove('show');
    overlay.classList.add('d-none');
});

// Language tabs
function switchLang(lang) {
    document.querySelectorAll('.lang-tab').forEach(t => t.classList.toggle('active', t.dataset.lang === lang));
    document.querySelectorAll('.lang-content').forEach(c => c.classList.toggle('active', c.dataset.lang === lang));
}
document.querySelectorAll('.lang-tab').forEach(t => t.addEventListener('click', () => switchLang(t.dataset.lang)));
// Activate first lang tab if any
const firstTab = document.querySelector('.lang-tab');
if (firstTab) switchLang(firstTab.dataset.lang);
</script>
@stack('scripts')
<script>
// Sidebar accordion groups
document.querySelectorAll('.nav-group-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        if (!target) return;
        const isOpen = target.classList.contains('open');
        // Close all
        document.querySelectorAll('.nav-group-items').forEach(el => el.classList.remove('open'));
        document.querySelectorAll('.nav-group-toggle').forEach(el => el.classList.remove('open'));
        // Open clicked (toggle)
        if (!isOpen) {
            target.classList.add('open');
            btn.classList.add('open');
        }
    });
});
</script>
<!-- QR Code Modal -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:340px;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="qrModalLabel" style="font-size:0.9rem;">
                    <i class="fas fa-qrcode me-2" style="color:var(--primary-400);"></i>{{ __('messages.admin_download_qr') }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div style="display:inline-block;background:#fff;padding:16px;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.4);">
                    <div id="qrSpinner" style="width:270px;height:270px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-spinner fa-spin" style="font-size:2rem;color:#94a3b8;"></i>
                    </div>
                    <img id="qrCodeImg" src="" alt="QR Code" style="display:none;width:270px;height:270px;image-rendering:pixelated;">
                </div>
                <p class="mt-3 mb-1" style="font-size:0.78rem;color:var(--text-muted);">
                    <i class="fas fa-mobile-alt me-1"></i>Scan to open the website
                </p>
                <p style="font-size:0.7rem;color:var(--text-disabled);word-break:break-all;">{{ url('/') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-primary btn-sm" id="downloadQrPng" disabled>
                    <i class="fas fa-download me-2"></i>Download PNG
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var modal = document.getElementById('qrCodeModal');
    if (!modal) return;
    var qrDataUrl = null;

    modal.addEventListener('shown.bs.modal', function() {
        if (qrDataUrl) return;

        // qrcode-generator: global function qrcode(typeNumber, errorCorrectionLevel)
        var qr = qrcode(0, 'M');
        qr.addData('{{ url('/') }}');
        qr.make();

        // Render onto a fixed 280×280 canvas
        var size = 280;
        var modules = qr.getModuleCount();
        var cell = Math.floor((size - 16) / modules); // 8px quiet zone each side
        var offset = Math.floor((size - modules * cell) / 2);

        var canvas = document.createElement('canvas');
        canvas.width = size;
        canvas.height = size;
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, size, size);
        ctx.fillStyle = '#000000';
        for (var row = 0; row < modules; row++) {
            for (var col = 0; col < modules; col++) {
                if (qr.isDark(row, col)) {
                    ctx.fillRect(offset + col * cell, offset + row * cell, cell, cell);
                }
            }
        }

        qrDataUrl = canvas.toDataURL('image/png');
        var img = document.getElementById('qrCodeImg');
        img.src = qrDataUrl;
        img.style.display = 'block';
        document.getElementById('qrSpinner').style.display = 'none';
        document.getElementById('downloadQrPng').disabled = false;
    });

    document.getElementById('downloadQrPng').addEventListener('click', function() {
        if (!qrDataUrl) return;
        var a = document.createElement('a');
        a.href = qrDataUrl;
        a.download = 'sth-website-qr.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
})();
</script>
</body>
</html>
