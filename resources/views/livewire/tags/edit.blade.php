<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Edit Tag') }}</flux:heading>
        <flux:subheading>{{ __('Update details for the :name tag.', ['name' => $tag->title]) }}</flux:subheading>
    </header>

    <flux:card class="max-w-xl">
        <form wire:submit="save" class="space-y-6">
            <flux:field>
                <flux:label>{{ __('Tag title') }}</flux:label>
                <flux:input wire:model="title" placeholder="{{ __('e.g. Education, Health...') }}" value="{{$tag->title}}" />
                <flux:error name="title" />
            </flux:field>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button :href="route('admin.tags.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}</flux:button>
                <flux:button type="submit" variant="primary" color="blue">
                    {{ __('Update Tag') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>