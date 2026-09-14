<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Categories') }}</flux:heading>
            <flux:subheading>{{ __('Manage your blog categories.') }}</flux:subheading>
        </div>
        <div class="flex items-center gap-4">
            <flux:button 
                variant="primary" 
                size="sm" 
                x-on:click="document.documentElement.classList.toggle('dark')" 
                icon="moon" 
                aria-label="Toggle Dark Mode"
            />
            <flux:button :href="route('admin.categories.create')" variant="primary" color="blue" wire:navigate>
                {{ __('Add Category') }}
            </flux:button>
        </div>
    </header>

    <!-- Flash Messages -->
   @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full max-w-md">
            <div class="relative">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" :placeholder="__('Search categories...')" clearable />
                <div wire:loading wire:target="search" class="absolute right-10 top-2.5">
                    <flux:icon icon="arrow-path" class="h-4 w-4 animate-spin text-gray-400" />
                </div>
            </div>
        </div>
    </div>

{{-- table --}}
<div class="overflow-x-auto rounded-2xl shadow-lg border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        
        <!-- Table Head -->
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                    ID
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                    Name
                </th>
                <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-200">
            
            @forelse ($categories as $category)
            <tr wire:key="{{ $category->id }}" class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200 cursor-pointer">
                <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                  {{$category->id}}
                </td>
                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                   {{$category->title }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-3">

                        <!-- Edit Button -->
                        <a 
                            href="{{ route('admin.categories.edit', $category->id) }}" 
                            wire:navigate
                            class="p-2 rounded-lg bg-blue-100 hover:bg-blue-200 transition cursor-pointer" 
                            title="{{ __('Edit') }}"
                        >
                            <flux:icon icon="pencil-square" variant="mini" class="w-5 h-5 text-blue-600" />
                        </a>

                        <!-- Delete Button -->
                        <button
                            wire:click.stop="openDeleteModal({{ $category->id }})"
                            class="p-2 rounded-lg bg-red-100 hover:bg-red-200 transition cursor-pointer" title="{{ __('Delete') }}">
                            <flux:icon icon="trash" variant="mini" class="w-5 h-5 text-red-600" />
                        </button>

                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500 italic dark:text-gray-400">
                        {{ __('No categories found matching ":search".', ['search' => $search]) }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($categories->hasPages())
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endif

    <flux:modal name="delete-category" class="min-w-[22rem] space-y-6">
        <div>
            <flux:heading size="lg">{{ __('Delete Category') }}</flux:heading>
            <flux:subheading>
                {{ __('Are you sure you want to delete this category? This action cannot be undone.') }}
            </flux:subheading>
        </div>

        <div class="flex gap-2">
            <flux:spacer />
            <flux:button wire:click="closeDeleteModal" variant="ghost">{{ __('Cancel') }}</flux:button>
            <flux:button wire:click="confirmDelete" variant="danger" loading="confirmDelete">
                {{ __('Delete Category') }}
            </flux:button>
        </div>
    </flux:modal>
</div>
