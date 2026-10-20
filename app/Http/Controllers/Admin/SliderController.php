<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
class SliderController extends Controller {
    private array $pages = [
        'home'=>'Home','about'=>'About Us','products'=>'Products',
        'operations'=>'Operations','team'=>'Team','highlights'=>'Highlights',
        'blog'=>'Blog','contact'=>'Contact',
    ];

    public function index() {
        $sliders = Slider::orderBy('page_key')->orderBy('order')->get()->groupBy('page_key');
        $pages = $this->pages;
        return view('admin.sliders.index', compact('sliders', 'pages'));
    }
    public function create() { return view('admin.sliders.form', ['slider'=>null,'pages'=>$this->pages]); }
    public function store(Request $r) {
        $data = $r->validate($this->rules());
        $slider = new Slider();
        $this->fill($slider, $data, $r);
        if ($r->hasFile('image')) $slider->image = $this->storeUpload($r->file('image'), 'sliders');
        $slider->save();
        return redirect()->route('admin.sliders.index')->with('success','Slider created.');
    }
    public function edit(Slider $slider) { return view('admin.sliders.form', compact('slider') + ['pages'=>$this->pages]); }
    public function update(Request $r, Slider $slider) {
        $data = $r->validate($this->rules());
        $this->fill($slider, $data, $r);
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
    private function rules(): array {
        $rules = [
            'page_key'=>'required','text_align'=>'required|in:left,center,right',
            'order'=>'integer','is_active'=>'nullable',
            'button_link'=>'nullable|string','overlay_color'=>'nullable|string',
            'image'=>'nullable|image|max:4096',
        ];
        foreach (array_keys(config('locales')) as $l) {
            $rules["title_{$l}"] = 'nullable|string';
            $rules["subtitle_{$l}"] = 'nullable|string';
            $rules["button_text_{$l}"] = 'nullable|string';
        }
        return $rules;
    }
    private function fill(Slider $slider, array $data, Request $r): void {
        $slider->page_key = $data['page_key'];
        $slider->text_align = $data['text_align'];
        $slider->order = $data['order'] ?? 0;
        $slider->is_active = $r->has('is_active');
        $slider->button_link = $data['button_link'] ?? null;
        $slider->overlay_color = $data['overlay_color'] ?? 'rgba(0,0,0,0.5)';
        foreach(['title','subtitle','button_text'] as $f)
            foreach(array_keys(config('locales')) as $l) $slider->setTranslation($f,$l,$data["{$f}_{$l}"] ?? '');
    }
}
