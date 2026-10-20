@extends('layouts.public')
@section('title',$post->title)
@section('content')
<section class="page-hero" style="min-height:350px;">
    <div class="page-hero-bg" style="background:linear-gradient(135deg,#1A140F,#C9A227);"></div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content container w-100">
        <div class="breadcrumb-uraz mb-2">
            <a href="{{ route('home') }}">{{ __('messages.breadcrumb_home') }}</a>
            <span>/</span>
            <a href="{{ route('blog') }}">{{ __('messages.breadcrumb_blog') }}</a>
            <span>/</span>
            <span class="current">{{ Str::limit($post->title,40) }}</span>
        </div>
        <h1 class="page-hero-title" style="font-size:clamp(1.5rem,3.5vw,2.5rem);">{{ $post->title }}</h1>
        <div style="display:flex;gap:1.5rem;flex-wrap:wrap;margin-top:0.75rem;color:rgba(255,255,255,0.65);font-size:0.875rem;">
            <span><i class="fas fa-tag me-1" style="color:var(--cyan);"></i>{{ $post->category }}</span>
            <span><i class="far fa-calendar me-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
            @if($post->author)<span><i class="far fa-user me-1"></i>{{ $post->author->name }}</span>@endif
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div style="font-size:1rem;line-height:1.9;color:var(--text-body);">{!! $post->content !!}</div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                @if($related->count())
                <div style="background:var(--light-bg);border-radius:16px;padding:1.5rem;border:1px solid var(--border);">
                    <h6 style="font-weight:700;margin-bottom:1rem;">{{ __('messages.related_posts') }}</h6>
                    @foreach($related as $r)
                    <a href="{{ route('blog.show',$r->slug) }}" style="display:block;padding:0.75rem 0;border-bottom:1px solid var(--border);color:var(--text-dark);">
                        <div style="font-weight:600;font-size:0.875rem;">{{ $r->title }}</div>
                        <div style="font-size:0.78rem;color:var(--text-muted);">{{ $r->published_at?->format('d M Y') }}</div>
                    </a>
                    @endforeach
                </div>
                @endif
                <div style="background:linear-gradient(135deg,#1A140F,#C9A227);border-radius:16px;padding:1.5rem;margin-top:1.5rem;text-align:center;">
                    <h6 style="color:#fff;font-weight:700;margin-bottom:0.75rem;">{{ __('messages.start_project') }}</h6>
                    <p style="color:rgba(255,255,255,0.75);font-size:0.85rem;">{{ __('messages.start_project_text') }}</p>
                    <a href="{{ route('contact') }}" class="btn-white" style="font-size:0.85rem;padding:0.5rem 1.25rem;">{{ __('messages.contact_us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
