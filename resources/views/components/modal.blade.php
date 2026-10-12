@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));
$maxWidthClass = ['sm'=>'max-w-sm','md'=>'max-w-md','lg'=>'max-w-lg','xl'=>'max-w-xl','2xl'=>'max-w-2xl'][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="{{ $id }}"
    class="jetstream-modal"
    style="display:none;position:fixed;inset:0;z-index:9999;overflow-y:auto;padding:2rem 1rem;"
>
    <div x-show="show"
         style="position:fixed;inset:0;background:rgba(0,0,0,0.75);"
         x-on:click="show = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div x-show="show"
         x-trap.inert.noscroll="show"
         class="{{ $maxWidthClass }}"
         style="background:var(--bg-secondary);border:1px solid var(--dark-600);border-radius:12px;overflow:hidden;margin:2rem auto;position:relative;box-shadow:0 25px 50px rgba(0,0,0,0.6);"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        {{ $slot }}
    </div>
</div>
