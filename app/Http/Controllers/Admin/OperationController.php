<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller {
    public function index() { return view('admin.operations.index', ['operations'=>Operation::orderBy('order')->get()]); }
    public function create() { return view('admin.operations.form', ['operation'=>null]); }
    public function store(Request $r) {
        $data = $this->validated($r);
        $operation = new Operation();
        $this->fill($operation, $data, $r);
        if ($r->hasFile('image')) $operation->image = $this->storeUpload($r->file('image'), 'operations');
        $operation->save();
        return redirect()->route('admin.operations.index')->with('success','Operation created.');
    }
    public function edit(Operation $operation) { return view('admin.operations.form', compact('operation')); }
    public function update(Request $r, Operation $operation) {
        $data = $this->validated($r);
        $this->fill($operation, $data, $r);
        if ($r->hasFile('image')) {
            if ($operation->image) $this->deleteUpload($operation->image);
            $operation->image = $this->storeUpload($r->file('image'), 'operations');
        }
        $operation->save();
        return redirect()->route('admin.operations.index')->with('success','Operation updated.');
    }
    public function destroy(Operation $operation) {
        if ($operation->image) $this->deleteUpload($operation->image);
        $operation->delete();
        return back()->with('success','Operation deleted.');
    }
    private function validated(Request $r): array {
        $rules = [
            'order'=>'integer','is_active'=>'nullable','is_featured'=>'nullable',
            'category'=>'required|in:sourcing,logistics,export,warehousing',
            'tags'=>'nullable|string','active_since'=>'nullable|date',
            'image'=>'nullable|image|max:4096',
        ];
        foreach (array_keys(config('locales')) as $l) {
            $required = $l === 'en' ? 'required' : 'nullable';
            $rules["title_{$l}"] = "{$required}|string";
            $rules["description_{$l}"] = "{$required}|string";
            $rules["location_{$l}"] = 'nullable|string';
        }
        return $r->validate($rules);
    }
    private function fill(Operation $p, array $d, Request $r): void {
        $p->order = $d['order'] ?? 0;
        $p->is_active = $r->has('is_active');
        $p->is_featured = $r->has('is_featured');
        $p->category = $d['category'] ?? null;
        $p->tags = $d['tags'] ?? null;
        $p->active_since = $d['active_since'] ?? null;
        foreach(['title','description','location'] as $f)
            foreach(array_keys(config('locales')) as $l) $p->setTranslation($f,$l,$d["{$f}_{$l}"] ?? '');
    }
}
