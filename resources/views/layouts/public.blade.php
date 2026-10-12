<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','STH') — System Technologie Hanana</title>
    <meta name="description" content="@yield('meta-description','Leading IT company in Chad. ERP, Government Systems, School Management, Market Systems, Web Development and more.')">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
html { overflow-x: hidden; }
:root {
    --navy: #0A1628;
    --navy-light: #0D1F3C;
    --blue: #1565C0;
    --blue-bright: #1E88E5;
    --cyan: #00B4D8;
    --cyan-light: #90E0EF;
    --gold: #FFB703;
    --light-bg: #F4F7FB;
    --light-bg2: #EEF2F9;
    --text-dark: #0D1B2A;
    --text-body: #374151;
    --text-muted: #6B7280;
    --white: #FFFFFF;
    --border: #E5E9F0;
    --gradient-hero: linear-gradient(135deg, #0A1628 0%, #1565C0 100%);
    --gradient-card: linear-gradient(135deg, #0D1F3C, #1565C0);
    --shadow: 0 4px 20px rgba(10,22,40,0.12);
    --shadow-lg: 0 10px 40px rgba(10,22,40,0.18);
    --transition: all 0.3s ease;
}
[dir="rtl"] { font-family: 'Noto Sans Arabic', 'Inter', sans-serif; }
[dir="ltr"] { font-family: 'Inter', sans-serif; }
* { box-sizing: border-box; margin: 0; padding: 0; }
body { color: var(--text-body); background: #fff; overflow-x: hidden; }
a { text-decoration: none; color: inherit; transition: var(--transition); }
img { max-width: 100%; }
.section-pad { padding: 80px 0; }
.section-pad-sm { padding: 50px 0; }
.section-title { font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 800; color: var(--text-dark); line-height: 1.2; }
.section-subtitle { font-size: 1rem; color: var(--text-muted); max-width: 600px; }
.badge-pill { display: inline-block; padding: 0.4rem 1.1rem; border-radius: 50px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; }
.badge-blue { background: rgba(21,101,192,0.12); color: var(--blue); }
.btn-primary-sth { background: var(--blue); color: #fff; border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; transition: var(--transition); display: inline-block; }
.btn-primary-sth:hover { background: var(--navy); color: #fff; transform: translateY(-2px); box-shadow: var(--shadow); }
.btn-outline-sth { border: 2px solid var(--blue); color: var(--blue); padding: 0.7rem 1.9rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; transition: var(--transition); display: inline-block; background: transparent; }
.btn-outline-sth:hover { background: var(--blue); color: #fff; }
.btn-white { background: #fff; color: var(--navy); padding: 0.75rem 2rem; border-radius: 8px; font-weight: 700; font-size: 0.95rem; transition: var(--transition); display: inline-block; }
.btn-white:hover { background: var(--cyan-light); color: var(--navy); transform: translateY(-2px); }
.btn-outline-white { border: 2px solid rgba(255,255,255,0.6); color: #fff; padding: 0.7rem 1.9rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; transition: var(--transition); display: inline-block; background: transparent; }
.btn-outline-white:hover { background: rgba(255,255,255,0.15); border-color: #fff; color: #fff; }

/* ===== NAVBAR ===== */
.navbar-sth { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; transition: var(--transition); padding: 0; }
.navbar-sth.scrolled { background: rgba(10,22,40,0.97) !important; backdrop-filter: blur(12px); box-shadow: 0 2px 20px rgba(0,0,0,0.3); }
.navbar-sth .navbar-inner { display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; height: 72px; max-width: 1300px; margin: 0 auto; }
.navbar-brand-sth { display: flex; align-items: center; gap: 0.6rem; font-weight: 800; font-size: 1.4rem; color: #fff; }
.navbar-brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--blue), var(--cyan)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 900; color: #fff; }
.nav-links { display: flex; align-items: center; gap: 0.25rem; list-style: none; }
.nav-links li a { color: rgba(255,255,255,0.85); font-size: 0.9rem; font-weight: 500; padding: 0.5rem 0.9rem; border-radius: 6px; transition: var(--transition); }
.nav-links li a:hover { color: #fff; background: rgba(255,255,255,0.1); }
.nav-links li a.active { color: var(--cyan); }
.nav-dropdown { position: relative; }
.nav-dropdown > a { display: flex; align-items: center; gap: 0.3rem; }
.nav-dropdown-menu { position: absolute; top: calc(100% + 8px); left: 0; background: var(--navy); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 0.5rem; min-width: 260px; opacity: 0; visibility: hidden; transform: translateY(-8px); transition: var(--transition); box-shadow: var(--shadow-lg); z-index: 200; }
[dir="rtl"] .nav-dropdown-menu { left: auto; right: 0; }
.nav-dropdown:hover .nav-dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
.nav-dropdown-menu a { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0.9rem; border-radius: 8px; color: rgba(255,255,255,0.8); font-size: 0.875rem; transition: var(--transition); }
.nav-dropdown-menu a:hover { background: rgba(255,255,255,0.08); color: var(--cyan); }
.nav-dropdown-menu a i { width: 20px; text-align: center; color: var(--cyan); }
.nav-actions { display: flex; align-items: center; gap: 0.75rem; }
.lang-switcher { display: flex; align-items: center; gap: 0.25rem; }
.lang-btn { padding: 0.3rem 0.6rem; border-radius: 5px; color: rgba(255,255,255,0.65); font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: var(--transition); border: 1px solid transparent; }
.lang-btn:hover,.lang-btn.active { color: #fff; border-color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.1); }
.mobile-menu-btn { display: none; background: none; border: none; color: #fff; font-size: 1.4rem; cursor: pointer; padding: 0.25rem; line-height: 1; }
.mobile-inline-lang { display: none; align-items: center; gap: 0.15rem; }

/* ── Mobile drawer ── */
.mobile-nav-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 1098; backdrop-filter: blur(2px); opacity: 0; visibility: hidden; pointer-events: none; transition: opacity 0.3s ease, visibility 0.3s ease; }
.mobile-nav-backdrop.open { opacity: 1; visibility: visible; pointer-events: all; }
.mobile-nav { position: fixed; top: 0; right: 0; width: 340px; width: min(340px, 88vw); height: 100dvh; height: 100vh; background: var(--navy); z-index: 1099; overflow-y: auto; overscroll-behavior: contain; display: flex; flex-direction: column; transform: translateX(110%); transition: transform 0.35s cubic-bezier(0.4,0,0.2,1); box-shadow: -8px 0 32px rgba(0,0,0,0.4); will-change: transform; }
[dir="rtl"] .mobile-nav { right: auto; left: 0; transform: translateX(-110%); box-shadow: 8px 0 32px rgba(0,0,0,0.4); }
.mobile-nav.open { transform: translateX(0); }
[dir="rtl"] .mobile-nav.open { transform: translateX(0); }

.mobile-nav-header { display: flex; align-items: center; justify-content: space-between; padding: 1.1rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.08); flex-shrink: 0; }
.mobile-nav-close { background: rgba(255,255,255,0.08); border: none; color: rgba(255,255,255,0.7); width: 36px; height: 36px; border-radius: 8px; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: var(--transition); flex-shrink: 0; }
.mobile-nav-close:hover { background: rgba(255,255,255,0.15); color: #fff; }

.mobile-nav-body { flex: 1; overflow-y: auto; padding: 0.5rem 0 1rem; }
.mobile-nav-links { list-style: none; margin: 0; padding: 0; }
.mobile-nav-item { border-bottom: 1px solid rgba(255,255,255,0.06); }
.mobile-nav-item:last-child { border-bottom: none; }
.mobile-nav-link { display: flex; align-items: center; gap: 0.85rem; padding: 0.9rem 1.25rem; color: rgba(255,255,255,0.82); font-size: 0.95rem; font-weight: 500; width: 100%; background: none; border: none; text-align: start; cursor: pointer; text-decoration: none; transition: var(--transition); }
.mobile-nav-link:hover, .mobile-nav-link.active { color: #fff; background: rgba(255,255,255,0.05); }
.mobile-nav-link.active { color: var(--cyan); }
.mobile-nav-link i.icon { width: 22px; text-align: center; color: var(--cyan); font-size: 0.9rem; flex-shrink: 0; }
.mobile-nav-link .caret { margin-inline-start: auto; font-size: 0.7rem; color: rgba(255,255,255,0.4); transition: transform 0.25s ease; }
.mobile-nav-link.sub-open .caret { transform: rotate(180deg); }

/* Services submenu */
.mobile-sub-menu { list-style: none; margin: 0; padding: 0; max-height: 0; overflow: hidden; transition: max-height 0.35s ease; background: rgba(0,0,0,0.2); }
.mobile-sub-menu.open { max-height: 600px; }
.mobile-sub-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 1.25rem 0.7rem 3rem; color: rgba(255,255,255,0.65); font-size: 0.875rem; text-decoration: none; transition: var(--transition); border-bottom: 1px solid rgba(255,255,255,0.04); }
[dir="rtl"] .mobile-sub-link { padding: 0.7rem 3rem 0.7rem 1.25rem; }
.mobile-sub-link:last-child { border-bottom: none; }
.mobile-sub-link:hover { color: var(--cyan); background: rgba(255,255,255,0.04); padding-inline-start: 3.3rem; }
.mobile-sub-link i { width: 18px; text-align: center; color: var(--cyan); font-size: 0.8rem; flex-shrink: 0; }

/* Lang + footer area */
.mobile-nav-footer { padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,0.08); flex-shrink: 0; }
.mobile-lang { display: flex; gap: 0.5rem; margin-bottom: 1rem; }
.mobile-lang a { flex: 1; text-align: center; padding: 0.45rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.6); font-size: 0.8rem; font-weight: 600; transition: var(--transition); }
.mobile-lang a.active, .mobile-lang a:hover { background: var(--blue); border-color: var(--blue); color: #fff; }

/* ===== SLIDER ===== */
/* RTL fix: force physical LTR layout on the track so translateX always works correctly */
[dir="rtl"] .slider-track { direction: ltr; }
[dir="rtl"] .slider-content { direction: rtl; }
.hero-slider { position: relative; height: 100vh; min-height: 580px; max-height: 900px; overflow: hidden; }
@media (max-width: 768px) { .hero-slider { height: 85vh; min-height: 480px; } }
@media (max-width: 480px) { .hero-slider { height: 80vh; min-height: 420px; } }
.slider-track { display: flex; height: 100%; transition: transform 0.8s cubic-bezier(0.4,0,0.2,1); will-change: transform; }
.slider-slide { min-width: 100%; height: 100%; position: relative; flex-shrink: 0; }
.slider-bg { position: absolute; inset: 0; background-size: cover; background-position: center center; background-repeat: no-repeat; }
.slider-bg-fallback { background: var(--gradient-hero); }
.slider-overlay { position: absolute; inset: 0; }
.slider-content { position: absolute; inset: 0; display: flex; align-items: center; padding: 0 1.5rem; padding-top: 72px; }
.slider-content .container { width: 100%; }
.slider-text-left { text-align: left; }
.slider-text-center { text-align: center; }
.slider-text-right { text-align: right; }
[dir="rtl"] .slider-text-left { text-align: right; }
[dir="rtl"] .slider-text-right { text-align: left; }
.slide-badge { display: inline-block; background: rgba(0,180,216,0.2); border: 1px solid rgba(0,180,216,0.4); color: var(--cyan); padding: 0.35rem 1rem; border-radius: 50px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 1.2rem; }
.slide-title { font-size: clamp(2rem, 5.5vw, 4.5rem); font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 1.2rem; text-shadow: 0 2px 20px rgba(0,0,0,0.3); }
.slide-subtitle { font-size: clamp(1rem, 2vw, 1.25rem); color: rgba(255,255,255,0.85); max-width: 600px; line-height: 1.6; margin-bottom: 2rem; }
.slider-text-center .slide-subtitle { margin-left: auto; margin-right: auto; }
.slider-text-right .slide-subtitle { margin-left: auto; }
[dir="rtl"] .slider-text-left .slide-subtitle { margin-right: 0; margin-left: auto; }
.slide-actions { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
.slider-text-center .slide-actions { justify-content: center; }
.slider-text-right .slide-actions { justify-content: flex-end; }
[dir="rtl"] .slider-text-left .slide-actions { justify-content: flex-end; }
.slider-controls { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; align-items: center; gap: 0.5rem; z-index: 10; }
.slider-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,0.4); cursor: pointer; transition: var(--transition); border: none; padding: 0; }
.slider-dot.active { background: var(--cyan); width: 28px; border-radius: 5px; }
.slider-arrow { position: absolute; top: 50%; transform: translateY(-50%); width: 48px; height: 48px; background: rgba(255,255,255,0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; cursor: pointer; transition: var(--transition); z-index: 10; }
.slider-arrow:hover { background: var(--blue); border-color: var(--blue); }
.slider-arrow.prev { left: 1.5rem; }
.slider-arrow.next { right: 1.5rem; }
@media (max-width: 576px) { .slider-arrow { width: 38px; height: 38px; } .slider-arrow.prev { left: 0.75rem; } .slider-arrow.next { right: 0.75rem; } }
.slider-scrolldown { position: absolute; bottom: 2.5rem; right: 2.5rem; display: flex; flex-direction: column; align-items: center; gap: 0.4rem; cursor: pointer; animation: bounce 2s infinite; }
.slider-scrolldown span { font-size: 0.7rem; color: rgba(255,255,255,0.6); letter-spacing: 0.1em; text-transform: uppercase; }
@keyframes bounce { 0%,100%{transform:translateY(0)}50%{transform:translateY(6px)} }
.page-hero { position: relative; min-height: 400px; overflow: hidden; display: flex; align-items: flex-end; padding-bottom: 3rem; }
@media (max-width: 768px) { .page-hero { min-height: 300px; padding-bottom: 2rem; } }
.page-hero-bg { position: absolute; inset: 0; background-size: cover; background-position: center; }
.page-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(10,22,40,0.6), rgba(10,22,40,0.85)); }
.page-hero-content { position: relative; z-index: 1; padding-top: 120px; }
.page-hero-title { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; color: #fff; }
.page-hero-sub { color: rgba(255,255,255,0.75); font-size: 1.1rem; }
.breadcrumb-sth { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
.breadcrumb-sth a { color: rgba(255,255,255,0.6); font-size: 0.85rem; }
.breadcrumb-sth a:hover { color: var(--cyan); }
.breadcrumb-sth span { color: rgba(255,255,255,0.4); font-size: 0.85rem; }
.breadcrumb-sth .current { color: var(--cyan); font-size: 0.85rem; }

/* ===== SERVICES ===== */
.service-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 2rem; transition: var(--transition); height: 100%; display: flex; flex-direction: column; }
.service-card:hover { border-color: var(--blue); box-shadow: var(--shadow-lg); transform: translateY(-4px); }
.service-icon { width: 60px; height: 60px; background: linear-gradient(135deg, rgba(21,101,192,0.1), rgba(0,180,216,0.1)); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--blue); margin-bottom: 1.25rem; }
.service-card h5 { font-weight: 700; color: var(--text-dark); font-size: 1.1rem; margin-bottom: 0.75rem; }
.service-card p { color: var(--text-muted); font-size: 0.9rem; line-height: 1.6; flex: 1; }
.service-card .learn-more { color: var(--blue); font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-top: 1.25rem; }
.service-card:hover .learn-more { gap: 0.7rem; }

/* ===== STATS ===== */
.stats-section { background: var(--gradient-hero); padding: 70px 0; }
.stat-item { text-align: center; padding: 1.5rem; }
.stat-number { font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 900; color: #fff; line-height: 1; margin-bottom: 0.5rem; }
.stat-label { font-size: 0.95rem; color: rgba(255,255,255,0.75); font-weight: 500; }
.stat-icon-wrap { width: 56px; height: 56px; background: rgba(255,255,255,0.12); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: var(--cyan); margin: 0 auto 1rem; }

/* ===== PROJECTS ===== */
.project-card { position: relative; border-radius: 16px; overflow: hidden; height: 280px; cursor: pointer; }
.project-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.project-card:hover img { transform: scale(1.05); }
.project-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,22,40,0.95) 0%, rgba(10,22,40,0.3) 60%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; opacity: 0.9; transition: var(--transition); }
.project-card:hover .project-card-overlay { opacity: 1; }
.project-card-placeholder { position: absolute; inset: 0; background: var(--gradient-card); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: rgba(255,255,255,0.3); }
.project-badge { display: inline-block; padding: 0.25rem 0.75rem; background: var(--cyan); color: var(--navy); border-radius: 50px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem; }
.project-title { color: #fff; font-weight: 700; font-size: 1rem; margin-bottom: 0.25rem; }
.project-client { color: rgba(255,255,255,0.65); font-size: 0.82rem; }

/* ===== TESTIMONIALS ===== */
.testimonial-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 2rem; height: 100%; position: relative; }
.testimonial-card::before { content: '"'; font-size: 4rem; color: var(--blue); opacity: 0.15; position: absolute; top: 1rem; left: 1.5rem; line-height: 1; font-family: Georgia, serif; }
[dir="rtl"] .testimonial-card::before { left: auto; right: 1.5rem; }
.testimonial-text { color: var(--text-body); font-size: 0.95rem; line-height: 1.7; font-style: italic; margin-bottom: 1.5rem; position: relative; z-index: 1; }
.testimonial-author { display: flex; align-items: center; gap: 0.75rem; }
.testimonial-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--gradient-card); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1rem; flex-shrink: 0; overflow: hidden; }
.testimonial-avatar img { width: 100%; height: 100%; object-fit: cover; }
.testimonial-name { font-weight: 700; color: var(--text-dark); font-size: 0.9rem; }
.testimonial-pos { color: var(--text-muted); font-size: 0.8rem; }
.stars { color: var(--gold); font-size: 0.8rem; }

/* ===== TEAM ===== */
.team-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); text-align: center; }
.team-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
.team-photo { width: 100%; height: 220px; object-fit: cover; background: var(--gradient-card); display: flex; align-items: center; justify-content: center; }
.team-photo-placeholder { height: 220px; background: var(--gradient-card); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: rgba(255,255,255,0.4); }
.team-info { padding: 1.5rem; }
.team-name { font-weight: 700; color: var(--text-dark); font-size: 1rem; }
.team-position { color: var(--blue); font-size: 0.85rem; font-weight: 500; }
.team-social { display: flex; justify-content: center; gap: 0.5rem; margin-top: 0.75rem; }
.team-social a { width: 30px; height: 30px; background: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.75rem; transition: var(--transition); }
.team-social a:hover { background: var(--blue); color: #fff; }

/* ===== BLOG ===== */
.blog-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.07); transition: var(--transition); height: 100%; display: flex; flex-direction: column; }
.blog-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.blog-img { height: 200px; overflow: hidden; background: var(--gradient-card); display: flex; align-items: center; justify-content: center; }
.blog-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
.blog-card:hover .blog-img img { transform: scale(1.05); }
.blog-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
.blog-category { font-size: 0.75rem; font-weight: 700; color: var(--blue); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
.blog-title { font-weight: 700; color: var(--text-dark); font-size: 1rem; line-height: 1.4; margin-bottom: 0.75rem; flex: 1; }
.blog-meta { color: var(--text-muted); font-size: 0.8rem; display: flex; gap: 1rem; flex-wrap: wrap; }

/* ===== CTA ===== */
.cta-section { background: linear-gradient(135deg, var(--navy) 0%, #1565C0 100%); padding: 80px 0; position: relative; overflow: hidden; }
.cta-section::before { content: ''; position: absolute; top: -50%; right: -10%; width: 400px; height: 400px; background: rgba(0,180,216,0.1); border-radius: 50%; }
.cta-title { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; color: #fff; margin-bottom: 1rem; }
.cta-text { color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-bottom: 0; }

/* ===== FAQ ===== */
.faq-item { border: 1px solid var(--border); border-radius: 12px; margin-bottom: 0.75rem; overflow: hidden; }
.faq-question { padding: 1.1rem 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: var(--text-dark); background: #fff; transition: var(--transition); }
.faq-question:hover { background: var(--light-bg); }
.faq-answer { padding: 0 1.5rem; max-height: 0; overflow: hidden; transition: max-height 0.35s ease, padding 0.35s ease; background: var(--light-bg); }
.faq-answer.open { max-height: 300px; padding: 1rem 1.5rem; }
.faq-icon { transition: transform 0.3s ease; flex-shrink: 0; color: var(--blue); }
.faq-item.open .faq-icon { transform: rotate(180deg); }

/* ===== CONTACT FORM ===== */
.contact-form-wrap { background: #fff; border-radius: 20px; padding: 2.5rem; box-shadow: var(--shadow-lg); }
.contact-info-item { display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
.contact-icon { width: 44px; height: 44px; background: linear-gradient(135deg, rgba(21,101,192,0.1), rgba(0,180,216,0.1)); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--blue); font-size: 1rem; flex-shrink: 0; }
.form-control-sth { width: 100%; padding: 0.8rem 1rem; border: 1.5px solid var(--border); border-radius: 10px; font-family: inherit; font-size: 0.95rem; color: var(--text-dark); background: #fff; transition: var(--transition); outline: none; }
.form-control-sth:focus { border-color: var(--blue); box-shadow: 0 0 0 4px rgba(21,101,192,0.08); }

/* ===== FOOTER ===== */
.footer { background: var(--navy); color: rgba(255,255,255,0.75); }
.footer-top { padding: 60px 0 40px; }
.footer-brand-name { font-size: 1.5rem; font-weight: 800; color: #fff; }
.footer-brand-sub { font-size: 0.8rem; color: rgba(255,255,255,0.5); }
.footer-desc { font-size: 0.875rem; line-height: 1.7; color: rgba(255,255,255,0.6); margin-top: 0.75rem; }
.footer-title { color: #fff; font-weight: 700; font-size: 0.95rem; margin-bottom: 1.25rem; }
.footer-links { list-style: none; }
.footer-links li { margin-bottom: 0.6rem; }
.footer-links li a { color: rgba(255,255,255,0.6); font-size: 0.875rem; transition: var(--transition); display: flex; align-items: center; gap: 0.4rem; }
.footer-links li a:hover { color: var(--cyan); padding-left: 0.3rem; }
[dir="rtl"] .footer-links li a:hover { padding-left: 0; padding-right: 0.3rem; }
.footer-contact-item { display: flex; gap: 0.75rem; align-items: flex-start; color: rgba(255,255,255,0.6); font-size: 0.875rem; margin-bottom: 0.75rem; }
.footer-contact-item i { color: var(--cyan); margin-top: 0.1rem; flex-shrink: 0; }
.footer-social { display: flex; gap: 0.5rem; margin-top: 1rem; flex-wrap: wrap; }
.footer-social a { width: 36px; height: 36px; background: rgba(255,255,255,0.08); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.65); font-size: 0.85rem; transition: var(--transition); }
.footer-social a:hover { background: var(--blue); color: #fff; transform: translateY(-2px); }
.footer-divider { border-color: rgba(255,255,255,0.08); }
.footer-bottom { padding: 1.25rem 0; font-size: 0.82rem; color: rgba(255,255,255,0.45); display: flex; align-items: center; justify-content: space-between; flex-wrap: gap-1rem; }
.footer-bottom a { color: rgba(255,255,255,0.5); }
.footer-bottom a:hover { color: var(--cyan); }

/* ===== MISC ===== */
.about-img-wrap { position: relative; }
.about-img { border-radius: 20px; width: 100%; height: 460px; object-fit: cover; box-shadow: var(--shadow-lg); }
.about-badge { position: absolute; bottom: -1.5rem; left: -1.5rem; background: var(--blue); color: #fff; border-radius: 16px; padding: 1.2rem 1.5rem; box-shadow: var(--shadow-lg); }
[dir="rtl"] .about-badge { left: auto; right: -1.5rem; }
.about-badge .big { font-size: 2rem; font-weight: 900; display: block; line-height: 1; }
.about-badge .small { font-size: 0.78rem; opacity: 0.85; }
.highlight-block { background: #fff; border-left: 4px solid var(--blue); border-radius: 0 12px 12px 0; padding: 1rem 1.25rem; }
[dir="rtl"] .highlight-block { border-left: none; border-right: 4px solid var(--blue); border-radius: 12px 0 0 12px; }
.back-to-top { position: fixed; bottom: 2rem; right: 2rem; width: 44px; height: 44px; background: var(--blue); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-lg); cursor: pointer; transition: var(--transition); opacity: 0; pointer-events: none; z-index: 500; border: none; }
[dir="rtl"] .back-to-top { right: auto; left: 2rem; }
.back-to-top.visible { opacity: 1; pointer-events: all; }
.back-to-top:hover { background: var(--navy); transform: translateY(-3px); }
.page-loader { position: fixed; inset: 0; background: var(--navy); z-index: 9999; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1.25rem; transition: opacity 0.5s ease; }
.page-loader.hidden { opacity: 0; pointer-events: none; }
.loader-wrap { position: relative; display: flex; align-items: center; justify-content: center; width: 120px; height: 120px; }
.loader-spinner { position: absolute; inset: 0; border-radius: 50%; border: 3px solid rgba(255,255,255,0.1); border-top-color: var(--cyan); animation: spin 0.85s linear infinite; }
.loader-spinner::after { content: ''; position: absolute; inset: 7px; border-radius: 50%; border: 2px solid transparent; border-bottom-color: rgba(255,183,3,0.4); animation: spin 1.4s linear infinite reverse; }
.loader-img { max-height: 70px; max-width: 88px; object-fit: contain; position: relative; z-index: 1; }
.loader-logo { font-size: 1.75rem; font-weight: 900; color: #fff; position: relative; z-index: 1; }
.loader-tagline { font-size: 0.7rem; font-weight: 500; color: rgba(255,255,255,0.35); letter-spacing: 0.18em; text-transform: uppercase; }
@keyframes spin { to { transform: rotate(360deg); } }
@keyframes pulse { 0%,100%{opacity:1}50%{opacity:0.5} }
.section-divider { height: 1px; background: var(--border); margin: 0; }
.bg-light-sth { background: var(--light-bg); }
.bg-light-sth2 { background: var(--light-bg2); }
.text-blue { color: var(--blue) !important; }
.text-cyan { color: var(--cyan) !important; }
@media (max-width: 991.98px) {
    .mobile-menu-btn { display: block; }
    .nav-links, .nav-actions { display: none; }
    .mobile-inline-lang { display: flex; }
    .navbar-sth { background: rgba(10,22,40,0.96) !important; backdrop-filter: blur(12px); box-shadow: 0 2px 16px rgba(0,0,0,0.25); }
}
@media (max-width: 576px) { .section-pad { padding: 50px 0; } .slide-title { font-size: clamp(1.6rem,7vw,2.5rem); } .contact-form-wrap { padding: 1.5rem; } .slider-scrolldown { display: none; } }
@media (max-width: 767px) { .about-badge { left: 0.75rem; bottom: -1rem; } [dir="rtl"] .about-badge { left: auto; right: 0.75rem; } }
</style>
@php
    $dynPrimary  = \App\Models\Setting::get('public_primary');
    $dynAccent   = \App\Models\Setting::get('public_accent');
    $dynPublicBg = \App\Models\Setting::get('public_bg');
@endphp
@if($dynPrimary || $dynAccent || $dynPublicBg)
<style>
:root {
    @if($dynPublicBg)
    --navy: {{ $dynPublicBg }};
    --navy-light: color-mix(in srgb, {{ $dynPublicBg }} 80%, {{ $dynPrimary ?? '#1565C0' }});
    @endif
    @if($dynPrimary)
    --blue: {{ $dynPrimary }};
    --blue-bright: {{ $dynPrimary }};
    @endif
    @if($dynAccent)
    --cyan: {{ $dynAccent }};
    --cyan-light: color-mix(in srgb, {{ $dynAccent }} 45%, #fff);
    @endif
    @if($dynPublicBg || $dynPrimary)
    --gradient-hero: linear-gradient(135deg, {{ $dynPublicBg ?? '#0A1628' }} 0%, {{ $dynPrimary ?? '#1565C0' }} 100%);
    --gradient-card: linear-gradient(135deg, {{ $dynPublicBg ?? '#0D1F3C' }}, {{ $dynPrimary ?? '#1565C0' }});
    @endif
}
</style>
@endif
    @stack('styles')
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0A1628">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="STH">
    <link rel="apple-touch-icon" href="/pwa/icons/ios/180.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/pwa/icons/ios/152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="/pwa/icons/ios/167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/pwa/icons/ios/180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/pwa/icons/ios/32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/pwa/icons/ios/16.png">
</head>
<body>

@php
    $siteLogo = \App\Models\Setting::get('site_logo');
    $siteName = \App\Models\Setting::get('site_name', 'STH');
@endphp

<!-- Page Loader -->
<div class="page-loader" id="pageLoader">
    <div class="loader-wrap">
        <div class="loader-spinner"></div>
        @if($siteLogo)
            <img src="{{ asset('storage/'.$siteLogo) }}" alt="{{ $siteName }}" class="loader-img">
        @else
            <div class="loader-logo">{{ strtoupper(substr($siteName,0,1)) }}</div>
        @endif
    </div>
    <div class="loader-tagline">{{ $siteName }}</div>
</div>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>

<!-- Navbar -->
<nav class="navbar-sth" id="navbar" style="background: transparent;">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand-sth">
            @if($siteLogo)
                <img src="{{ asset('storage/'.$siteLogo) }}" alt="{{ $siteName }}" style="height:40px;max-width:150px;object-fit:contain;">
            @else
                <div class="navbar-brand-icon">{{ strtoupper(substr($siteName,0,1)) }}</div>
                {{ $siteName }}
            @endif
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('messages.nav_about') }}</a></li>
            <li class="nav-dropdown">
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services*') ? 'active' : '' }}">
                    {{ __('messages.nav_services') }} <i class="fas fa-chevron-down" style="font-size:0.65rem;"></i>
                </a>
                <div class="nav-dropdown-menu">
                    @foreach(\App\Models\Service::root()->active()->where('show_in_nav',true)->orderBy('order')->get() as $svc)
                    <a href="{{ route('services.show', $svc->slug) }}">
                        <i class="{{ $svc->icon }}"></i> {{ $svc->name }}
                    </a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio*') ? 'active' : '' }}">{{ __('messages.nav_portfolio') }}</a></li>
            <li><a href="{{ route('highlights') }}" class="{{ request()->routeIs('highlights') ? 'active' : '' }}">{{ __('messages.nav_highlights') }}</a></li>
            <li><a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'active' : '' }}">{{ __('messages.nav_team') }}</a></li>
            <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">{{ __('messages.nav_blog') }}</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('messages.nav_contact') }}</a></li>
        </ul>
        <div class="nav-actions">
            <div class="lang-switcher">
                <a href="{{ route('lang.switch','en') }}" class="lang-btn {{ app()->getLocale()=='en' ? 'active':'' }}">EN</a>
                <a href="{{ route('lang.switch','fr') }}" class="lang-btn {{ app()->getLocale()=='fr' ? 'active':'' }}">FR</a>
                <a href="{{ route('lang.switch','ar') }}" class="lang-btn {{ app()->getLocale()=='ar' ? 'active':'' }}">AR</a>
            </div>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-primary-sth" style="font-size:0.82rem;padding:0.5rem 1rem;">Admin</a>
            @else
                <a href="{{ route('login') }}" class="btn-outline-white" style="font-size:0.82rem;padding:0.45rem 1.1rem;border-width:1.5px;">{{ __('messages.login') }}</a>
            @endauth
        </div>
        <div class="mobile-inline-lang">
            <a href="{{ route('lang.switch','en') }}" class="lang-btn {{ app()->getLocale()=='en' ? 'active':'' }}">EN</a>
            <a href="{{ route('lang.switch','fr') }}" class="lang-btn {{ app()->getLocale()=='fr' ? 'active':'' }}">FR</a>
            <a href="{{ route('lang.switch','ar') }}" class="lang-btn {{ app()->getLocale()=='ar' ? 'active':'' }}">AR</a>
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu"><i class="fas fa-bars"></i></button>
    </div>
</nav>

<!-- Mobile Nav Backdrop -->
<div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>

<!-- Mobile Nav Drawer -->
<div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-header">
        @if($siteLogo)
            <img src="{{ asset('storage/'.$siteLogo) }}" alt="{{ $siteName }}" style="height:36px;max-width:130px;object-fit:contain;">
        @else
            <span style="font-size:1.4rem;font-weight:800;color:#fff;">{{ $siteName }}</span>
        @endif
        <button class="mobile-nav-close" id="closeMobileNav" aria-label="Close menu"><i class="fas fa-times"></i></button>
    </div>
    <div class="mobile-nav-body">
        <ul class="mobile-nav-links">
            <li class="mobile-nav-item">
                <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home icon"></i>{{ __('messages.nav_home') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    <i class="fas fa-info-circle icon"></i>{{ __('messages.nav_about') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <button class="mobile-nav-link {{ request()->routeIs('services*') ? 'active sub-open' : '' }}" id="mobileServicesToggle" type="button">
                    <i class="fas fa-cogs icon"></i>
                    <span>{{ __('messages.nav_services') }}</span>
                    <i class="fas fa-chevron-down caret"></i>
                </button>
                <ul class="mobile-sub-menu {{ request()->routeIs('services*') ? 'open' : '' }}" id="mobileServicesMenu">
                    <li><a href="{{ route('services') }}" class="mobile-sub-link"><i class="fas fa-th-list"></i>{{ __('messages.view_all') }}</a></li>
                    @foreach(\App\Models\Service::root()->active()->where('show_in_nav',true)->orderBy('order')->take(8)->get() as $svc)
                    <li><a href="{{ route('services.show', $svc->slug) }}" class="mobile-sub-link">
                        <i class="{{ $svc->icon }}"></i>{{ $svc->name }}
                    </a></li>
                    @endforeach
                </ul>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('portfolio') }}" class="mobile-nav-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase icon"></i>{{ __('messages.nav_portfolio') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('highlights') }}" class="mobile-nav-link {{ request()->routeIs('highlights') ? 'active' : '' }}">
                    <i class="fas fa-star icon"></i>{{ __('messages.nav_highlights') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('team') }}" class="mobile-nav-link {{ request()->routeIs('team') ? 'active' : '' }}">
                    <i class="fas fa-users icon"></i>{{ __('messages.nav_team') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('blog') }}" class="mobile-nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper icon"></i>{{ __('messages.nav_blog') }}
                </a>
            </li>
            <li class="mobile-nav-item">
                <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <i class="fas fa-envelope icon"></i>{{ __('messages.nav_contact') }}
                </a>
            </li>
            @auth
            <li class="mobile-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">
                    <i class="fas fa-tachometer-alt icon"></i>Admin
                </a>
            </li>
            @else
            <li class="mobile-nav-item">
                <a href="{{ route('login') }}" class="mobile-nav-link">
                    <i class="fas fa-sign-in-alt icon"></i>{{ __('messages.login') }}
                </a>
            </li>
            @endauth
        </ul>
    </div>
    <div class="mobile-nav-footer">
        <div class="mobile-lang">
            <a href="{{ route('lang.switch','en') }}" class="{{ app()->getLocale()=='en' ? 'active':'' }}">EN</a>
            <a href="{{ route('lang.switch','fr') }}" class="{{ app()->getLocale()=='fr' ? 'active':'' }}">FR</a>
            <a href="{{ route('lang.switch','ar') }}" class="{{ app()->getLocale()=='ar' ? 'active':'' }}">AR</a>
        </div>
        <div style="text-align:center;font-size:0.75rem;color:rgba(255,255,255,0.35);">&copy; {{ date('Y') }} STH — System Technologie Hanana</div>
    </div>
</div>

@yield('content')

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    @if($siteLogo)
                        <img src="{{ asset('storage/'.$siteLogo) }}" alt="{{ $siteName }}" style="max-height:55px;max-width:180px;object-fit:contain;margin-bottom:0.5rem;">
                    @else
                        <div class="footer-brand-name">{{ $siteName }}</div>
                    @endif
                    <div class="footer-brand-sub">System Technologie Hanana</div>
                    <p class="footer-desc">{{ \App\Models\Setting::get('about_short','Leading IT company in N\'Djamena, Chad.') }}</p>
                    <div class="footer-social">
                        @php $fb=\App\Models\Setting::get('facebook'); $li=\App\Models\Setting::get('linkedin'); $tw=\App\Models\Setting::get('twitter'); $ig=\App\Models\Setting::get('instagram'); @endphp
                        @if($fb)<a href="{{ $fb }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>@endif
                        @if($li)<a href="{{ $li }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>@endif
                        @if($tw)<a href="{{ $tw }}" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>@endif
                        @if($ig)<a href="{{ $ig }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>@endif
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h6 class="footer-title">{{ __('messages.nav_services') }}</h6>
                    <ul class="footer-links">
                        @foreach(\App\Models\Service::root()->active()->orderBy('order')->take(6)->get() as $svc)
                        <li><a href="{{ route('services.show',$svc->slug) }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ $svc->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h6 class="footer-title">{{ __('messages.company_footer') }}</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_about') }}</a></li>
                        <li><a href="{{ route('team') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_team') }}</a></li>
                        <li><a href="{{ route('portfolio') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_portfolio') }}</a></li>
                        <li><a href="{{ route('highlights') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_highlights') }}</a></li>
                        <li><a href="{{ route('blog') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_blog') }}</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right" style="font-size:0.65rem;"></i>{{ __('messages.nav_contact') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-title">{{ __('messages.address') }}</h6>
                    <div class="footer-contact-item"><i class="fas fa-map-marker-alt"></i><span>{{ \App\Models\Setting::get('site_address','Avenue Charles de Gaulle') }}, {{ \App\Models\Setting::get('site_city',"N'Djamena") }}, {{ \App\Models\Setting::get('site_country','Chad') }}</span></div>
                    <div class="footer-contact-item"><i class="fas fa-phone"></i><span dir="ltr">{{ \App\Models\Setting::get('site_phone','+235 60 83 79 79') }}</span></div>
                    @if(\App\Models\Setting::get('site_phone2'))<div class="footer-contact-item"><i class="fas fa-phone"></i><span dir="ltr">{{ \App\Models\Setting::get('site_phone2') }}</span></div>@endif
                    <div class="footer-contact-item"><i class="fas fa-envelope"></i><span>{{ \App\Models\Setting::get('site_email','contact@sth-tchad.com') }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <hr class="footer-divider">
    <div class="container">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} STH — System Technologie Hanana. {{ __('messages.rights') }}</span>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('privacy') }}">{{ __('messages.privacy') }}</a>
                <a href="{{ route('terms') }}">{{ __('messages.terms') }}</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
// Page loader
window.addEventListener('load',() => { setTimeout(()=>{ document.getElementById('pageLoader').classList.add('hidden'); },300); });

// Navbar scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 30);
    document.getElementById('backToTop').classList.toggle('visible', window.scrollY > 300);
});
if (window.scrollY > 30) navbar.classList.add('scrolled');

// Back to top
document.getElementById('backToTop').addEventListener('click', () => window.scrollTo({top:0,behavior:'smooth'}));

// Mobile nav drawer
(function() {
    const nav = document.getElementById('mobileNav');
    const backdrop = document.getElementById('mobileNavBackdrop');
    let scrollY = 0;
    const open = () => {
        scrollY = window.scrollY;
        document.body.style.top = '-' + scrollY + 'px';
        document.body.style.position = 'fixed';
        document.body.style.width = '100%';
        nav.classList.add('open');
        backdrop.classList.add('open');
    };
    const close = () => {
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, scrollY);
        nav.classList.remove('open');
        backdrop.classList.remove('open');
    };
    document.getElementById('mobileMenuBtn').addEventListener('click', open);
    document.getElementById('closeMobileNav').addEventListener('click', close);
    backdrop.addEventListener('click', close);
    // Services submenu accordion
    const toggle = document.getElementById('mobileServicesToggle');
    const menu = document.getElementById('mobileServicesMenu');
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const isOpen = menu.classList.contains('open');
            menu.classList.toggle('open', !isOpen);
            toggle.classList.toggle('sub-open', !isOpen);
        });
    }
    // Close drawer on nav link click (not accordion toggle)
    nav.querySelectorAll('a.mobile-nav-link, a.mobile-sub-link').forEach(link => {
        link.addEventListener('click', close);
    });
})();

// AOS
AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true, offset: 60 });

