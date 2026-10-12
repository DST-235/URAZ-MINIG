<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller {
    public function index() {
        $services = Service::root()->with('children')->orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }
    public function create() {
        $parents = Service::root()->orderBy('order')->get();
        return view('admin.services.form', ['service'=>null, 'parents'=>$parents]);
    }
    public function store(Request $r) {
        $data = $this->validated($r);
        $service = new Service();
        $this->fill($service, $data, $r);
        $service->slug = Str::slug($data['name_en'] ?? $data['name_fr'] ?? 'service');
        if (Service::where('slug',$service->slug)->exists()) $service->slug .= '-'.time();
        if ($r->hasFile('image')) $service->image = $this->storeUpload($r->file('image'), 'services');
        $service->save();
        return redirect()->route('admin.services.index')->with('success','Service created.');
    }
    public function edit(Service $service) {
        $parents = Service::root()->where('id','!=',$service->id)->orderBy('order')->get();
        return view('admin.services.form', compact('service','parents'));
    }
    public function update(Request $r, Service $service) {
        $data = $this->validated($r);
        $this->fill($service, $data, $r);
        if ($r->hasFile('image')) {
            if ($service->image) $this->deleteUpload($service->image);
            $service->image = $this->storeUpload($r->file('image'), 'services');
        }
        $service->save();
        return redirect()->route('admin.services.index')->with('success','Service updated.');
    }
    public function destroy(Service $service) {
        if ($service->image) $this->deleteUpload($service->image);
        $service->delete();
        return back()->with('success','Service deleted.');
    }
    private function validated(Request $r): array {
        return $r->validate([
            'parent_id'=>'nullable|exists:services,id','order'=>'integer',
            'is_active'=>'nullable','show_in_nav'=>'nullable',
            'icon'=>'nullable|string','image'=>'nullable|image|max:4096',
            'name_en'=>'required|string','name_fr'=>'nullable|string','name_ar'=>'nullable|string',
            'description_en'=>'required|string','description_fr'=>'nullable|string','description_ar'=>'nullable|string',
            'short_description_en'=>'nullable|string','short_description_fr'=>'nullable|string','short_description_ar'=>'nullable|string',
        ]);
    }
    private function fill(Service $s, array $d, Request $r): void {
        $s->parent_id = $d['parent_id'] ?? null;
        $s->order = $d['order'] ?? 0;
        $s->is_active = $r->has('is_active');
        $s->show_in_nav = $r->has('show_in_nav');
        $s->icon = $d['icon'] ?? null;
        foreach(['name','description','short_description'] as $f) {
            foreach(['en','fr','ar'] as $l) $s->setTranslation($f,$l,$d["{$f}_{$l}"] ?? '');
        }
    }
}
