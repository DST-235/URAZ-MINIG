@extends('layouts.public')
@section('title',__('messages.nav_home'))

@section('content')

{{-- HERO SLIDER --}}
<section class="hero-slider">
    <div class="slider-track">
        @forelse($sliders as $slide)
        <div class="slider-slide">
            @if($slide->image)
            <div class="slider-bg" style="background-image: url('{{ asset('storage/'.$slide->image) }}');"></div>
            @else
            <div class="slider-bg slider-bg-fallback" style="background:linear-gradient(135deg,#0A1628 0%,#{{ ['1565C0','0D47A1','1B5E20','4A148C','BF360C'][($loop->index)%5] }} 100%);"></div>
            @endif
            <div class="slider-overlay" style="background: {{ $slide->overlay_color ?? 'rgba(0,0,0,0.55)' }};"></div>
            <div class="slider-content">
                <div class="container">
                    <div class="slider-text-{{ $slide->text_align }}">
                        <div class="slide-badge" data-aos="fade-up">System Technologie Hanana</div>
                        @if($slide->title)<h1 class="slide-title" data-aos="fade-up" data-aos-delay="100">{{ $slide->title }}</h1>@endif
                        @if($slide->subtitle)<p class="slide-subtitle" data-aos="fade-up" data-aos-delay="200">{{ $slide->subtitle }}</p>@endif
                        @if($slide->button_text || $slide->button_link)
                        <div class="slide-actions" data-aos="fade-up" data-aos-delay="300">
                            @if($slide->button_text && $slide->button_link)
                            <a href="{{ $slide->button_link }}" class="btn-white">{{ $slide->button_text }}</a>
                            @endif
                            <a href="{{ route('contact') }}" class="btn-outline-white">{{ __('messages.contact_us') }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="slider-slide">
            <div class="slider-bg slider-bg-fallback"></div>
            <div class="slider-overlay" style="background:rgba(10,22,40,0.65);"></div>
            <div class="slider-content">
                <div class="container">
                    <div class="slider-text-center">
                        <div class="slide-badge">System Technologie Hanana</div>
                        <h1 class="slide-title">{{ __('messages.hero_title') }}</h1>
                        <p class="slide-subtitle">{{ __('messages.hero_subtitle') }}</p>
                        <div class="slide-actions">
                            <a href="{{ route('services') }}" class="btn-white">{{ __('messages.our_services') }}</a>
                            <a href="{{ route('contact') }}" class="btn-outline-white">{{ __('messages.contact_us') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    @if($sliders->count() > 1)
    <button class="slider-arrow prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
    <button class="slider-arrow next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    <div class="slider-controls">
        @foreach($sliders as $i => $s)<button class="slider-dot {{ $loop->first ? 'active' : '' }}"></button>@endforeach
    </div>
    @endif
    <div class="slider-scrolldown"><i class="fas fa-chevron-down" style="color:rgba(255,255,255,0.6);"></i><span>{{ __('messages.scroll') }}</span></div>
</section>

{{-- ABOUT SNIPPET --}}
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-img-wrap">
                    @php $aboutImg = \App\Models\Setting::get('about_image'); @endphp
                    <div style="border-radius:20px;overflow:hidden;height:460px;background:linear-gradient(135deg,#0A1628,#1565C0);">
                        @if($aboutImg)
                            <img src="{{ asset('storage/'.$aboutImg) }}" alt="{{ __('messages.powering_africa') }}"
                                 style="width:100%;height:100%;object-fit:cover;display:block;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                <div style="text-align:center;color:rgba(255,255,255,0.3);">
                                    <i class="fas fa-laptop-code" style="font-size:6rem;"></i>
                                    <p style="color:rgba(255,255,255,0.5);margin-top:1rem;font-size:1.1rem;">{{ __('messages.powering_africa') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="about-badge">
                        <span class="big">8+</span>
                        <span class="small">{{ __('messages.years_of_excellence') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="badge-pill badge-blue mb-3">{{ __('messages.about_badge') }}</span>
                <h2 class="section-title mb-4">{{ __('messages.home_about_title') }}</h2>
                <p class="section-subtitle mb-4">{{ \App\Models\Setting::get('about_short', __('messages.about_p1')) }}</p>
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="highlight-block">
                            <div style="font-weight:700;color:var(--text-dark);">{{ __('messages.our_services') }}</div>
                            <div style="font-size:0.85rem;color:var(--text-muted);">{{ __('messages.specialized_services') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="highlight-block">
                            <div style="font-weight:700;color:var(--text-dark);">{{ __('messages.our_projects') }}</div>
                            <div style="font-size:0.85rem;color:var(--text-muted);">{{ __('messages.successful_projects') }}</div>
                        </div>
                    </div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:1rem;">
                    <a href="{{ route('about') }}" class="btn-primary-sth">{{ __('messages.learn_more') }}</a>
                    <a href="{{ route('contact') }}" class="btn-outline-sth">{{ __('messages.contact_us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
@if($stats->count())
<section class="stats-section">
    <div class="container">
        <div class="row g-3 justify-content-center">
            @foreach($stats as $stat)
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="{{ $stat->icon }}"></i></div>
                    <div class="stat-number counter" data-target="{{ preg_replace('/[^0-9.]/','',$stat->value) }}" data-suffix="{{ preg_replace('/[0-9.]/','', $stat->value) }}">{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->label }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- SERVICES --}}
<section class="section-pad bg-light-sth">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-pill badge-blue mb-3">{{ __('messages.our_services') }}</span>
            <h2 class="section-title">{{ __('messages.home_services_title') }}</h2>
            <p class="section-subtitle mx-auto mt-2">{{ __('messages.home_services_sub') }}</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="service-card">
                    <div class="service-icon"><i class="{{ $service->icon }}"></i></div>
                    <h5>{{ $service->name }}</h5>
                    <p>{{ Str::limit($service->getTranslation('short_description', app()->getLocale()) ?: $service->getTranslation('short_description','en'), 100) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="learn-more">
                        {{ __('messages.learn_more') }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('services') }}" class="btn-primary-sth">{{ __('messages.view_all') }} {{ __('messages.nav_services') }}</a>
        </div>
    </div>
</section>

{{-- PROJECTS --}}
@if($projects->count())
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge-pill badge-blue mb-3">{{ __('messages.our_projects') }}</span>
                <h2 class="section-title">{{ __('messages.home_projects_title') }}</h2>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <a href="{{ route('portfolio') }}" class="btn-outline-sth">{{ __('messages.view_all') }} {{ __('messages.our_projects') }}</a>
            </div>
        </div>
        <div class="row g-4">
            @foreach($projects as $project)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 70 }}">
                <div class="project-card">
                    @if($project->image)
                    <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" loading="lazy">
                    @else
                    <div class="project-card-placeholder"><i class="fas fa-code"></i></div>
                    @endif
                    <div class="project-card-overlay">
                        <span class="project-badge">{{ $project->category }}</span>
                        <div class="project-title">{{ $project->title }}</div>
                        <div class="project-client"><i class="fas fa-building me-1"></i>{{ $project->client }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="section-pad bg-light-sth">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-pill badge-blue mb-3">{{ __('messages.testimonials') }}</span>
            <h2 class="section-title">{{ __('messages.home_testimonials_title') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="testimonial-card">
                    <div class="stars mb-2">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star"></i>@endfor</div>
                    <p class="testimonial-text">{{ $t->quote }}</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            @if($t->author_photo)<img src="{{ asset('storage/'.$t->author_photo) }}" alt="">
                            @else{{ strtoupper(substr($t->getTranslation('author_name',app()->getLocale()) ?: $t->getTranslation('author_name','en'),0,1)) }}@endif
                        </div>
                        <div>
                            <div class="testimonial-name">{{ $t->author_name }}</div>
                            <div class="testimonial-pos">{{ $t->author_position }} @if($t->author_company)— {{ $t->author_company }}@endif</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- BLOG --}}
@if($posts->count())
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge-pill badge-blue mb-3">{{ __('messages.latest_news') }}</span>
                <h2 class="section-title">{{ __('messages.home_news_title') }}</h2>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <a href="{{ route('blog') }}" class="btn-outline-sth">{{ __('messages.view_all') }}</a>
            </div>
        </div>
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="blog-card">
                    <div class="blog-img">
                        @if($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy">
                        @else<i class="fas fa-newspaper" style="font-size:3rem;color:rgba(255,255,255,0.3);"></i>@endif
                    </div>
                    <div class="blog-body">
                        <div class="blog-category">{{ $post->category }}</div>
                        <div class="blog-title">{{ $post->title }}</div>
                        <div class="blog-meta">
                            <span><i class="far fa-calendar me-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
                            @if($post->author)<span><i class="far fa-user me-1"></i>{{ $post->author->name }}</span>@endif
                        </div>
                        <a href="{{ route('blog.show',$post->slug) }}" class="btn-outline-sth mt-3" style="font-size:0.82rem;padding:0.4rem 1rem;">{{ __('messages.read_more') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FAQ --}}
@if($faqs->count())
<section class="section-pad bg-light-sth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="badge-pill badge-blue mb-3">{{ __('messages.faq') }}</span>
                    <h2 class="section-title">{{ __('messages.home_faq_title') }}</h2>
                </div>
                @foreach($faqs as $faq)
                <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    <div class="faq-question">
                        <span>{{ $faq->question }}</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer"><p style="color:var(--text-body);margin:0;">{{ $faq->answer }}</p></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7" data-aos="fade-right">
                <h2 class="cta-title">{{ __('messages.home_cta_title') }}</h2>
                <p class="cta-text">{{ __('messages.home_cta_sub') }}</p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-left">
                <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:flex-end;">
                    <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.get_quote') }}</a>
                    <a href="tel:{{ preg_replace('/\s+/', '', \App\Models\Setting::get('site_phone','+23560837979')) }}" class="btn-outline-white"><i class="fas fa-phone me-2"></i>{{ __('messages.call_us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
