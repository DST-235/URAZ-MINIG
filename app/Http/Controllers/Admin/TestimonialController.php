<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
class TestimonialController extends Controller {
    public function index() { return view('admin.testimonials.index', ['testimonials'=>Testimonial::orderBy('order')->get()]); }
    public function create() { return view('admin.testimonials.form', ['testimonial'=>null]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        $t = new Testimonial(); $this->fill($t,$data,$r);
        if ($r->hasFile('author_photo')) $t->author_photo = $this->storeUpload($r->file('author_photo'), 'testimonials');
        $t->save();
        return redirect()->route('admin.testimonials.index')->with('success','Testimonial created.');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.form', compact('testimonial')); }
    public function update(Request $r, Testimonial $testimonial) {
        $data = $r->validate($this->rules());
        $this->fill($testimonial,$data,$r);
        if ($r->hasFile('author_photo')) {
            if ($testimonial->author_photo) $this->deleteUpload($testimonial->author_photo);
            $testimonial->author_photo = $this->storeUpload($r->file('author_photo'), 'testimonials');
        }
        $testimonial->save();
        return redirect()->route('admin.testimonials.index')->with('success','Testimonial updated.');
    }
    public function destroy(Testimonial $testimonial) { $testimonial->delete(); return back()->with('success','Deleted.'); }
    private function rules(): array {
        $rules = ['rating'=>'integer|min:1|max:5','order'=>'integer','is_active'=>'nullable','author_company'=>'nullable|string','author_photo'=>'nullable|image|max:1024'];
        foreach (array_keys(config('locales')) as $l) {
            $rules["quote_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["author_name_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["author_position_{$l}"] = 'nullable|string';
        }
        return $rules;
    }
    private function fill(Testimonial $t, array $d, Request $r): void {
        $t->rating=$d['rating']??5; $t->order=$d['order']??0; $t->is_active=$r->has('is_active');
        $t->author_company=$d['author_company']??null;
        foreach(['quote','author_name','author_position'] as $f)
            foreach(array_keys(config('locales')) as $l) $t->setTranslation($f,$l,$d["{$f}_{$l}"]??'');
    }
}
