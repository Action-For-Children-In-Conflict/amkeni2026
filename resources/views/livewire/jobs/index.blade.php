<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Careers') }}</flux:heading>
            <flux:subheading>{{ __('Manage the job openings shown on the careers page.') }}</flux:subheading>
        </div>

        <flux:button :href="route('admin.jobs.create')" variant="primary" color="blue" wire:navigate class="cursor-pointer">
            {{ __('Add Job') }}
        </flux:button>
    </header>

    <!-- Flash Messages -->
    @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full max-w-md">
            <div class="relative">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" :placeholder="__('Search jobs...')" clearable />
                <div wire:loading wire:target="search" class="absolute right-10 top-2.5">
                    <flux:icon icon="arrow-path" class="h-4 w-4 animate-spin text-gray-400" />
                </div>
            </div>
        </div>
    </div>

    <flux:card class="overflow-hidden !p-0">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                @forelse ($jobs as $job)
                    <tr wire:key="{{ $job->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $job->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $job->image_url ? asset('storage/' . $job->image_url) : 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $job->title }}" class="h-10 w-16 rounded object-cover shadow-sm">
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                            <div>{{ $job->title }}</div>
                            <div class="mt-1 max-w-md truncate text-xs font-normal text-gray-500 dark:text-gray-400">
                                {{ $job->description }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if ($job->hasDocument())
                                <a href="{{ asset('storage/' . $job->document_path) }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 hover:underline dark:text-blue-400">
                                    <flux:icon icon="document-text" class="size-4" />
                                    {{ __('View') }}
                                </a>
                            @else
                                <span class="text-gray-400">{{ __('None') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <flux:button icon="pencil-square" :href="route('admin.jobs.edit', $job)" variant="ghost" size="sm" wire:navigate class="cursor-pointer">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button icon="trash" wire:click="openDeleteModal({{ $job->id }})" variant="ghost" color="red" size="sm" class="cursor-pointer">
                                    {{ __('Delete') }}
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <flux:subheading>{{ __('No jobs found.') }}</flux:subheading>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </flux:card>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-job" variant="filled" class="min-w-[22rem]">
        <form wire:submit="confirmDelete" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
                <flux:subheading>
                    {{ __('This action cannot be undone. This will permanently delete the job opening.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" color="red">{{ __('Delete Job') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    @if ($jobs->hasPages())
        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    @endif
</div>
