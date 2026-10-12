@if(isset($sliders) && $sliders->count() > 0)
<section class="page-hero-slider hero-slider" style="height:50vh;min-height:320px;max-height:500px;">
    <div class="slider-track">
        @foreach($sliders as $slide)
        <div class="slider-slide">
            @if($slide->image)
            <div class="slider-bg" style="background-image:url('{{ asset('storage/'.$slide->image) }}');"></div>
            @else
            <div class="slider-bg" style="background:linear-gradient(135deg,#0A1628 0%,#1565C0 100%);"></div>
            @endif
            <div class="slider-overlay" style="background:{{ $slide->overlay_color ?? 'rgba(10,22,40,0.70)' }};"></div>
            <div class="slider-content">
                <div class="container">
                    <div class="slider-text-{{ $slide->text_align }}">
                        @php $slideTitle = $slide->title ?: ($title ?? ''); $slideSub = $slide->subtitle ?: ($subtitle ?? ''); @endphp
                        <div class="breadcrumb-sth mb-2"><a href="{{ route('home') }}">{{ __('messages.breadcrumb_home') }}</a><span>/</span><span class="current">{{ $slideTitle }}</span></div>
                        <h1 class="page-hero-title">{{ $slideTitle }}</h1>
                        @if($slideSub)<p class="page-hero-sub mt-2">{{ $slideSub }}</p>@endif
                        @if(($slide->button_text??false) && ($slide->button_link??false))<a href="{{ $slide->button_link }}" class="btn-white mt-3">{{ $slide->button_text }}</a>@endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($sliders->count() > 1)
    <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
    <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
    <div class="slider-controls">@foreach($sliders as $s)<button class="slider-dot {{ $loop->first ? 'active':'' }}"></button>@endforeach</div>
    @endif
</section>
@else
<section class="page-hero" style="min-height:320px;">
    <div class="page-hero-bg" style="background:linear-gradient(135deg,#0A1628 0%,#1565C0 100%);"></div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content container w-100">
        <div class="breadcrumb-sth mb-2"><a href="{{ route('home') }}">{{ __('messages.breadcrumb_home') }}</a><span>/</span><span class="current">{{ $title ?? __('messages.nav_home') }}</span></div>
        <h1 class="page-hero-title">{{ $title ?? '' }}</h1>
        @if(isset($subtitle))<p class="page-hero-sub mt-2">{{ $subtitle }}</p>@endif
    </div>
</section>
@endif
