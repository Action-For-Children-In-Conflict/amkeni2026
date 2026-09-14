<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Tag') }}</flux:heading>
        <flux:subheading>{{ __('Create a new tag to organize your content.') }}</flux:subheading>
    </header>

    <flux:card class="max-w-xl">
        <form wire:submit="save" class="space-y-6">
            <flux:field>
                <flux:label>{{ __('Tag Name') }}</flux:label>
                <flux:input wire:model="title" placeholder="{{ __('e.g. Education, Health...') }}" autofocus />
                <flux:error name="title" />
            </flux:field>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button :href="route('admin.tags.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                <flux:button type="submit" variant="primary"  class="btn"  color="blue">
                    {{ __('Create Tag') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>