@extends('layouts.public')
@section('title',__('messages.nav_highlights'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.nav_highlights'),'subtitle'=>__('messages.highlights_slider_sub')])

@if($stats->count())
<section class="stats-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($stats as $stat)
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="stat-item">
                    <div class="stat-icon-wrap"><i class="{{ $stat->icon }}"></i></div>
                    <div class="stat-number">{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->label }}</div>
                    @if($stat->description)<div style="font-size:0.78rem;color:rgba(255,255,255,0.55);margin-top:0.25rem;">{{ $stat->description }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($testimonials->count())
<section class="section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-pill badge-blue mb-3">{{ __('messages.testimonials') }}</span>
            <h2 class="section-title">{{ __('messages.highlights_testimonials') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="testimonial-card">
                    <div class="stars mb-2">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star"></i>@endfor</div>
                    <p class="testimonial-text">{{ $t->quote }}</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">{{ strtoupper(substr($t->getTranslation('author_name',app()->getLocale()),0,1)) }}</div>
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
@endsection
