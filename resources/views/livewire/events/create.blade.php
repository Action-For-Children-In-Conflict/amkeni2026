<div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="mb-6">
        <flux:heading size="xl">Create New Event</flux:heading>
        <flux:subheading>Enter the details below to publish a new event.</flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <flux:input label="Title" wire:model="title" placeholder="Event title..." />

       {{--  <flux:input label="Slug" wire:model="slug" placeholder="event-url-slug" /> --}}

        <flux:textarea label="Content" wire:model="content" placeholder="Describe what this event is about..." />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:input type="date" label="Date" wire:model="date" />
            <flux:input type="time" label="Time" wire:model="time" />
        </div>

        <flux:input label="Location" wire:model="location" placeholder="Physical address or online link" />

        <div>
            <flux:input type="file" label="Event Image" wire:model="image_url" accept="image/*" />

            @if ($image_url && !is_string($image_url))
                <div class="mt-4">
                    <img src="{{ $image_url->temporaryUrl() }}" class="rounded-lg shadow-md max-h-64 object-cover border border-zinc-200 dark:border-zinc-700">
                </div>
            @endif
        </div>

        {{-- tag_id selection --}}
        <flux:select label="Tag" wire:model="tag_id" placeholder="Select a category...">
            @foreach($tags as $tag)
                <flux:select.option value="{{ $tag->id }}">{{ $tag->name }}</flux:select.option>
            @endforeach
        </flux:select>

        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('admin.events.index') }}" wire:navigate variant="ghost">
                Cancel
            </flux:button>

            <flux:button type="submit" variant="primary" class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800">
                Create Event
            </flux:button>
        </div>
    </form>
</div>
