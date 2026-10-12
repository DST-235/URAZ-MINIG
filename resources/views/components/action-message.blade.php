@props(['on'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display:none;"
    {{ $attributes->merge(['class' => '']) }}>
    <span style="color:#34d399;font-size:0.82rem;font-weight:500;">
        <i class="fas fa-check-circle me-1"></i>{{ $slot->isEmpty() ? 'Saved.' : $slot }}
    </span>
</div>
