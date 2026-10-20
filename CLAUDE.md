# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A Laravel 13 + Jetstream/Livewire marketing + admin CMS site for **Uraz Mining & Trading LTD**. It was bootstrapped as a copy of an existing codebase ("STH") and is being adapted: `Service`/`ServiceController` → `Product`/`ProductController` and `Project`/`ProjectController` → `Operation`/`OperationController` (models, controllers, migrations, routes, views and lang keys have all been renamed accordingly — if you find a stray reference to "service(s)" or "project(s)" outside of vendor/Laravel/Jetstream internals, it's leftover from that rename and should be updated to product/operation).

## Commands

```bash
composer run dev        # start php artisan serve + queue:listen + pail (logs) + vite, all concurrently
php artisan serve        # app server only
npm run dev               # vite dev server only

php artisan test                      # run full test suite (also: composer run test)
php artisan test --filter=TestName    # run a single test
php artisan test tests/Feature/AuthenticationTest.php

vendor/bin/pint            # format PHP (Laravel Pint)
vendor/bin/pint --test     # check formatting without modifying files

npm run build              # production frontend build (vite)

php artisan migrate                  # run migrations
php artisan db:seed                  # seed (UrazSeeder → site content, ImageSeeder → sample images)
php artisan migrate:fresh --seed     # reset DB and reseed

php artisan uraz:admin [email] [--name=Admin]   # create/reset the admin user; generates and prints a random password once (not stored)
```

Default local DB is SQLite. Tests run against an in-memory SQLite DB (`phpunit.xml`), with `array`/`sync` drivers for cache/session/queue.

## Architecture

**Public site vs admin CMS**, both served from the same Laravel app (`routes/web.php`):
- Public routes (home, products, operations, blog, team, contact, etc.) are unauthenticated and read-only.
- `/admin/*` routes require `auth` + `verified` and are built as classic Laravel resource controllers (`Route::resource(...)->except(['show'])`) — there's no separate `show` admin view, editing happens via the `edit`/`form` view.
- Jetstream's own `/dashboard` is redirected straight to `/admin`.

**Multi-language content** via `spatie/laravel-translatable`:
- Content models (`Product`, `Operation`, `BlogPost`, `TeamMember`, `Testimonial`, `Page`, `Faq`, ...) use the `HasTranslations` trait with a `$translatable` array of column names stored as JSON.
- Supported locales are defined centrally in `config/locales.php` (currently `en`, `fr`, `ar`, `tr`, `zh`), each with a native name, flag emoji, and text direction (`ar` is `rtl`).
- `App\Http\Middleware\SetLocale` resolves the active locale per request: URL's first path segment → session → `app.locale` fallback. `/lang/{locale}` is the switcher route.
- Admin forms collect one input per field per locale (`name_en`, `name_fr`, ...); controllers loop over `config('locales')` to validate and `setTranslation()` each one. The `lang-tabs` Blade component + matching JS renders/toggles these per-locale inputs in the admin forms.
- `Setting::get()` mirrors this pattern for the key/value `settings` table (JSON `value` column, resolved against current locale with `en` fallback).

**Admin CRUD controllers** (`app/Http/Controllers/Admin/*`) follow one repeated shape — worth knowing before adding a new resource rather than reading each one individually:
1. `index` lists ordered by `order`.
2. `store`/`update` share a private `validated()` (builds rules by looping locales) and `fill()` (applies scalar fields + translations) method.
3. Image fields go through `Controller::storeUpload()` / `deleteUpload()` (base `App\Http\Controllers\Controller`), which store to `storage/app/public/{folder}` and return the relative path for persistence.

**`Controller::storeUpload()` deliberately bypasses PHP's fileinfo/MIME detection**, trusting the client-supplied extension and request validation (`'image'` rule) instead — see the docblock in `app/Http/Controllers/Controller.php` before changing upload handling, since a naive "fix" to add MIME sniffing would deviate from the documented intent.

**One-time remote setup route**: `GET /setup/{token}` (in `routes/web.php`) runs `migrate --force`, `db:seed --force` and `storage:link` over HTTP, gated by a `SETUP_TOKEN` env value compared to the URL segment. It's meant to be removed/rotated after first deploy — don't treat it as a normal route to extend.

**Deployment**: pushes to `master` trigger `.github/workflows/deploy.yml`, which SSHes into a VPS, pulls, runs `composer install --no-dev`, migrates, and recaches config/routes/views. `.cpanel.yml` is an alternate cPanel-based deploy path (copy + migrate + clear caches) — the two are not both active in the same environment.