// FAQ
document.querySelectorAll('.faq-question').forEach(q => {
    q.addEventListener('click', () => {
        const item = q.parentElement;
        const answer = item.querySelector('.faq-answer');
        const isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(i => { i.classList.remove('open'); i.querySelector('.faq-answer').classList.remove('open'); });
        if (!isOpen) { item.classList.add('open'); answer.classList.add('open'); }
    });
});

// Slider
function initSlider(sliderEl) {
    if (!sliderEl) return;
    const track = sliderEl.querySelector('.slider-track');
    if (!track) return;
    const slides = track.querySelectorAll('.slider-slide');
    const dots = sliderEl.querySelectorAll('.slider-dot');
    if (slides.length <= 1) { sliderEl.querySelector('.slider-controls')?.remove(); sliderEl.querySelectorAll('.slider-arrow').forEach(a=>a.remove()); return; }
    let current = 0, timer;
    const go = (idx) => {
        current = (idx + slides.length) % slides.length;
        track.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((d,i) => d.classList.toggle('active', i === current));
    };
    const next = () => go(current + 1);
    const startAuto = () => { clearInterval(timer); timer = setInterval(next, 5500); };
    sliderEl.querySelector('.slider-arrow.prev')?.addEventListener('click', () => { go(current - 1); startAuto(); });
    sliderEl.querySelector('.slider-arrow.next')?.addEventListener('click', () => { go(current + 1); startAuto(); });
    dots.forEach((d, i) => d.addEventListener('click', () => { go(i); startAuto(); }));
    // Touch swipe
    let touchX = 0;
    sliderEl.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; }, {passive:true});
    sliderEl.addEventListener('touchend', e => { const diff = touchX - e.changedTouches[0].clientX; if (Math.abs(diff) > 50) { go(diff > 0 ? current + 1 : current - 1); startAuto(); } });
    go(0); startAuto();
}
document.querySelectorAll('.hero-slider, .page-hero-slider').forEach(initSlider);

