<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Blogs') }}</flux:heading>
            <flux:subheading>{{ __('Manage your blog posts, images, and content.') }}</flux:subheading>
        </div>

        <flux:button :href="route('admin.blogs.create')" variant="primary" color="blue" wire:navigate class="cursor-pointer">
            {{ __('Add Blog') }}
        </flux:button>
    </header>

    <!-- Flash Messages -->
   @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full max-w-md">
            <div class="relative">
                <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" :placeholder="__('Search blogs...')" clearable />
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                @forelse ($blogs as $blog)
                    <tr wire:key="{{ $blog->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $blog->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $blog->image_url ? asset('storage/' . $blog->image_url) : 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $blog->title }}" class="h-10 w-16 rounded object-cover shadow-sm">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $blog->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <flux:button icon="pencil-square" :href="route('admin.blogs.edit', $blog)" variant="ghost" size="sm" wire:navigate class="cursor-pointer">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button icon="trash" wire:click="openDeleteModal({{ $blog->id }})" variant="ghost" color="red" size="sm" class="cursor-pointer">
                                    {{ __('Delete') }}
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <flux:subheading>{{ __('No blogs found.') }}</flux:subheading>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </flux:card>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-blog" variant="filled" class="min-w-[22rem]">
        <form wire:submit="confirmDelete" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
                <flux:subheading>
                    {{ __('This action cannot be undone. This will permanently delete the blog post.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" color="red">{{ __('Delete Blog') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    @if ($blogs->hasPages())
        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
