<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller {
    public function index() { return view('admin.blog.index', ['posts'=>BlogPost::latest()->get()]); }
    public function create() { return view('admin.blog.form', ['post'=>null]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        $post = new BlogPost();
        $this->fill($post,$data,$r);
        $post->slug = Str::slug($data['title_en']);
        if (BlogPost::where('slug',$post->slug)->exists()) $post->slug .= '-'.time();
        $post->author_id = auth()->id();
        if ($r->hasFile('image')) $post->image = $this->storeUpload($r->file('image'), 'blog');
        $post->save();
        return redirect()->route('admin.blog.index')->with('success','Post created.');
    }
    public function edit(BlogPost $blog) { return view('admin.blog.form', ['post'=>$blog]); }
    public function update(Request $r, BlogPost $blog) {
        $data = $r->validate($this->rules());
        $this->fill($blog,$data,$r);
        if ($r->hasFile('image')) {
            if ($blog->image) $this->deleteUpload($blog->image);
            $blog->image = $this->storeUpload($r->file('image'), 'blog');
        }
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success','Post updated.');
    }
    public function destroy(BlogPost $blog) {
        if ($blog->image) $this->deleteUpload($blog->image);
        $blog->delete(); return back()->with('success','Post deleted.');
    }
    private function rules(): array {
        $rules = ['is_published'=>'nullable','is_featured'=>'nullable','published_at'=>'nullable|date','image'=>'nullable|image|max:4096'];
        foreach (array_keys(config('locales')) as $l) {
            $rules["title_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["content_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["excerpt_{$l}"] = 'nullable|string';
            $rules["category_{$l}"] = 'nullable|string';
        }
        return $rules;
    }
    private function fill(BlogPost $p, array $d, Request $r): void {
        $p->is_published=$r->has('is_published'); $p->is_featured=$r->has('is_featured');
        $p->published_at=$r->has('is_published')?($d['published_at']??now()):null;
        foreach(['title','excerpt','content','category'] as $f)
            foreach(array_keys(config('locales')) as $l) $p->setTranslation($f,$l,$d["{$f}_{$l}"]??'');
    }
}
