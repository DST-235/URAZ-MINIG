<?php
use Illuminate\Support\Facades\{Route, Artisan};
use App\Http\Controllers\{HomeController,ServiceController,ProjectController,BlogController,ContactController,PageController};
use App\Http\Controllers\Admin\{DashboardController,SliderController,ServiceController as AdminServiceController,ProjectController as AdminProjectController,TeamController,TestimonialController,StatController,BlogController as AdminBlogController,FaqController,ContactController as AdminContactController,SettingController,PageController as AdminPageController,UserController as AdminUserController};

// ── One-time setup route (migrate + seed) ────────────────────────────
// Usage: https://sth.soug.com.tr/setup/{SETUP_TOKEN}
// Add SETUP_TOKEN=your-secret-value to .env before first use.
Route::get('/setup/{token}', function (string $token) {
    $secret = env('SETUP_TOKEN');
    if (!$secret || $token !== $secret) {
        abort(404);
    }

    $results = [];

    foreach ([
        ['migrate',  ['--force' => true]],
        ['db:seed',  ['--force' => true]],
        ['storage:link', []],
    ] as [$cmd, $args]) {
        try {
            Artisan::call($cmd, $args);
            $results[] = ['cmd' => $cmd, 'ok' => true, 'out' => trim(Artisan::output())];
        } catch (\Throwable $e) {
            $results[] = ['cmd' => $cmd, 'ok' => false, 'out' => $e->getMessage()];
        }
    }

    $rows = '';
    foreach ($results as $r) {
        $icon  = $r['ok'] ? '✅' : '❌';
        $bg    = $r['ok'] ? '#d1fae5' : '#fee2e2';
        $color = $r['ok'] ? '#065f46' : '#991b1b';
        $out   = nl2br(htmlspecialchars($r['out']));
        $rows .= "<tr style='background:{$bg}'>
            <td style='padding:10px 14px;font-weight:700;color:{$color};white-space:nowrap;'>{$icon} php artisan {$r['cmd']}</td>
            <td style='padding:10px 14px;font-family:monospace;font-size:13px;color:#374151;'>{$out}</td>
        </tr>";
    }

    return response("<!DOCTYPE html><html><head><meta charset='utf-8'>
        <title>STH Setup</title>
        <style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:system-ui,sans-serif;background:#f1f5f9;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:2rem}
        .card{background:#fff;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,.1);overflow:hidden;max-width:800px;width:100%}
        .head{background:#1e293b;color:#fff;padding:1.25rem 1.5rem;font-size:1.1rem;font-weight:700;letter-spacing:.02em}
        table{width:100%;border-collapse:collapse}td{border-bottom:1px solid #e5e7eb;vertical-align:top}
        .foot{padding:1rem 1.5rem;font-size:.8rem;color:#64748b;background:#f8fafc;}</style>
    </head><body>
        <div class='card'>
            <div class='head'>🚀 STH Setup — " . config('app.url') . "</div>
            <table>{$rows}</table>
            <div class='foot'>Completed at " . now()->format('Y-m-d H:i:s T') . " &mdash; Remove or rotate <code>SETUP_TOKEN</code> in <code>.env</code> after setup.</div>
        </div>
    </body></html>");
})->name('setup');

// Jetstream dashboard redirect → admin
Route::get('/dashboard', fn() => redirect('/admin'))->middleware(['auth'])->name('dashboard');

// Language switcher
Route::get('/lang/{locale}', function(string $locale) {
    $supported = ['en','fr','ar'];
    if (in_array($locale, $supported)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return back();
})->name('lang.switch');

// Public routes
Route::middleware([])->group(function () {
    Route::get('/',            [HomeController::class,'index'])->name('home');
    Route::get('/about',       [PageController::class,'about'])->name('about');
    Route::get('/team',        [PageController::class,'team'])->name('team');
    Route::get('/highlights',  [PageController::class,'highlights'])->name('highlights');
    Route::get('/services',    [ServiceController::class,'index'])->name('services');
    Route::get('/services/{slug}', [ServiceController::class,'show'])->name('services.show');
    Route::get('/portfolio',   [ProjectController::class,'index'])->name('portfolio');
    Route::get('/portfolio/{project}', [ProjectController::class,'show'])->name('portfolio.show');
    Route::get('/blog',        [BlogController::class,'index'])->name('blog');
    Route::get('/blog/{slug}', [BlogController::class,'show'])->name('blog.show');
    Route::get('/contact',     [ContactController::class,'index'])->name('contact');
    Route::post('/contact',    [ContactController::class,'store'])->name('contact.store');
    Route::get('/privacy',     [PageController::class,'privacy'])->name('privacy');
    Route::get('/terms',       [PageController::class,'terms'])->name('terms');
});

// Admin routes
Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                        [DashboardController::class,'index'])->name('dashboard');
    Route::resource('sliders',             SliderController::class)->except(['show']);
    Route::resource('services',            AdminServiceController::class)->except(['show']);
    Route::resource('projects',            AdminProjectController::class)->except(['show']);
    Route::resource('team',                TeamController::class)->except(['show']);
    Route::resource('testimonials',        TestimonialController::class)->except(['show']);
    Route::resource('stats',               StatController::class)->except(['show']);
    Route::resource('blog',                AdminBlogController::class)->except(['show']);
    Route::resource('faqs',                FaqController::class)->except(['show']);
    Route::resource('pages',               AdminPageController::class)->only(['index','edit','update']);
    Route::get('contact',                  [AdminContactController::class,'index'])->name('contact.index');
    Route::get('contact/{contact}',        [AdminContactController::class,'show'])->name('contact.show');
    Route::delete('contact/{contact}',     [AdminContactController::class,'destroy'])->name('contact.destroy');
    Route::get('settings',                 [SettingController::class,'index'])->name('settings.index');
    Route::post('settings',                [SettingController::class,'update'])->name('settings.update');
    Route::resource('users',               AdminUserController::class)->except(['show']);
    Route::post('users/{user}/toggle-active', [AdminUserController::class,'toggleActive'])->name('users.toggle-active');
});
