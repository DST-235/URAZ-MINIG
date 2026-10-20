<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller {
    public function index() {
        $products = Product::orderBy('order')->get();
        return view('admin.products.index', compact('products'));
    }
    public function create() {
        return view('admin.products.form', ['product'=>null]);
    }
    public function store(Request $r) {
        $data = $this->validated($r);
        $product = new Product();
        $this->fill($product, $data, $r);
        $product->slug = Str::slug($data['name_en'] ?? 'product');
        if (Product::where('slug',$product->slug)->exists()) $product->slug .= '-'.time();
        if ($r->hasFile('image')) $product->image = $this->storeUpload($r->file('image'), 'products');
        $product->save();
        return redirect()->route('admin.products.index')->with('success','Product created.');
    }
    public function edit(Product $product) {
        return view('admin.products.form', compact('product'));
    }
    public function update(Request $r, Product $product) {
        $data = $this->validated($r);
        $this->fill($product, $data, $r);
        if ($r->hasFile('image')) {
            if ($product->image) $this->deleteUpload($product->image);
            $product->image = $this->storeUpload($r->file('image'), 'products');
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success','Product updated.');
    }
    public function destroy(Product $product) {
        if ($product->image) $this->deleteUpload($product->image);
        $product->delete();
        return back()->with('success','Product deleted.');
    }
    private function validated(Request $r): array {
        $rules = [
            'order'=>'integer','is_active'=>'nullable','show_in_nav'=>'nullable',
            'category'=>'nullable|string','icon'=>'nullable|string','image'=>'nullable|image|max:4096',
        ];
        foreach (array_keys(config('locales')) as $l) {
            $required = $l === 'en' ? 'required' : 'nullable';
            $rules["name_{$l}"] = "{$required}|string";
            $rules["description_{$l}"] = "{$required}|string";
            $rules["short_description_{$l}"] = 'nullable|string';
            $rules["features_{$l}"] = 'nullable|string';
        }
        return $r->validate($rules);
    }
    private function fill(Product $p, array $d, Request $r): void {
        $p->order = $d['order'] ?? 0;
        $p->is_active = $r->has('is_active');
        $p->show_in_nav = $r->has('show_in_nav');
        $p->icon = $d['icon'] ?? null;
        $p->category = $d['category'] ?? null;
        foreach(['name','description','short_description','features'] as $f) {
            foreach(array_keys(config('locales')) as $l) $p->setTranslation($f,$l,$d["{$f}_{$l}"] ?? '');
        }
    }
}
