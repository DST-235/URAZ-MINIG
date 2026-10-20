<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale {
    public function handle(Request $request, Closure $next): Response {
        $supported = array_keys(config('locales'));
        $locale = $request->segment(1);
        if (in_array($locale, $supported)) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        } elseif (session('locale') && in_array(session('locale'), $supported)) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale(config('app.locale','en'));
        }
        return $next($request);
    }
}
