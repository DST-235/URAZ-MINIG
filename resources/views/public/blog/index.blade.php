@extends('layouts.public')
@section('title',__('messages.nav_blog'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.blog_title'),'subtitle'=>__('messages.blog_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="blog-card">
                    <div class="blog-img">
                        @if($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy">
                        @else<i class="fas fa-newspaper" style="font-size:3rem;color:rgba(255,255,255,0.3);"></i>@endif
                    </div>
                    <div class="blog-body">
                        <div class="blog-category">{{ $post->category }}</div>
                        <div class="blog-title">{{ $post->title }}</div>
                        @if($post->excerpt)<p style="color:var(--text-muted);font-size:0.875rem;margin-bottom:1rem;">{{ Str::limit($post->excerpt,120) }}</p>@endif
                        <div class="blog-meta mb-3">
                            <span><i class="far fa-calendar me-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
                            @if($post->author)<span><i class="far fa-user me-1"></i>{{ $post->author->name }}</span>@endif
                        </div>
                        <a href="{{ route('blog.show',$post->slug) }}" class="btn-primary-sth" style="font-size:0.82rem;padding:0.45rem 1rem;">{{ __('messages.read_more') }}</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5"><p style="color:var(--text-muted);">{{ __('messages.no_posts') }}</p></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
