@extends('layouts.public')
@section('title',__('messages.nav_portfolio'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.our_projects'),'subtitle'=>__('messages.portfolio_slider_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            @forelse($projects as $project)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="project-card">
                    @if($project->image)<img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" loading="lazy">
                    @else<div class="project-card-placeholder"><i class="fas fa-code"></i></div>@endif
                    <div class="project-card-overlay">
                        <span class="project-badge">{{ $project->category }}</span>
                        <div class="project-title">{{ $project->title }}</div>
                        <div class="project-client"><i class="fas fa-building me-1"></i>{{ $project->client }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5"><p style="color:var(--text-muted);">{{ __('messages.no_projects') }}</p></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $projects->links() }}</div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="cta-title">{{ __('messages.portfolio_cta_title') }}</h2>
        <p class="cta-text mb-4">{{ __('messages.portfolio_cta_sub') }}</p>
        <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.contact_us') }}</a>
    </div>
</section>
@endsection
