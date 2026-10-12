<?php
namespace App\Http\Controllers;
use App\Models\{Slider,Setting};
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() {
        return view('public.contact', [
            'sliders' => Slider::forPage('contact'),
        ]);
    }
    public function store(Request $r) {
        $data = $r->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:30',
            'company' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ]);
        ContactMessage::create($data);
        return back()->with('success', __('messages.contact_sent'));
    }
}
