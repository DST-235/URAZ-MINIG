<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Product,Operation,TeamMember,BlogPost,ContactMessage,Slider,Testimonial,Stat};

class DashboardController extends Controller {
    public function index() {
        return view('admin.dashboard', [
            'stats' => [
                'products'   => Product::count(),
                'operations' => Operation::count(),
                'team'       => TeamMember::count(),
                'posts'      => BlogPost::count(),
                'messages'   => ContactMessage::unread()->count(),
                'sliders'    => Slider::count(),
            ]
        ]);
    }
}
