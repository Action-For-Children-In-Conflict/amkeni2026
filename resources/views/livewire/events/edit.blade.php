<div class="max-w-2xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="mb-6">
        <flux:heading size="xl">Edit Event</flux:heading>
        <flux:subheading>Update the details for {{ $event->title }}.</flux:subheading>
    </div>

    <form wire:submit="update" class="space-y-6">
        <flux:input label="Title" wire:model="title" placeholder="Event title..." />

        <flux:textarea label="Content" wire:model="content" placeholder="Describe what this event is about..." />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:input type="date" label="Date" wire:model="date" />
            <flux:input type="time" label="Time" wire:model="time" />
        </div>

        <flux:input label="Location" wire:model="location" placeholder="Physical address or online link" />

        <div>
            <flux:input type="file" label="Event Image" wire:model="image_url" accept="image/*" />

            @if ($image_url && ! is_string($image_url))
                <div class="mt-4">
                    <p class="mb-2 text-sm text-zinc-500">New image preview</p>
                    <img src="{{ $image_url->temporaryUrl() }}" class="rounded-lg shadow-md max-h-64 object-cover border border-zinc-200 dark:border-zinc-700">
                </div>
            @elseif ($event->image_url)
                <div class="mt-4">
                    <p class="mb-2 text-sm text-zinc-500">Current image</p>
                    <img src="{{ asset('storage/' . $event->image_url) }}" class="rounded-lg shadow-md max-h-64 object-cover border border-zinc-200 dark:border-zinc-700">
                </div>
            @endif
        </div>

        <flux:select label="Tag" wire:model="tag_id" placeholder="Select a tag...">
            @foreach($tags as $tag)
                <flux:select.option value="{{ $tag->id }}">{{ $tag->title ?? $tag->name }}</flux:select.option>
            @endforeach
        </flux:select>

        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('admin.events.index') }}" wire:navigate variant="ghost">
                Cancel
            </flux:button>

            <flux:button type="submit" variant="primary" class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800">
                Update Event
            </flux:button>
        </div>
    </form>

    <livewire:gallery.manager type="event" :id="$event->id" />
</div>
