<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller {
    public function index() { return view('admin.stats.index', ['stats'=>Stat::orderBy('order')->get()]); }
    public function create() { return view('admin.stats.form', ['stat'=>null]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        $s = new Stat(); $this->fill($s,$data,$r); $s->save();
        return redirect()->route('admin.stats.index')->with('success','Stat created.');
    }
    public function edit(Stat $stat) { return view('admin.stats.form', compact('stat')); }
    public function update(Request $r, Stat $stat) {
        $data = $r->validate($this->rules());
        $this->fill($stat,$data,$r); $stat->save();
        return redirect()->route('admin.stats.index')->with('success','Stat updated.');
    }
    public function destroy(Stat $stat) { $stat->delete(); return back()->with('success','Deleted.'); }
    private function rules(): array {
        $rules = ['icon'=>'required|string','value'=>'required|string','order'=>'integer','is_active'=>'nullable'];
        foreach (array_keys(config('locales')) as $l) {
            $rules["label_{$l}"] = $l === 'en' ? 'required|string' : 'nullable|string';
            $rules["description_{$l}"] = 'nullable|string';
        }
        return $rules;
    }
    private function fill(Stat $s, array $d, Request $r): void {
        $s->icon=$d['icon']; $s->value=$d['value']; $s->order=$d['order']??0; $s->is_active=$r->has('is_active');
        foreach(['label','description'] as $f) foreach(array_keys(config('locales')) as $l) $s->setTranslation($f,$l,$d["{$f}_{$l}"]??'');
    }
}