// Counter animation
function animateCounters() {
    document.querySelectorAll('.counter').forEach(el => {
        const target = parseFloat(el.dataset.target);
        const suffix = el.dataset.suffix || '';
        const isFloat = el.dataset.float;
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        const update = () => {
            current = Math.min(current + step, target);
            el.textContent = (isFloat ? current.toFixed(1) : Math.floor(current)) + suffix;
            if (current < target) requestAnimationFrame(update);
        };
        update();
    });
}
const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { animateCounters(); counterObserver.disconnect(); } });
}, {threshold: 0.3});
const statsSection = document.querySelector('.stats-section');
if (statsSection) counterObserver.observe(statsSection);
</script>
@stack('scripts')

<!-- PWA Install Banner -->
<div id="pwa-install-banner" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:9999;background:linear-gradient(135deg,#0A1628,#1565C0);color:#fff;padding:1rem 1.25rem;box-shadow:0 -4px 24px rgba(0,0,0,0.35);align-items:center;gap:1rem;flex-wrap:wrap;">
    <img src="/pwa/icons/android/launchericon-48x48.png?v=2" alt="STH" style="width:40px;height:40px;border-radius:10px;flex-shrink:0;">
    <div style="flex:1;min-width:0;">
        <div style="font-weight:700;font-size:0.95rem;">Install STH App</div>
        <div style="font-size:0.8rem;opacity:0.8;">Fast access, works offline</div>
    </div>
    <div style="display:flex;gap:0.5rem;flex-shrink:0;">
        <button id="pwa-install-btn" style="background:#fff;color:#0A1628;border:none;padding:0.45rem 1.2rem;border-radius:6px;font-weight:700;font-size:0.88rem;cursor:pointer;">Install</button>
        <button id="pwa-dismiss-btn" style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 0.9rem;border-radius:6px;font-size:0.88rem;cursor:pointer;">Not now</button>
    </div>
</div>

<script>
(function () {
    var banner  = document.getElementById('pwa-install-banner');
    var btnInst = document.getElementById('pwa-install-btn');
    var btnDism = document.getElementById('pwa-dismiss-btn');
    var prompt  = null;
    var DISMISS_KEY = 'pwa_dismissed_until';

    function isDismissed() {
        var until = localStorage.getItem(DISMISS_KEY);
        return until && Date.now() < parseInt(until, 10);
    }

    function showBanner() {
        if (!isDismissed()) {
            banner.style.display = 'flex';
        }
    }

    window.addEventListener('beforeinstallprompt', function (e) {
        e.preventDefault();
        prompt = e;
        showBanner();
    });

    window.addEventListener('appinstalled', function () {
        prompt = null;
        banner.style.display = 'none';
        localStorage.removeItem(DISMISS_KEY);
    });

    btnInst.addEventListener('click', function () {
        banner.style.display = 'none';
        if (prompt) {
            prompt.prompt();
            prompt.userChoice.then(function (r) {
                if (r.outcome === 'accepted') localStorage.removeItem(DISMISS_KEY);
                prompt = null;
            });
        }
    });

    btnDism.addEventListener('click', function () {
        banner.style.display = 'none';
        // Re-show after 3 days
        localStorage.setItem(DISMISS_KEY, Date.now() + 3 * 24 * 60 * 60 * 1000);
    });

    // Register service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').catch(function () {});
    }
})();
</script>
</body>
</html>
