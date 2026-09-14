<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Publications') }}</flux:heading>
            <flux:subheading>{{ __('Manage your publications, documents, and research papers.') }}</flux:subheading>
        </div>

        <flux:button :href="route('admin.publications.create')" variant="primary" color="blue" wire:navigate
            class="cursor-pointer">
            {{ __('Add Publication') }}
        </flux:button>
    </header>

    <!-- Flash Messages -->
    @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full max-w-md">
            <div class="relative">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                    :placeholder="__('Search publications...')" clearable />
                <div wire:loading wire:target="search" class="absolute right-10 top-2.5">
                    <flux:icon icon="arrow-path" class="h-4 w-4 animate-spin text-gray-400" />
                </div>
            </div>
        </div>
    </div>

    <flux:card class="overflow-hidden !p-0">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800 border border-gray-200 dark:border-gray-800 max-w-full overflow-x-auto">
            <thead class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-6 py-3 w-full">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    {{-- test file and image --}}
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                    </th>
                    {{-- end  --}}


                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                @forelse ($publications as $publication)
                    @php
                        //  dd($publication); // Debugging line to check the value of $publication->file
                    @endphp

                    <tr wire:key="{{ $publication->id }}">

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $publication->id }}
                        </td>
                        {{-- image and file --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if ($publication->file_path)
                                <a href="{{ asset('storage/' . $publication->file_path) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ __('View File') }}
                                </a>
                            @else
                                {{ __('No File') }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if ($publication->image_path)
                                <img src="{{ asset('storage/' . $publication->image_path) }}"
                                    alt="{{ $publication->title }}" class="h-12 w-12 object-cover rounded">
                            @else
                                {{ __('No Image') }}
                            @endif
                        </td>
                        {{-- end --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $publication->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $publication->category->title ?? 'N/A' }}
                        </td>
                        {{-- File and Image --}}

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex gap-2"></div>
                            @if ($publication->is_published)
                                <flux:badge color="green">{{ __('Published') }}</flux:badge>
                            @else
                                <flux:badge color="gray">{{ __('Draft') }}</flux:badge>
                            @endif
                            @if ($publication->is_featured)
                                <flux:badge color="amber">{{ __('Featured') }}</flux:badge>
                            @endif
</div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
    <div class="flex justify-end gap-2">
        <flux:button icon="pencil-square" :href="route('admin.publications.edit', $publication)" variant="ghost"
            size="sm" wire:navigate class="cursor-pointer">
            {{ __('Edit') }}
        </flux:button>
        <flux:button icon="trash" wire:click="openDeleteModal({{ $publication->id }})" variant="ghost" color="red"
            size="sm" class="cursor-pointer">
            {{ __('Delete') }}
        </flux:button>
    </div>
</td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-12 text-center">
        <flux:subheading>{{ __('No publications found.') }}</flux:subheading>
    </td>
</tr>
@endforelse
</tbody>
</table>
</flux:card>

<!-- Delete Confirmation Modal -->
<flux:modal name="delete-publication" variant="filled" class="min-w-[22rem]">
    <form wire:submit="confirmDelete" class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
            <flux:subheading>
                {{ __('This action cannot be undone. This will permanently delete the publication.') }}
            </flux:subheading>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="primary" color="red">{{ __('Delete Publication') }}</flux:button>
        </div>
    </form>
</flux:modal>

@if ($publications->hasPages())
    <div class="mt-6">
        {{ $publications->links() }}
    </div>
@endif
</div>
