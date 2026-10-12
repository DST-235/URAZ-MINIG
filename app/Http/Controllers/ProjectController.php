<?php
namespace App\Http\Controllers;
use App\Models\{Project,Slider};

class ProjectController extends Controller {
    public function index() {
        return view('public.portfolio', [
            'sliders'  => Slider::forPage('portfolio'),
            'projects' => Project::active()->orderBy('order')->paginate(12),
        ]);
    }
    public function show(Project $project) {
        return view('public.project-show', compact('project'));
    }
}
