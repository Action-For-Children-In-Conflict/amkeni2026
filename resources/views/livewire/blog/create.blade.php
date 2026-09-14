<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Blog Post') }}</flux:heading>
        <flux:subheading>{{ __('Create a new blog post with an image and content.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="saveBlog" class="space-y-6">
            {{-- Title --}}
            <flux:input wire:model="title" :label="__('Title')" placeholder="Enter blog title" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category --}}
                <flux:select wire:model="category_id" :label="__('Category')" placeholder="Select a category">
                    @foreach($categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->title }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Image Upload --}}
                <div>
                    <flux:label>{{ __('Blog Image') }}</flux:label>
                    <input type="file" wire:model="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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
            <div class="space-y-2">
                <flux:label>{{ __('Content') }}</flux:label>
                <div
                    wire:ignore
                    x-data="{
                        value: @entangle('content'),
                        init() {
                            const quill = new Quill($refs.quill, {
                                theme: 'snow',
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline', 'strike'],
                                        [{ 'header': [1, 2, 3, false] }],
                                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                        ['link', 'image', 'code-block'],
                                        ['clean']
                                    ]
                                }
                            });
                            quill.root.innerHTML = this.value;
                            quill.on('text-change', () => this.value = quill.root.innerHTML);
                        }
                    }"
                    class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden"
                >
                    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
                    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
                    <div x-ref="quill" class="min-h-[300px] !border-none text-zinc-900 dark:text-zinc-100"></div>
                </div>
                <flux:error name="content" />
            </div>

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Create Blog') }}
                </flux:button>
                <flux:button :href="route('admin.blogs.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>