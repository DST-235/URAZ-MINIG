<?php
namespace App\Http\Controllers;
use App\Models\{Slider,Service,Project,Testimonial,Stat,BlogPost,Faq};

class HomeController extends Controller {
    public function index() {
        return view('public.home', [
            'sliders'       => Slider::forPage('home'),
            'services'      => Service::root()->active()->with('children')->orderBy('order')->take(8)->get(),
            'projects'      => Project::active()->featured()->orderBy('order')->take(6)->get(),
            'testimonials'  => Testimonial::active()->take(6)->get(),
            'stats'         => Stat::active()->get(),
            'posts'         => BlogPost::published()->latest('published_at')->take(3)->get(),
            'faqs'          => Faq::active()->where('page_key','home')->take(8)->get(),
        ]);
    }
}
