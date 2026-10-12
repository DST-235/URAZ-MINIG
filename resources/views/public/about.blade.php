@extends('layouts.public')
@section('title',__('messages.nav_about'))

@section('content')
{{-- SLIDER --}}
@include('components.page-slider', ['sliders'=>$sliders, 'title'=>__('messages.nav_about'), 'subtitle'=>__('messages.about_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge-pill badge-blue mb-3">{{ __('messages.our_story') }}</span>
                <h2 class="section-title mb-4">{{ __('messages.about_title') }}</h2>
                @if($page && $page->content)
                    <div style="color:var(--text-body);line-height:1.8;">{!! $page->content !!}</div>
                @else
                    <p>{{ __('messages.about_p1') }}</p>
                    <p class="mt-3">{{ __('messages.about_p2') }}</p>
                @endif
                <div class="row g-3 mt-3">
                    <div class="col-6">
                        <div class="highlight-block">
                            <strong>{{ __('messages.founded') }}</strong>
                            <div style="font-size:0.85rem;color:var(--text-muted);">{{ __('messages.location') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="highlight-block">
                            <strong>{{ __('messages.expertise') }}</strong>
                            <div style="font-size:0.85rem;color:var(--text-muted);">{{ __('messages.expertise_val') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                @php $aboutImg = \App\Models\Setting::get('about_image'); @endphp
                <div style="border-radius:20px;overflow:hidden;height:400px;background:linear-gradient(135deg,#0A1628,#1565C0);">
                    @if($aboutImg)
                        <img src="{{ asset('storage/'.$aboutImg) }}" alt="{{ __('messages.nav_about') }}"
                             style="width:100%;height:100%;object-fit:cover;display:block;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:1rem;padding:2rem;text-align:center;">
                            <i class="fas fa-globe-africa" style="font-size:5rem;color:rgba(255,255,255,0.3);"></i>
                            <p style="color:rgba(255,255,255,0.7);font-size:1.1rem;">{{ __('messages.serving_africa') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission / Vision / Values --}}
<section class="section-pad bg-light-sth">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div style="background:#fff;border-radius:16px;padding:2rem;height:100%;border:1px solid var(--border);">
                    <div class="service-icon mb-3"><i class="fas fa-bullseye"></i></div>
                    <h5 style="font-weight:700;margin-bottom:0.75rem;">{{ __('messages.our_mission') }}</h5>
                    <p style="color:var(--text-muted);">{{ __('messages.mission_text') }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div style="background:#fff;border-radius:16px;padding:2rem;height:100%;border:1px solid var(--border);">
                    <div class="service-icon mb-3"><i class="fas fa-eye"></i></div>
                    <h5 style="font-weight:700;margin-bottom:0.75rem;">{{ __('messages.our_vision') }}</h5>
                    <p style="color:var(--text-muted);">{{ __('messages.vision_text') }}</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div style="background:#fff;border-radius:16px;padding:2rem;height:100%;border:1px solid var(--border);">
                    <div class="service-icon mb-3"><i class="fas fa-heart"></i></div>
                    <h5 style="font-weight:700;margin-bottom:0.75rem;">{{ __('messages.our_values') }}</h5>
                    <ul style="color:var(--text-muted);padding-{{ app()->getLocale()=='ar' ? 'right' : 'left' }}:1.25rem;font-size:0.9rem;">
                        <li>{{ __('messages.value_1') }}</li>
                        <li>{{ __('messages.value_2') }}</li>
                        <li>{{ __('messages.value_3') }}</li>
                        <li>{{ __('messages.value_4') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
@if($stats->count())
<section class="stats-section">
    <div class="container">
        <div class="row g-3 justify-content-center">
            @foreach($stats as $stat)
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="{{ $stat->icon }}"></i></div>
                    <div class="stat-number">{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->label }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Team Preview --}}
@if($team->count())
<section class="section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-pill badge-blue mb-3">{{ __('messages.our_team') }}</span>
            <h2 class="section-title">{{ __('messages.meet_leadership') }}</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($team as $member)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="team-card">
                    <div class="team-photo-placeholder"><i class="fas fa-user"></i></div>
                    <div class="team-info">
                        <div class="team-name">{{ $member->name }}</div>
                        <div class="team-position">{{ $member->position }}</div>
                        <div class="team-social">
                            @if($member->linkedin)<a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                            @if($member->twitter)<a href="{{ $member->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                            @if($member->email)<a href="mailto:{{ $member->email }}"><i class="fas fa-envelope"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('team') }}" class="btn-primary-sth">{{ __('messages.view_all') }} {{ __('messages.our_team') }}</a>
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
                    <h2 class="section-title">{{ __('messages.faq') }}</h2>
                </div>
                @foreach($faqs as $faq)
                <div class="faq-item" data-aos="fade-up">
                    <div class="faq-question"><span>{{ $faq->question }}</span><i class="fas fa-chevron-down faq-icon"></i></div>
                    <div class="faq-answer"><p style="color:var(--text-body);margin:0;">{{ $faq->answer }}</p></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="cta-title">{{ __('messages.about_cta_title') }}</h2>
        <p class="cta-text mb-4">{{ __('messages.about_cta_sub') }}</p>
        <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.contact_us') }}</a>
    </div>
</section>
@endsection
