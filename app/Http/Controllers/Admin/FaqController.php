<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller {
    public function index() { return view('admin.faqs.index', ['faqs'=>Faq::orderBy('page_key')->orderBy('order')->get()]); }
    public function create() { return view('admin.faqs.form', ['faq'=>null]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        $f = new Faq(); $this->fill($f,$data,$r); $f->save();
        return redirect()->route('admin.faqs.index')->with('success','FAQ created.');
    }
    public function edit(Faq $faq) { return view('admin.faqs.form', compact('faq')); }
    public function update(Request $r, Faq $faq) {
        $data = $r->validate($this->rules());
        $this->fill($faq,$data,$r); $faq->save();
        return redirect()->route('admin.faqs.index')->with('success','FAQ updated.');
    }
    public function destroy(Faq $faq) { $faq->delete(); return back()->with('success','Deleted.'); }
    private function rules(): array {
        $rules = ['page_key'=>'required|string','order'=>'integer','is_active'=>'nullable'];
        foreach (array_keys(config('locales')) as $l) {
            $rules["question_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["answer_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
        }
        return $rules;
    }
    private function fill(Faq $f, array $d, Request $r): void {
        $f->page_key=$d['page_key']; $f->order=$d['order']??0; $f->is_active=$r->has('is_active');
        foreach(['question','answer'] as $field)
            foreach(array_keys(config('locales')) as $l) $f->setTranslation($field,$l,$d["{$field}_{$l}"]??'');
    }
}
