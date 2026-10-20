<?php
namespace App\Http\Controllers;
use App\Models\{Slider,Product,Operation,Testimonial,Stat,BlogPost,Faq};

class HomeController extends Controller {
    public function index() {
        return view('public.home', [
            'sliders'       => Slider::forPage('home'),
            'products'      => Product::active()->orderBy('order')->take(8)->get(),
            'operations'    => Operation::active()->featured()->orderBy('order')->take(6)->get(),
            'testimonials'  => Testimonial::active()->take(6)->get(),
            'stats'         => Stat::active()->get(),
            'posts'         => BlogPost::published()->latest('published_at')->take(3)->get(),
            'faqs'          => Faq::active()->where('page_key','home')->take(8)->get(),
        ]);
    }
}
