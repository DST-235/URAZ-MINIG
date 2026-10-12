@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div style="padding:1.5rem;border-bottom:1px solid var(--dark-700);">
        <h6 style="color:var(--text-primary);font-weight:600;margin:0;">{{ $title }}</h6>
    </div>
    <div style="padding:1.5rem;color:var(--text-secondary);font-size:0.875rem;">
        {{ $content }}
    </div>
    <div style="padding:1rem 1.5rem;background:var(--bg-primary);border-top:1px solid var(--dark-700);display:flex;justify-content:flex-end;gap:0.5rem;">
        {{ $footer }}
    </div>
</x-modal>
