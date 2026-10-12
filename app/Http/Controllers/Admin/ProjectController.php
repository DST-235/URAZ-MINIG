<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
class ProjectController extends Controller {
    public function index() { return view('admin.projects.index', ['projects'=>Project::orderBy('order')->get()]); }
    public function create() { return view('admin.projects.form', ['project'=>null]); }
    public function store(Request $r) {
        $data = $this->validated($r);
        $project = new Project();
        $this->fill($project, $data, $r);
        if ($r->hasFile('image')) $project->image = $this->storeUpload($r->file('image'), 'projects');
        $project->save();
        return redirect()->route('admin.projects.index')->with('success','Project created.');
    }
    public function edit(Project $project) { return view('admin.projects.form', compact('project')); }
    public function update(Request $r, Project $project) {
        $data = $this->validated($r);
        $this->fill($project, $data, $r);
        if ($r->hasFile('image')) {
            if ($project->image) $this->deleteUpload($project->image);
            $project->image = $this->storeUpload($r->file('image'), 'projects');
        }
        $project->save();
        return redirect()->route('admin.projects.index')->with('success','Project updated.');
    }
    public function destroy(Project $project) {
        if ($project->image) $this->deleteUpload($project->image);
        $project->delete();
        return back()->with('success','Project deleted.');
    }
    private function validated(Request $r): array {
        return $r->validate([
            'order'=>'integer','is_active'=>'nullable','is_featured'=>'nullable',
            'url'=>'nullable|url','technologies'=>'nullable|string','completed_at'=>'nullable|date',
            'image'=>'nullable|image|max:4096',
            'title_en'=>'required|string','title_fr'=>'nullable|string','title_ar'=>'nullable|string',
            'description_en'=>'required|string','description_fr'=>'nullable|string','description_ar'=>'nullable|string',
            'client_en'=>'nullable|string','client_fr'=>'nullable|string','client_ar'=>'nullable|string',
            'category_en'=>'nullable|string','category_fr'=>'nullable|string','category_ar'=>'nullable|string',
        ]);
    }
    private function fill(Project $p, array $d, Request $r): void {
        $p->order = $d['order'] ?? 0;
        $p->is_active = $r->has('is_active');
        $p->is_featured = $r->has('is_featured');
        $p->url = $d['url'] ?? null;
        $p->technologies = $d['technologies'] ?? null;
        $p->completed_at = $d['completed_at'] ?? null;
        foreach(['title','description','client','category'] as $f)
            foreach(['en','fr','ar'] as $l) $p->setTranslation($f,$l,$d["{$f}_{$l}"] ?? '');
    }
}
