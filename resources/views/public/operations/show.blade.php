@extends('layouts.public')
@section('title',$operation->title)
@section('content')
@include('components.page-slider',['sliders'=>collect(),'title'=>$operation->title,'subtitle'=>$operation->location])

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                @if($operation->image)
                <img src="{{ asset('storage/'.$operation->image) }}" alt="{{ $operation->title }}" style="width:100%;border-radius:16px;margin-bottom:2rem;" loading="lazy">
                @endif
                <span class="badge-pill badge-blue mb-3">{{ __('messages.operation_category_'.$operation->category) }}</span>
                <h2 class="section-title mb-3">{{ $operation->title }}</h2>
                <div style="color:var(--text-body);line-height:1.8;">{!! nl2br(e($operation->description)) !!}</div>

                @if($operation->tags)
                <div class="d-flex flex-wrap gap-2 mt-4">
                    @foreach(explode(',', $operation->tags) as $tag)
                    @if(trim($tag))
                    <span class="badge-pill" style="background:var(--light-bg);color:var(--text-body);border:1px solid var(--border);">{{ trim($tag) }}</span>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div style="background:var(--light-bg);border-radius:16px;padding:2rem;border:1px solid var(--border);">
                    @if($operation->location)
                    <div class="mb-3"><i class="fas fa-map-marker-alt me-2" style="color:var(--gold);"></i><strong>{{ __('messages.operation_location') }}:</strong> {{ $operation->location }}</div>
                    @endif
                    @if($operation->active_since)
                    <div class="mb-3"><i class="fas fa-calendar me-2" style="color:var(--gold);"></i><strong>{{ __('messages.operation_active_since') }}:</strong> {{ $operation->active_since->format('Y') }}</div>
                    @endif
                    <a href="{{ route('contact') }}" class="btn-primary-uraz mt-2" style="width:100%;text-align:center;display:block;">{{ __('messages.contact_us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
