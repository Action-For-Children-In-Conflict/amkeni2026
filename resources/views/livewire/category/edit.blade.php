<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Edit Category') }}</flux:heading>
        <flux:subheading>{{ __('Update the details of the category.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="updateCategory" class="space-y-6">
            {{-- title --}}
            <flux:input wire:model="title" :label="__('Name')" placeholder="e.g. Food & Drink" />

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Update Category') }}
                </flux:button>
                <flux:button :href="route('admin.categories.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>