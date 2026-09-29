<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Testimonial') }}</flux:heading>
        <flux:subheading>{{ __('Create a new testimonial from a client or customer.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="saveTestmonial" class="space-y-6">
            {{-- Name --}}
            <flux:input wire:model="name" :label="__('Title')" placeholder="Enter testimonial author's name" />

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

            {{-- Image Preview --}}
            @if ($image)
                <div class="mt-4">
                    <flux:label>{{ __('Image Preview') }}</flux:label>
                    <div class="mt-2 relative inline-block">
                        <img src="{{ $image->temporaryUrl() }}" class="h-32 w-32 rounded-full object-cover shadow-md border border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="$set('image', null)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                            <flux:icon icon="x-mark" variant="mini" />
                        </button>
                    </div>
                </div>
            @endif

            {{-- Testimonial Content --}}
             <div>
            <flux:field>
                <flux:label>{{ __('Content') }}</flux:label>
                <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
                <div wire:ignore x-data="{
                    content: @entangle('content'),
                    quill: null
                }" x-init="quill = new Quill($refs.editor, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'header': 1 }, { 'header': 2 }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'script': 'sub' }, { 'script': 'super' }],
                            [{ 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ]
                    }
                });
                quill.root.innerHTML = content;
                quill.on('text-change', () => {
                    content = quill.root.innerHTML;
                });
                $watch('content', (value) => {
                    if (value !== quill.root.innerHTML) {
                        quill.root.innerHTML = value;
                    }
                });">
                    <div x-ref="editor"
                        class="min-h-[300px] bg-white dark:bg-zinc-100 text-zinc-900 dark:text-zinc-50 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm">
                    </div>
                </div>

                <flux:error name="content" />
            </flux:field>
        </div>

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Create Testimonial') }}
                </flux:button>
                <flux:button :href="route('admin.testmonials.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
