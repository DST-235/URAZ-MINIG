<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller {
    public function index() { return view('admin.faqs.index', ['faqs'=>Faq::orderBy('page_key')->orderBy('order')->get()]); }
    public function create() { return view('admin.faqs.form', ['faq'=>null]); }
    public function store(Request $r) {
        $data = $r->validate(['page_key'=>'required|string','order'=>'integer','is_active'=>'nullable',
            'question_en'=>'required|string','question_fr'=>'nullable|string','question_ar'=>'nullable|string',
            'answer_en'=>'required|string','answer_fr'=>'nullable|string','answer_ar'=>'nullable|string',
        ]);
        $f = new Faq(); $this->fill($f,$data,$r); $f->save();
        return redirect()->route('admin.faqs.index')->with('success','FAQ created.');
    }
    public function edit(Faq $faq) { return view('admin.faqs.form', compact('faq')); }
    public function update(Request $r, Faq $faq) {
        $data = $r->validate(['page_key'=>'required|string','order'=>'integer','is_active'=>'nullable',
            'question_en'=>'required|string','question_fr'=>'nullable|string','question_ar'=>'nullable|string',
            'answer_en'=>'required|string','answer_fr'=>'nullable|string','answer_ar'=>'nullable|string',
        ]);
        $this->fill($faq,$data,$r); $faq->save();
        return redirect()->route('admin.faqs.index')->with('success','FAQ updated.');
    }
    public function destroy(Faq $faq) { $faq->delete(); return back()->with('success','Deleted.'); }
    private function fill(Faq $f, array $d, Request $r): void {
        $f->page_key=$d['page_key']; $f->order=$d['order']??0; $f->is_active=$r->has('is_active');
        foreach(['question','answer'] as $field)
            foreach(['en','fr','ar'] as $l) $f->setTranslation($field,$l,$d["{$field}_{$l}"]??'');
    }
}
