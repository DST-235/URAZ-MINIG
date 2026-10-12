@extends('layouts.public')
@section('title',__('messages.our_team'))
@section('content')
@include('components.page-slider',['sliders'=>$sliders,'title'=>__('messages.our_team'),'subtitle'=>__('messages.team_slider_sub')])

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            @forelse($members as $member)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="team-card">
                    @if($member->photo)<img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="team-photo">
                    @else<div class="team-photo-placeholder"><i class="fas fa-user"></i></div>@endif
                    <div class="team-info">
                        <div class="team-name">{{ $member->name }}</div>
                        <div class="team-position">{{ $member->position }}</div>
                        @if($member->bio)<p style="font-size:0.8rem;color:var(--text-muted);margin-top:0.5rem;">{{ Str::limit($member->bio, 100) }}</p>@endif
                        <div class="team-social">
                            @if($member->linkedin)<a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                            @if($member->twitter)<a href="{{ $member->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                            @if($member->email)<a href="mailto:{{ $member->email }}"><i class="fas fa-envelope"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center"><p>{{ __('messages.no_team') }}</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
