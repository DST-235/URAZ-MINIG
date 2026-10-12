<div {{ $attributes->merge(['class' => 'profile-section mb-4']) }}>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title mb-1">{{ $title }}</h6>
            <p class="mb-0" style="font-size:0.8rem;color:var(--text-muted);">{{ $description }}</p>
        </div>
        <div class="card-body">
            {{ $content }}
        </div>
    </div>
</div>
