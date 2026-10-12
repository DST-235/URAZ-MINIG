<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
class TeamController extends Controller {
    public function index() { return view('admin.team.index', ['members'=>TeamMember::orderBy('order')->get()]); }
    public function create() { return view('admin.team.form', ['member'=>null]); }
    public function store(Request $r) {
        $data = $r->validate([
            'order'=>'integer','is_active'=>'nullable','email'=>'nullable|email',
            'linkedin'=>'nullable|string','twitter'=>'nullable|string','photo'=>'nullable|image|max:2048',
            'name_en'=>'required|string','name_fr'=>'nullable|string','name_ar'=>'nullable|string',
            'position_en'=>'required|string','position_fr'=>'nullable|string','position_ar'=>'nullable|string',
            'bio_en'=>'nullable|string','bio_fr'=>'nullable|string','bio_ar'=>'nullable|string',
        ]);
        $m = new TeamMember();
        $this->fill($m, $data, $r);
        if ($r->hasFile('photo')) $m->photo = $this->storeUpload($r->file('photo'), 'team');
        $m->save();
        return redirect()->route('admin.team.index')->with('success','Member created.');
    }
    public function edit(TeamMember $team) { return view('admin.team.form', ['member'=>$team]); }
    public function update(Request $r, TeamMember $team) {
        $data = $r->validate([
            'order'=>'integer','is_active'=>'nullable','email'=>'nullable|email',
            'linkedin'=>'nullable|string','twitter'=>'nullable|string','photo'=>'nullable|image|max:2048',
            'name_en'=>'required|string','name_fr'=>'nullable|string','name_ar'=>'nullable|string',
            'position_en'=>'required|string','position_fr'=>'nullable|string','position_ar'=>'nullable|string',
            'bio_en'=>'nullable|string','bio_fr'=>'nullable|string','bio_ar'=>'nullable|string',
        ]);
        $this->fill($team, $data, $r);
        if ($r->hasFile('photo')) {
            if ($team->photo) $this->deleteUpload($team->photo);
            $team->photo = $this->storeUpload($r->file('photo'), 'team');
        }
        $team->save();
        return redirect()->route('admin.team.index')->with('success','Member updated.');
    }
    public function destroy(TeamMember $team) {
        if ($team->photo) $this->deleteUpload($team->photo);
        $team->delete(); return back()->with('success','Member deleted.');
    }
    private function fill(TeamMember $m, array $d, Request $r): void {
        $m->order=$d['order']??0; $m->is_active=$r->has('is_active');
        $m->email=$d['email']??null; $m->linkedin=$d['linkedin']??null; $m->twitter=$d['twitter']??null;
        foreach(['name','position','bio'] as $f)
            foreach(['en','fr','ar'] as $l) $m->setTranslation($f,$l,$d["{$f}_{$l}"]??'');
    }
}
