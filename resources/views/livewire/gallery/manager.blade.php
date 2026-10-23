<div class="mt-8 space-y-6 border-t border-zinc-200 pt-8 dark:border-zinc-700">
    <header>
        <flux:heading size="lg">{{ __('Gallery images') }}</flux:heading>
        <flux:subheading>
            {{ __('Add extra :type images with captions. They appear in the slider on the public detail page.', ['type' => strtolower($typeLabel)]) }}
        </flux:subheading>
    </header>

    <form wire:submit="addImage" class="max-w-2xl space-y-4">
        <flux:field>
            <flux:label>{{ __('Image') }}</flux:label>
            <input type="file" wire:model="photo" accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
            <flux:error name="photo" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Caption') }}</flux:label>
            <flux:input wire:model="caption" placeholder="{{ __('Optional caption for this image') }}" />
            <flux:error name="caption" />
        </flux:field>

        @if ($photo)
            <div>
                <flux:label>{{ __('Preview') }}</flux:label>
                <img src="{{ $photo->temporaryUrl() }}" alt="{{ __('Selected image preview') }}"
                    class="mt-2 h-40 w-auto rounded-lg border border-gray-200 object-cover shadow-md dark:border-gray-700">
            </div>
        @endif

        <div class="flex items-center gap-3">
            <flux:button type="submit" variant="primary" color="blue">{{ __('Add image') }}</flux:button>
            <span wire:loading wire:target="photo" class="text-sm text-zinc-500">{{ __('Uploading...') }}</span>
        </div>
    </form>

    @if ($images->isEmpty())
        <p class="text-sm text-zinc-500">{{ __('No gallery images yet. Upload the first one above.') }}</p>
    @else
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($images as $image)
                <div wire:key="gallery-image-{{ $image->id }}"
                    class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $image->caption ?: __('Gallery image') }}"
                        class="aspect-video w-full object-cover">

                    <div class="space-y-3 p-3">
                        <flux:input wire:model="captions.{{ $image->id }}" wire:blur="updateCaption({{ $image->id }})"
                            placeholder="{{ __('Add a caption') }}" />
                        <flux:error name="captions.{{ $image->id }}" />

                        <div class="flex items-center justify-between">
                            <span class="text-xs text-zinc-500">{{ __('Saved automatically') }}</span>
                            <flux:button size="sm" variant="danger" icon="trash"
                                wire:click="deleteImage({{ $image->id }})"
                                wire:confirm="{{ __('Delete this gallery image?') }}">
                                {{ __('Delete') }}
                            </flux:button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
