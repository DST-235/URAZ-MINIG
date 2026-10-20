@extends('layouts.public')
@section('title',__('messages.privacy'))
@section('content')
<section class="page-hero" style="min-height:280px;">
    <div class="page-hero-bg" style="background:linear-gradient(135deg,#1A140F,#C9A227);"></div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content container w-100">
        <h1 class="page-hero-title">{{ __('messages.privacy') }}</h1>
    </div>
</section>
<section class="section-pad"><div class="container"><div class="row justify-content-center"><div class="col-lg-8" style="line-height:1.9;color:var(--text-body);">{!! $page ? $page->content : '<p>'.e(__('messages.privacy_fallback')).'</p>' !!}</div></div></div></section>
@endsection
