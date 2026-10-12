<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function index() { return view('admin.pages.index', ['pages'=>Page::all()]); }
    public function edit(Page $page) { return view('admin.pages.form', compact('page')); }
    public function update(Request $r, Page $page) {
        $data = $r->validate([
            'is_active'=>'nullable',
            'title_en'=>'required|string','title_fr'=>'nullable|string','title_ar'=>'nullable|string',
            'content_en'=>'nullable|string','content_fr'=>'nullable|string','content_ar'=>'nullable|string',
            'meta_title_en'=>'nullable|string','meta_title_fr'=>'nullable|string','meta_title_ar'=>'nullable|string',
            'meta_description_en'=>'nullable|string','meta_description_fr'=>'nullable|string','meta_description_ar'=>'nullable|string',
        ]);
        $page->is_active = $r->has('is_active');
        foreach(['title','content','meta_title','meta_description'] as $f)
            foreach(['en','fr','ar'] as $l) $page->setTranslation($f,$l,$data["{$f}_{$l}"]??'');
        $page->save();
        return redirect()->route('admin.pages.index')->with('success','Page updated.');
    }
}
