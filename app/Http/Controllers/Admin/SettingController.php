<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $r) {
        $fields = [
            'site_name','site_tagline','site_email','site_phone','site_phone2',
            'site_address','site_city','site_country','site_zip',
            'facebook','twitter','linkedin','instagram','youtube',
            'google_maps_url','about_short',
            'public_primary','public_accent','public_bg',
            'admin_primary','admin_bg','admin_surface_bg',
        ];
        foreach ($fields as $key) {
            if ($r->has($key)) {
                Setting::updateOrCreate(['key'=>$key],['value'=>$r->input($key),'group'=>'general']);
            }
        }
        foreach (['site_logo' => 'logo_', 'about_image' => 'about_'] as $key => $prefix) {
            if ($r->hasFile($key)) {
                $old = Setting::where('key', $key)->first();
                if ($old && $old->value) {
                    $abs = storage_path('app/public/' . $old->value);
                    if (file_exists($abs)) @unlink($abs);
                }
                $path = $this->storeUpload($r->file($key), 'settings');
                Setting::updateOrCreate(['key' => $key], ['value' => $path, 'group' => 'general']);
            }
        }
        return back()->with('success','Settings saved.');
    }
}
