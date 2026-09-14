<div class="p-6">
     <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Programs') }}</flux:heading>
            <flux:subheading>{{ __('Manage your organization programs and initiatives.') }}</flux:subheading>
        </div>

        <flux:button :href="route('admin.programs.create')" variant="primary" color="blue" wire:navigate class="cursor-pointer">
            {{ __('Add Program') }}
        </flux:button>
    </header>

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-200"
                placeholder="{{ __('Search programs...') }}"
            />
            <div wire:loading wire:target="search" class="absolute right-3 top-2.5">
                <flux:icon icon="arrow-path" class="size-4 animate-spin text-zinc-400" />
            </div>
        </div>
    </div>

   @include('layouts.errors.base')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($programs as $program)
            <div wire:key="{{ $program->id }}" class="bg-white dark:bg-zinc-900 rounded-lg shadow-md overflow-hidden flex flex-col">
                <img src="{{ asset($program->image_url) }}" alt="{{ $program->title }}" class="w-full h-48 object-cover">
                <div class="p-4 flex flex-col flex-1">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200 mb-2">{{ $program->title }}</h3>
                  {{--   <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4 line-clamp-3">{!! $program->content !!}</p> --}}
                    <div class="mt-auto flex gap-2">
                        <flux:button icon="pencil-square" :href="route('admin.programs.edit', $program)" variant="ghost" size="sm" wire:navigate class="cursor-pointer">
                            {{ __('Edit') }}
                        </flux:button>
                        <flux:button icon="trash" wire:click="openDeleteModal({{ $program->id }})" variant="ghost" color="red" size="sm" class="cursor-pointer">
                            {{ __('Delete') }}
                        </flux:button>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-zinc-500 py-12">{{ __('No programs found.') }}</p>
        @endforelse
    </div>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-program" variant="filled" class="min-w-[22rem]">
        <form wire:submit="confirmDelete" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
                <flux:subheading>
                    {{ __('This action cannot be undone. This will permanently delete the program.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary" color="red">{{ __('Delete Program') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="mt-6">
        {{ $programs->links() }}
    </div>
</div>