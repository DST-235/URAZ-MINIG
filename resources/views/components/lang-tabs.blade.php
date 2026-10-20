<div class="mb-3">
    @foreach(config('locales') as $code => $l)
    <span class="lang-tab" data-lang="{{ $code }}">{{ $l['flag'] }} {{ $l['native'] }}</span>
    @endforeach
</div>
