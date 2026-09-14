<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Partners') }}</flux:heading>
            <flux:subheading>{{ __('Manage your partners and organizations.') }}</flux:subheading>
        </div>

        <flux:button :href="route('admin.partners.create')" variant="primary" color="blue" wire:navigate class="cursor-pointer">
            {{ __('Add Partner') }}
        </flux:button>
    </header>

    <!-- Flash Messages -->
    @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full max-w-md">
            <div class="relative">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" :placeholder="__('Search partners...')" clearable />
                <div wire:loading wire:target="search" class="absolute right-10 top-2.5">
                    <flux:icon icon="arrow-path" class="h-4 w-4 animate-spin text-gray-400" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($partners as $partner)
            <flux:card wire:key="{{ $partner->id }}" class="flex flex-col items-center text-center p-6">
                <img src="{{ asset('storage/' . $partner->image_url) }}" alt="{{ $partner->name }} Logo" class="w-20 h-20 object-contain mb-4 rounded">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $partner->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <flux:badge color="blue">{{ $partner->role }}</flux:badge>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ strip_tags($partner->content) }}</p>
                @if ($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 hover:underline mb-4">
                        {{ __('Visit Website') }} →
                    </a>
                @endif
                <div class="flex gap-2 mt-auto">
                    <flux:button icon="pencil-square" :href="route('admin.partners.edit', $partner)" variant="ghost" size="sm" wire:navigate class="cursor-pointer">
                        {{ __('Edit') }}
                    </flux:button>
                    <flux:button icon="trash" wire:click="openDeleteModal({{ $partner->id }})" variant="ghost" color="red" size="sm" class="cursor-pointer">
                        {{ __('Delete') }}
                    </flux:button>
                </div>
            </flux:card>
        @empty
            <div class="col-span-full text-center py-12">
                <flux:subheading>{{ __('No partners found.') }}</flux:subheading>
            </div>
        @endforelse
    </div>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-partner" variant="filled" class="min-w-[22rem]">
        <form wire:submit="confirmDelete" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
                <flux:subheading>
                    {{ __('This action cannot be undone. This will permanently delete the partner.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" color="red">{{ __('Delete Partner') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    @if ($partners->hasPages())
        <div class="mt-6">
            {{ $partners->links() }}
        </div>
    @endif
</div>
