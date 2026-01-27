@props(['name', 'title'])

<div x-data="{ show: false, name: @js($name) }" x-show="show" @open-modal.window="if ($event.detail === name) show = true;" @keydown.escape.window="show = false" x-transition:enter="duration-300" x-transition:enter-start="opacity-0" x-transition:leave="duration-300" x-transition:enter-end="opacity-100" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs" role="dialog" aria-modal="true" aria-labelledBy="modal-{{ $name }}-title" :aria-hidden="!show" tabindex="-1">
    <x-card @click.away="show = false">
        <div>
            <h2; id="modal-{{ $name }}-title" class="text-xl font-bold">{{ $title }}</h2;>
        </div>
        <div>
            {{ $slot }}
        </div>
    </x-card>

</div>
