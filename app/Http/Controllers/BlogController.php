<?php
namespace App\Http\Controllers;
use App\Models\{BlogPost,Slider};

class BlogController extends Controller {
    public function index() {
        return view('public.blog.index', [
            'sliders' => Slider::forPage('blog'),
            'posts'   => BlogPost::published()->latest('published_at')->paginate(9),
        ]);
    }
    public function show(string $slug) {
        $post = BlogPost::where('slug',$slug)->published()->firstOrFail();
        $related = BlogPost::published()->where('id','!=',$post->id)->latest()->take(3)->get();
        return view('public.blog.show', compact('post','related'));
    }
}
