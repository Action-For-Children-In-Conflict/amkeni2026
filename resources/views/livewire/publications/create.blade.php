<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Add Publication') }}</flux:heading>
        <flux:subheading>{{ __('Create a new publication with document, description, and content.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="savePublication" class="space-y-6">
            {{-- Title --}}
            <flux:input wire:model="title" :label="__('Title')" placeholder="Enter publication title" />

            {{-- Description --}}
            <flux:textarea wire:model="description" :label="__('Description')" placeholder="Enter publication description (10-500 characters)" rows="3" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category --}}
                <flux:select wire:model="category_id" :label="__('Category')" placeholder="Select a category">
                    @foreach($categories as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->title }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Image Upload --}}
                <div>
                    <flux:label>{{ __('Publication Image') }}</flux:label>
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

            {{-- File Upload --}}
            <div>
                <flux:label>{{ __('Publication File (PDF, DOC, DOCX)') }}</flux:label>
                <input type="file" wire:model="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                @error('file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

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

            {{-- Publishing Options --}}
            <div class="space-y-4 bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                <div>
                    <flux:checkbox wire:model="is_published" :label="__('Publish this publication')" />
                </div>
                <div>
                    <flux:checkbox wire:model="is_featured" :label="__('Mark as featured')" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary" color="blue" class="cursor-pointer">
                    {{ __('Create Publication') }}
                </flux:button>
                <flux:button :href="route('admin.publications.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
