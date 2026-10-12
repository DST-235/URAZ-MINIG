<?php
namespace App\Http\Controllers;
use App\Models\{Service,Slider,Faq};

class ServiceController extends Controller {
    public function index() {
        return view('public.services.index', [
            'sliders'  => Slider::forPage('services'),
            'services' => Service::root()->active()->with('children')->orderBy('order')->get(),
        ]);
    }
    public function show(string $slug) {
        $service = Service::where('slug',$slug)->active()->with('children')->firstOrFail();
        return view('public.services.show', [
            'service' => $service,
            'sliders' => Slider::forPage($slug),
            'faqs'    => Faq::active()->where('page_key',$slug)->get(),
            'others'  => Service::root()->active()->where('id','!=',$service->id)->take(5)->get(),
        ]);
    }
}
