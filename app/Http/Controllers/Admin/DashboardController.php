<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Service,Project,TeamMember,BlogPost,ContactMessage,Slider,Testimonial,Stat};

class DashboardController extends Controller {
    public function index() {
        return view('admin.dashboard', [
            'stats' => [
                'services'  => Service::count(),
                'projects'  => Project::count(),
                'team'      => TeamMember::count(),
                'posts'     => BlogPost::count(),
                'messages'  => ContactMessage::unread()->count(),
                'sliders'   => Slider::count(),
            ]
        ]);
    }
}
