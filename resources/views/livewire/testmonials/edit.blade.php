<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Edit Testimonial') }}</flux:heading>
        <flux:subheading>{{ __('Update the testimonial from :name.', ['name' => $testmonial->name]) }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="updateTestmonial" class="space-y-6">
            {{-- Name --}}
            <flux:input wire:model="name" :label="__('Name')" placeholder="Enter testimonial author's name" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Position --}}
                <flux:input wire:model="position" :label="__('Position/Title')" placeholder="e.g., CEO, Manager" />

                {{-- Image Upload --}}
                <div>
                    <flux:label>{{ __('Profile Image') }}</flux:label>
                    <input type="file" wire:model="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Current Image --}}
            @if ($testmonial->image && !$image)
                <div>
                    <flux:label>{{ __('Current Image') }}</flux:label>
                    <div class="mt-2 relative inline-block">
                        <img src="{{ asset('storage/' . $testmonial->image) }}" class="h-32 w-32 rounded-full object-cover shadow-md border border-gray-200 dark:border-gray-700">
                    </div>
                </div>
            @endif

            {{-- New Image Preview --}}
            @if ($image)
                <div class="mt-4">
                    <flux:label>{{ __('New Image Preview') }}</flux:label>
                    <div class="mt-2 relative inline-block">
                        <img src="{{ $image->temporaryUrl() }}" class="h-32 w-32 rounded-full object-cover shadow-md border border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                            <flux:icon icon="x-mark" variant="mini" />
                        </button>
                    </div>
                </div>
            @endif

            {{-- Testimonial Content --}}
            <flux:textarea wire:model="content" :label="__('Testimonial')" placeholder="Enter the testimonial quote (20-1000 characters)" rows="5" />

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Update Testimonial') }}
                </flux:button>
                <flux:button :href="route('admin.testmonials.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
