@props(['submit'])

<div {{ $attributes->merge(['class' => 'profile-section mb-4']) }}>
    <div class="card">
        <div class="card-header d-flex align-items-start justify-content-between">
            <div>
                <h6 class="card-title mb-1">{{ $title }}</h6>
                <p class="mb-0" style="font-size:0.8rem;color:var(--text-muted);">{{ $description }}</p>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit="{{ $submit }}">
                <div class="row g-3">
                    {{ $form }}
                </div>
                @if (isset($actions))
                <div class="d-flex align-items-center justify-content-end gap-3 mt-3 pt-3" style="border-top:1px solid var(--dark-700);">
                    {{ $actions }}
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
