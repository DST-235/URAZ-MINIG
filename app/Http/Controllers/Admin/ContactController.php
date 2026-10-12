<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller {
    public function index() {
        return view('admin.contact.index', [
            'messages'    => ContactMessage::latest()->paginate(20),
            'unreadCount' => ContactMessage::unread()->count(),
        ]);
    }
    public function show(ContactMessage $contact) {
        if (!$contact->is_read) { $contact->update(['is_read'=>true,'read_at'=>now()]); }
        return view('admin.contact.show', compact('contact'));
    }
    public function destroy(ContactMessage $contact) { $contact->delete(); return back()->with('success','Deleted.'); }
}
