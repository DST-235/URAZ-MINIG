@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => '']) }} style="color:#f87171;font-size:0.78rem;margin-top:0.25rem;margin-bottom:0;">{{ $message }}</p>
@enderror
