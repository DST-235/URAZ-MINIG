<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Setting, Slider, Project, BlogPost, TeamMember, Testimonial};

class ImageSeeder extends Seeder
{
    private int $timeout = 20;

    public function run(): void
    {
        $this->seedAboutImage();
        $this->seedSliderImages();
        $this->seedProjectImages();
        $this->seedBlogImages();
        $this->seedTeamImages();
        $this->seedTestimonialImages();

        echo "Images seeded successfully!\n";
    }

    // ── About image (800×500) ──────────────────────────────────────────────────

    private function seedAboutImage(): void
    {
        $url  = 'https://loremflickr.com/800/500/office,team,technology?lock=10';
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
        // Indexed to match slider creation order in SthSeeder:
        // 0 home/0 · 1 home/1 · 2 home/2 · 3 about · 4 services · 5 portfolio · 6 contact · 7 blog
        $keywords = [
            'technology,digital,africa',
            'business,handshake,africa',
            'computer,programming,office',
            'team,office,meeting',
            'server,technology,innovation',
            'laptop,work,design',
            'phone,office,communication',
            'writing,technology,blog',
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

    // ── Projects (800×500) ─────────────────────────────────────────────────────

    private function seedProjectImages(): void
    {
        // Matches project order in SthSeeder:
        // 0 Al Hilali Cargo · 1 Hilal Shoes · 2 Abouna Dubai Market · 3 Soug Hanana · 4 STH Website
        $keywords = [
            'logistics,truck,cargo',
            'shoes,retail,store',
            'market,africa,trade',
            'bazaar,market,vendors',
            'web,laptop,design',
        ];

        $projects = Project::orderBy('id')->get();
        foreach ($projects as $i => $project) {
            $kw   = $keywords[$i % count($keywords)];
            $lock = 200 + $project->id;
            $url  = "https://loremflickr.com/800/500/{$kw}?lock={$lock}";
            $path = "projects/project-{$project->id}.jpg";

            $bytes = $this->download($url);
            if ($bytes && $this->save($path, $bytes)) {
                $project->update(['image' => $path]);
                echo "  ✓ project {$project->id}\n";
            } else {
                echo "  ✗ project {$project->id} (download failed)\n";
            }
        }
    }

    // ── Blog posts (1200×630) ──────────────────────────────────────────────────

    private function seedBlogImages(): void
    {
        // Matches blog post order:
        // 0 digital-transformation-chad · 1 market-management-system-chad · 2 choosing-it-partner-chad
        $keywords = [
            'technology,africa,digital',
            'market,africa,business',
            'handshake,office,business',
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
        // All 4 members are men (Ayoub, Mohamed, Mohamed, Haroun)
        $keywords = [
            'man,portrait,professional',
            'businessman,portrait,suit',
            'man,office,professional',
            'man,portrait,smile',
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
        // All 3 clients are men (Djibrine, Abouna, Mohamed)
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
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
        ]);

        $data = @file_get_contents($url, false, $ctx);
        if ($data === false || strlen($data) < 1000) {
            return false;
        }
        return $data;
    }
}
