@extends('layouts.public')
@section('title',__('messages.nav_operations'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.our_operations'),'subtitle'=>__('messages.operations_slider_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            @forelse($operations as $operation)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <a href="{{ route('operations.show',$operation) }}" class="project-card" style="display:block;text-decoration:none;">
                    @if($operation->image)<img src="{{ asset('storage/'.$operation->image) }}" alt="{{ $operation->title }}" loading="lazy">
                    @else<div class="project-card-placeholder"><i class="fas fa-route"></i></div>@endif
                    <div class="project-card-overlay">
                        <span class="project-badge">{{ __('messages.operation_category_'.$operation->category) }}</span>
                        <div class="project-title">{{ $operation->title }}</div>
                        @if($operation->location)<div class="project-client"><i class="fas fa-map-marker-alt me-1"></i>{{ $operation->location }}</div>@endif
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5"><p style="color:var(--text-muted);">{{ __('messages.no_operations') }}</p></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $operations->links() }}</div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="cta-title">{{ __('messages.operations_cta_title') }}</h2>
        <p class="cta-text mb-4">{{ __('messages.operations_cta_sub') }}</p>
        <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.contact_us') }}</a>
    </div>
</section>
@endsection
