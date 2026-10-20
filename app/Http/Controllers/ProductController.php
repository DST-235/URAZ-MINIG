<?php
namespace App\Http\Controllers;
use App\Models\{Product,Slider,Faq};

class ProductController extends Controller {
    public function index() {
        return view('public.products.index', [
            'sliders'  => Slider::forPage('products'),
            'products' => Product::active()->orderBy('order')->get(),
        ]);
    }
    public function show(string $slug) {
        $product = Product::where('slug',$slug)->active()->firstOrFail();
        return view('public.products.show', [
            'product' => $product,
            'sliders' => Slider::forPage($slug),
            'faqs'    => Faq::active()->where('page_key',$slug)->get(),
            'others'  => Product::active()->where('id','!=',$product->id)->take(5)->get(),
        ]);
    }
}
