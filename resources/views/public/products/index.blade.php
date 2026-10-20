@extends('layouts.public')
@section('title',__('messages.nav_products'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.our_products'),'subtitle'=>__('messages.products_slider_sub')])

<section class="section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-pill badge-blue mb-3">{{ __('messages.what_we_do') }}</span>
            <h2 class="section-title">{{ __('messages.our_products') }}</h2>
            <p class="section-subtitle mx-auto mt-2">{{ __('messages.products_sub') }}</p>
        </div>
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="service-card">
                    <div class="service-icon"><i class="{{ $product->icon }}"></i></div>
                    @if($product->category)<span class="badge-pill badge-blue mb-2" style="font-size:0.7rem;">{{ $product->category }}</span>@endif
                    <h5>{{ $product->name }}</h5>
                    <p>{{ Str::limit($product->getTranslation('short_description',app()->getLocale()) ?: $product->getTranslation('short_description','en'), 120) }}</p>
                    <a href="{{ route('products.show',$product->slug) }}" class="learn-more">{{ __('messages.learn_more') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="cta-title">{{ __('messages.products_cta_title') }}</h2>
        <p class="cta-text mb-4">{{ __('messages.products_cta_sub') }}</p>
        <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.get_quote') }}</a>
    </div>
</section>
@endsection
