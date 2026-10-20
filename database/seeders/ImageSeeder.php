<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Setting, Slider, Product, Operation, BlogPost, TeamMember, Testimonial};

class ImageSeeder extends Seeder
{
    private int $timeout = 20;

    public function run(): void
    {
        $this->seedAboutImage();
        $this->seedSliderImages();
        $this->seedProductImages();
        $this->seedOperationImages();
        $this->seedBlogImages();
        $this->seedTeamImages();
        $this->seedTestimonialImages();

        echo "Images seeded successfully!\n";
    }

    // ── About image (800×500) ──────────────────────────────────────────────────

    private function seedAboutImage(): void
    {
        $url  = 'https://loremflickr.com/800/500/minerals,mining,warehouse?lock=10';
        $path = 'settings/about_image.jpg';

        $bytes = $this->download($url);
        if ($bytes && $this->save($path, $bytes)) {
            Setting::updateOrCreate(['key' => 'about_image'], ['value' => $path, 'group' => 'general']);
            echo "  ✓ about_image\n";
        } else {
            echo "  ✗ about_image (download failed)\n";
        }
    }

    // ── Sliders (1920×900) ─────────────────────────────────────────────────────

    private function seedSliderImages(): void
    {
        // Indexed to match slider creation order in UrazSeeder:
        // 0 home/0 · 1 home/1 · 2 home/2 · 3 about · 4 products · 5 operations · 6 contact
        $keywords = [
            'minerals,ore,mining',
            'gold,bars,bullion',
            'cargo,ship,port',
            'africa,mining,landscape',
            'copper,ore,industrial',
            'warehouse,logistics,storage',
            'trade,meeting,africa',
        ];

        $sliders = Slider::orderBy('id')->get();
        foreach ($sliders as $i => $slider) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 100 + $slider->id;
            $url  = "https://loremflickr.com/1920/900/{$kw}?lock={$lock}";
            $path = "sliders/slide-{$slider->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $slider->update(['image' => $path]);
                echo "  ✓ slider {$slider->id}\n";
            } else {
                echo "  ✗ slider {$slider->id} (download failed)\n";
            }
        }
    }

    // ── Products (800×500) ────────────────────────────────────────────────────

    private function seedProductImages(): void
    {
        // Matches product order in UrazSeeder: 0 Antimony · 1 Gold · 2 Petroleum · 3 Copper · 4 Tungsten
        $keywords = [
            'antimony,mineral,ore',
            'gold,bars,nuggets',
            'petroleum,oil,rig',
            'copper,ore,cathode',
            'tungsten,ore,metal',
        ];

        $products = Product::orderBy('id')->get();
        foreach ($products as $i => $product) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 200 + $product->id;
            $url  = "https://loremflickr.com/800/500/{$kw}?lock={$lock}";
            $path = "products/product-{$product->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $product->update(['image' => $path]);
                echo "  ✓ product {$product->id}\n";
            } else {
                echo "  ✗ product {$product->id} (download failed)\n";
            }
        }
    }

    // ── Operations (800×500) ──────────────────────────────────────────────────

    private function seedOperationImages(): void
    {
        // Matches operation order in UrazSeeder: 0 sourcing · 1 logistics · 2 export · 3 warehousing
        $keywords = [
            'mining,site,africa',
            'cargo,truck,road',
            'cargo,ship,port',
            'warehouse,storage,industrial',
        ];

        $operations = Operation::orderBy('id')->get();
        foreach ($operations as $i => $operation) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 250 + $operation->id;
            $url  = "https://loremflickr.com/800/500/{$kw}?lock={$lock}";
            $path = "operations/operation-{$operation->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $operation->update(['image' => $path]);
                echo "  ✓ operation {$operation->id}\n";
            } else {
                echo "  ✗ operation {$operation->id} (download failed)\n";
            }
        }
    }

    // ── Blog / News posts (1200×630) ──────────────────────────────────────────

    private function seedBlogImages(): void
    {
        // Matches post order in UrazSeeder:
        // 0 rising-global-demand · 1 reliable-trading-partner · 2 understanding-incoterms
        $keywords = [
            'minerals,africa,trade',
            'handshake,business,trade',
            'cargo,port,shipping',
        ];

        $posts = BlogPost::orderBy('id')->get();
        foreach ($posts as $i => $post) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 300 + $post->id;
            $url  = "https://loremflickr.com/1200/630/{$kw}?lock={$lock}";
            $path = "blog/post-{$post->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $post->update(['image' => $path]);
                echo "  ✓ blog post {$post->id}\n";
            } else {
                echo "  ✗ blog post {$post->id} (download failed)\n";
            }
        }
    }

    // ── Team members (400×400) ─────────────────────────────────────────────────

    private function seedTeamImages(): void
    {
        // Order in UrazSeeder: 0 Uysal Seher (woman) · 1 Kocayigit Nail (man) · 2 Ayoub Oumar (man) · 3 Ibrahim Abakar (man)
        $keywords = [
            'woman,portrait,professional',
            'man,portrait,professional',
            'businessman,portrait,suit',
            'man,office,professional',
        ];

        $members = TeamMember::orderBy('id')->get();
        foreach ($members as $i => $member) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 400 + $member->id;
            $url  = "https://loremflickr.com/400/400/{$kw}?lock={$lock}";
            $path = "team/member-{$member->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $member->update(['photo' => $path]);
                echo "  ✓ team member {$member->id}\n";
            } else {
                echo "  ✗ team member {$member->id} (download failed)\n";
            }
        }
    }

    // ── Testimonials (200×200) ─────────────────────────────────────────────────

    private function seedTestimonialImages(): void
    {
        $keywords = [
            'man,portrait,smile',
            'businessman,portrait,smile',
            'man,portrait,professional',
        ];

        $testimonials = Testimonial::orderBy('id')->get();
        foreach ($testimonials as $i => $testimonial) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 500 + $testimonial->id;
            $url  = "https://loremflickr.com/200/200/{$kw}?lock={$lock}";
            $path = "testimonials/author-{$testimonial->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $testimonial->update(['author_photo' => $path]);
                echo "  ✓ testimonial author {$testimonial->id}\n";
            } else {
                echo "  ✗ testimonial author {$testimonial->id} (download failed)\n";
            }
        }
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    /**
     * Save image bytes directly to disk, bypassing finfo/MIME detection entirely.
     * Storage::disk()->put() triggers league/mime-type-detection which requires
     * the finfo PHP extension — not available on all cPanel servers.
     */
    private function save(string $relativePath, string $bytes): bool
    {
        $absolute = storage_path('app/public/' . $relativePath);
        $dir      = dirname($absolute);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return file_put_contents($absolute, $bytes) !== false;
    }

    private function download(string $url): string|false
    {
        $ctx = stream_context_create([
            'http' => [
                'timeout'         => $this->timeout,
                'follow_location' => true,
                'max_redirects'   => 5,
                'user_agent'      => 'Mozilla/5.0 (compatible; Laravel seeder)',
            ],
        ]);

        $data = @file_get_contents($url, false, $ctx);
        if ($data === false || strlen($data) < 1000) {
            return false;
        }
        return $data;
    }
}
