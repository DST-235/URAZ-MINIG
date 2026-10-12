<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
class SliderController extends Controller {
    private array $pages = [
        'home'=>'Home','about'=>'About Us','services'=>'Services',
        'erp'=>'ERP','public-sector'=>'Public Sector','markets'=>'Markets',
        'schools'=>'Schools','construction'=>'Construction','farming'=>'Farming',
        'donation'=>'Donation','web-development'=>'Web Development',
        'portfolio'=>'Portfolio','blog'=>'Blog','contact'=>'Contact',
    ];

    public function index() {
        $sliders = Slider::orderBy('page_key')->orderBy('order')->get()->groupBy('page_key');
        $pages = $this->pages;
        return view('admin.sliders.index', compact('sliders', 'pages'));
    }
    public function create() { return view('admin.sliders.form', ['slider'=>null,'pages'=>$this->pages]); }
    public function store(Request $r) {
        $data = $r->validate([
            'page_key'=>'required','text_align'=>'required|in:left,center,right',
            'order'=>'integer','is_active'=>'nullable',
            'title_en'=>'nullable|string','title_fr'=>'nullable|string','title_ar'=>'nullable|string',
            'subtitle_en'=>'nullable|string','subtitle_fr'=>'nullable|string','subtitle_ar'=>'nullable|string',
            'button_text_en'=>'nullable|string','button_text_fr'=>'nullable|string','button_text_ar'=>'nullable|string',
            'button_link'=>'nullable|string','overlay_color'=>'nullable|string',
            'image'=>'nullable|image|max:4096',
        ]);
        $slider = new Slider();
        $slider->page_key = $data['page_key'];
        $slider->text_align = $data['text_align'];
        $slider->order = $data['order'] ?? 0;
        $slider->is_active = $r->has('is_active');
        $slider->button_link = $data['button_link'] ?? null;
        $slider->overlay_color = $data['overlay_color'] ?? 'rgba(0,0,0,0.5)';
        $slider->setTranslation('title','en',$data['title_en'] ?? '');
        $slider->setTranslation('title','fr',$data['title_fr'] ?? '');
        $slider->setTranslation('title','ar',$data['title_ar'] ?? '');
        $slider->setTranslation('subtitle','en',$data['subtitle_en'] ?? '');
        $slider->setTranslation('subtitle','fr',$data['subtitle_fr'] ?? '');
        $slider->setTranslation('subtitle','ar',$data['subtitle_ar'] ?? '');
        $slider->setTranslation('button_text','en',$data['button_text_en'] ?? '');
        $slider->setTranslation('button_text','fr',$data['button_text_fr'] ?? '');
        $slider->setTranslation('button_text','ar',$data['button_text_ar'] ?? '');
        if ($r->hasFile('image')) {
            $slider->image = $this->storeUpload($r->file('image'), 'sliders');
        }
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success','Slider created.');
    }
    public function edit(Slider $slider) { return view('admin.sliders.form', compact('slider') + ['pages'=>$this->pages]); }
    public function update(Request $r, Slider $slider) {
        $data = $r->validate([
            'page_key'=>'required','text_align'=>'required|in:left,center,right',
            'order'=>'integer','is_active'=>'nullable',
            'title_en'=>'nullable|string','title_fr'=>'nullable|string','title_ar'=>'nullable|string',
            'subtitle_en'=>'nullable|string','subtitle_fr'=>'nullable|string','subtitle_ar'=>'nullable|string',
            'button_text_en'=>'nullable|string','button_text_fr'=>'nullable|string','button_text_ar'=>'nullable|string',
            'button_link'=>'nullable|string','overlay_color'=>'nullable|string',
            'image'=>'nullable|image|max:4096',
        ]);
        $slider->page_key = $data['page_key'];
        $slider->text_align = $data['text_align'];
        $slider->order = $data['order'] ?? 0;
        $slider->is_active = $r->has('is_active');
        $slider->button_link = $data['button_link'] ?? null;
        $slider->overlay_color = $data['overlay_color'] ?? 'rgba(0,0,0,0.5)';
        $slider->setTranslation('title','en',$data['title_en'] ?? '');
        $slider->setTranslation('title','fr',$data['title_fr'] ?? '');
        $slider->setTranslation('title','ar',$data['title_ar'] ?? '');
        $slider->setTranslation('subtitle','en',$data['subtitle_en'] ?? '');
        $slider->setTranslation('subtitle','fr',$data['subtitle_fr'] ?? '');
        $slider->setTranslation('subtitle','ar',$data['subtitle_ar'] ?? '');
        $slider->setTranslation('button_text','en',$data['button_text_en'] ?? '');
        $slider->setTranslation('button_text','fr',$data['button_text_fr'] ?? '');
        $slider->setTranslation('button_text','ar',$data['button_text_ar'] ?? '');
        if ($r->hasFile('image')) {
            if ($slider->image) $this->deleteUpload($slider->image);
            $slider->image = $this->storeUpload($r->file('image'), 'sliders');
        }
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success','Slider updated.');
    }
    public function destroy(Slider $slider) {
        if ($slider->image) $this->deleteUpload($slider->image);
        $slider->delete();
        return back()->with('success','Slider deleted.');
    }
}
