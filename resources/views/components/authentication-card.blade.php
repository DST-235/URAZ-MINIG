<style>
body { background: #0f172a !important; }
.auth-wrapper { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem 1rem; background: linear-gradient(135deg, #0A1628 0%, #0f172a 60%, #1565C020 100%); }
.auth-card { width: 100%; max-width: 440px; background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 2rem 2rem; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
.auth-card label { color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 500; }
.auth-card input[type="email"], .auth-card input[type="password"], .auth-card input[type="text"] { background: #334155 !important; border: 1px solid #475569 !important; color: #f1f5f9 !important; border-radius: 8px !important; width: 100%; padding: 0.6rem 0.85rem; font-size: 0.9rem; transition: border-color 0.2s; outline: none; }
.auth-card input:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59,130,246,0.15) !important; }
.auth-card input::placeholder { color: #64748b !important; }
.auth-card button[type="submit"] { background: #1565C0 !important; color: #fff !important; border: none !important; border-radius: 8px !important; padding: 0.7rem 1.5rem !important; font-weight: 600 !important; font-size: 0.9rem !important; cursor: pointer; transition: background 0.2s; }
.auth-card button[type="submit"]:hover { background: #1d4ed8 !important; }
.auth-card a { color: #60a5fa !important; font-size: 0.85rem; }
.auth-card a:hover { color: #93c5fd !important; }
.auth-card .text-gray-400, .auth-card .text-gray-500, .auth-card .text-gray-600 { color: #94a3b8 !important; }
.auth-card .text-red-600 { color: #f87171 !important; }
.auth-card .text-green-600 { color: #34d399 !important; }
.auth-card [x-data] label { color: #cbd5e1 !important; }
/* Checkbox */
.auth-card input[type="checkbox"] { accent-color: #1565C0; width: 16px; height: 16px; cursor: pointer; }
/* Dividers/borders inside card */
.auth-card hr { border-color: #334155; }
/* Fix Jetstream Tailwind utility overwrites */
.auth-card .bg-white { background: transparent !important; }
.auth-card .shadow, .auth-card .shadow-md { box-shadow: none !important; }
.auth-card .rounded-lg { border-radius: 0 !important; }
.auth-card .px-6 { padding-left: 0 !important; padding-right: 0 !important; }
.auth-card .py-4 { padding-top: 0 !important; padding-bottom: 0 !important; }
</style>

<div class="auth-wrapper">
    <div style="margin-bottom: 2rem;">
        {{ $logo }}
    </div>
    <div class="auth-card">
        {{ $slot }}
    </div>
    <p style="margin-top:1.5rem;color:#475569;font-size:0.78rem;">
        &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name','STH') }} — System Technologie Hanana
    </p>
</div>
