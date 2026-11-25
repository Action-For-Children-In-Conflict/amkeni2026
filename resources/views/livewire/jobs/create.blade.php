<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Job') }}</flux:heading>
        <flux:subheading>{{ __('Create a new job opening with an image, description, content and document.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="saveJob" class="space-y-6">
            {{-- Title --}}
            <flux:input wire:model="title" :label="__('Job Title')" placeholder="Enter job title" />

            {{-- Description --}}
            <flux:textarea wire:model="description" :label="__('Short Description')"
                placeholder="A short summary of the role shown on the careers page" rows="3" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Image Upload --}}
                <div>
                    <flux:label>{{ __('Job Image') }}</flux:label>
                    <input type="file" wire:model="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                    <flux:subheading size="sm" class="mt-1">{{ __('JPG, PNG or WebP. Max 10MB.') }}</flux:subheading>
                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Document Upload --}}
                <div>
                    <flux:label>{{ __('Job Document') }}</flux:label>
                    <input type="file" wire:model="document" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                    <flux:subheading size="sm" class="mt-1">{{ __('Optional job description document. PDF, DOC or DOCX. Max 10MB.') }}</flux:subheading>
                    @error('document') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Image Preview --}}
            @if ($image)
                <div class="mt-4">
                    <flux:label>{{ __('Image Preview') }}</flux:label>
                    <div class="mt-2 relative inline-block">
                        <img src="{{ $image->temporaryUrl() }}" class="h-40 w-auto rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="$set('image', null)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                            <flux:icon icon="x-mark" variant="mini" />
                        </button>
                    </div>
                </div>
            @endif

            {{-- Content --}}
            <div>
                <x-quill-editor property="content" />
            </div>

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Create Job') }}
                </flux:button>
                <flux:button :href="route('admin.jobs.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
