@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="AfCiC" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white p-0.5">
            <x-app-logo-icon class="size-6" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="AfCiC" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-white p-0.5">
            <x-app-logo-icon class="size-6" />
        </x-slot>
    </flux:brand>
@endif
