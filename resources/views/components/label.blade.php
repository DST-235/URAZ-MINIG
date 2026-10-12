@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label']) }} style="color:var(--text-tertiary);font-size:0.83rem;font-weight:500;">
    {{ $value ?? $slot }}
</label>
