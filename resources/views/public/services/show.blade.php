@extends('layouts.public')
@section('title',$service->name)
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>$service->name,'subtitle'=>$service->short_description])

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="service-icon mb-3" style="width:70px;height:70px;font-size:1.8rem;"><i class="{{ $service->icon }}"></i></div>
                <h2 class="section-title mb-3">{{ $service->name }}</h2>
                <div style="color:var(--text-body);line-height:1.8;">{!! nl2br(e($service->description)) !!}</div>

                @php $rawFeatures = $service->getTranslation('features',app()->getLocale()) ?: $service->getTranslation('features','en'); $features = $rawFeatures ? explode('|',$rawFeatures) : []; @endphp
                @if(count($features) > 0)
                <h4 class="mt-5 mb-3" style="font-weight:700;">{{ __('messages.key_features') }}</h4>
                <div class="row g-3">
                    @foreach($features as $feature)
                    @if(trim($feature))
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div style="display:flex;align-items:center;gap:0.75rem;padding:0.9rem 1.1rem;background:var(--light-bg);border-radius:10px;border:1px solid var(--border);">
                            <i class="fas fa-check-circle" style="color:var(--blue);flex-shrink:0;"></i>
                            <span style="font-size:0.9rem;font-weight:500;color:var(--text-dark);">{{ trim($feature) }}</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif

                @if($faqs->count())
                <h4 class="mt-5 mb-3" style="font-weight:700;">{{ __('messages.faq') }}</h4>
                @foreach($faqs as $faq)
                <div class="faq-item">
                    <div class="faq-question"><span>{{ $faq->question }}</span><i class="fas fa-chevron-down faq-icon"></i></div>
                    <div class="faq-answer"><p style="color:var(--text-body);margin:0;">{{ $faq->answer }}</p></div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div style="background:var(--light-bg);border-radius:16px;padding:2rem;margin-bottom:1.5rem;border:1px solid var(--border);">
                    <h6 style="font-weight:700;margin-bottom:1rem;">{{ __('messages.get_service') }}</h6>
                    <p style="font-size:0.875rem;color:var(--text-muted);">{{ __('messages.get_service_text') }}</p>
                    <a href="{{ route('contact') }}" class="btn-primary-sth" style="width:100%;text-align:center;display:block;">{{ __('messages.get_quote') }}</a>
                </div>
                @if($others->count())
                <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid var(--border);">
                    <h6 style="font-weight:700;margin-bottom:1rem;">{{ __('messages.other_services') }}</h6>
                    @foreach($others as $other)
                    <a href="{{ route('services.show',$other->slug) }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.65rem 0;border-bottom:1px solid var(--border);color:var(--text-body);font-size:0.875rem;transition:var(--transition);" onmouseover="this.style.color='var(--blue)'" onmouseout="this.style.color='var(--text-body)'">
                        <i class="{{ $other->icon }}" style="color:var(--blue);width:18px;text-align:center;"></i>{{ $other->name }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="cta-title">{{ __('messages.service_cta_title') }}</h2>
        <p class="cta-text mb-4">{{ __('messages.service_cta_sub') }}</p>
        <a href="{{ route('contact') }}" class="btn-white">{{ __('messages.contact_us') }}</a>
    </div>
</section>
@endsection
