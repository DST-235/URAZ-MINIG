<?php
namespace App\Http\Controllers;
use App\Models\{Page,Slider,TeamMember,Stat,Testimonial,Faq};

class PageController extends Controller {
    public function about() {
        return view('public.about', [
            'sliders'  => Slider::forPage('about'),
            'page'     => Page::findBySlug('about'),
            'team'     => TeamMember::active()->take(8)->get(),
            'stats'    => Stat::active()->get(),
            'faqs'     => Faq::active()->where('page_key','about')->take(8)->get(),
        ]);
    }
    public function team() {
        return view('public.team', [
            'sliders' => Slider::forPage('team'),
            'members' => TeamMember::active()->get(),
        ]);
    }
    public function highlights() {
        return view('public.highlights', [
            'sliders' => Slider::forPage('highlights'),
            'stats'   => Stat::active()->get(),
            'testimonials' => Testimonial::active()->get(),
        ]);
    }
    public function privacy() { return view('public.privacy', ['page'=>Page::findBySlug('privacy')]); }
    public function terms()   { return view('public.terms',   ['page'=>Page::findBySlug('terms')]); }
}
