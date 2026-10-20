<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function index() { return view('admin.pages.index', ['pages'=>Page::all()]); }
    public function edit(Page $page) { return view('admin.pages.form', compact('page')); }
    public function update(Request $r, Page $page) {
        $rules = ['is_active'=>'nullable'];
        foreach (array_keys(config('locales')) as $l) {
            $rules["title_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["content_{$l}"] = 'nullable|string';
            $rules["meta_title_{$l}"] = 'nullable|string';
            $rules["meta_description_{$l}"] = 'nullable|string';
        }
        $data = $r->validate($rules);
        $page->is_active = $r->has('is_active');
        foreach(['title','content','meta_title','meta_description'] as $f)
            foreach(array_keys(config('locales')) as $l) $page->setTranslation($f,$l,$data["{$f}_{$l}"]??'');
        $page->save();
        return redirect()->route('admin.pages.index')->with('success','Page updated.');
    }
}
