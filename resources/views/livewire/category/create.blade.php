<div>
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Category') }}</flux:heading>
        <flux:subheading>{{ __('Create a new Blog Category.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="saveCategory" class="space-y-6">
            {{-- title --}}
            <flux:input wire:model="title" :label="__('Name')" placeholder="e.g. Food & Drink"  />
                   

                <flux:button type="submit" variant="primary" color="blue" style="cursor: pointer;">{{ __('Create Category') }}</flux:button>
            </div>
        </form>
    </flux:card>
</div>
