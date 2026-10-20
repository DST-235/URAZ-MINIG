<?php
namespace App\Http\Controllers;
use App\Models\{Operation,Slider};

class OperationController extends Controller {
    public function index() {
        return view('public.operations.index', [
            'sliders'    => Slider::forPage('operations'),
            'operations' => Operation::active()->orderBy('order')->paginate(12),
        ]);
    }
    public function show(Operation $operation) {
        return view('public.operations.show', compact('operation'));
    }
}
