<div class="p-6">
    <header class="mb-6">
        <flux:heading size="xl">{{ __('Edit Job') }}</flux:heading>
        <flux:subheading>{{ __('Update the details of this job opening.') }}</flux:subheading>
    </header>

    <flux:card>
        <form wire:submit="updateJob" class="space-y-6">
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
                    <flux:subheading size="sm" class="mt-1">{{ __('Leave empty to keep the current image. Max 10MB.') }}</flux:subheading>
                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Document Upload --}}
                <div>
                    <flux:label>{{ __('Job Document') }}</flux:label>
                    <input type="file" wire:model="document" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
                    <flux:subheading size="sm" class="mt-1">{{ __('Leave empty to keep the current document. PDF, DOC or DOCX. Max 10MB.') }}</flux:subheading>
                    @error('document') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                {{-- Current Image --}}
                <div>
                    <flux:label>{{ __('Current Image') }}</flux:label>
                    <div class="mt-2">
                        <img src="{{ $job->image_url ? asset('storage/' . $job->image_url) : 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $job->title }}" class="h-40 w-auto rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700">
                    </div>
                </div>

                {{-- New Image Preview --}}
                @if ($image)
                    <div>
                        <flux:label>{{ __('New Image Preview') }}</flux:label>
                        <div class="mt-2 relative inline-block">
                            <img src="{{ $image->temporaryUrl() }}" class="h-40 w-auto rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700">
                            <button type="button" wire:click="$set('image', null)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                                <flux:icon icon="x-mark" variant="mini" />
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Current Document --}}
            @if ($job->hasDocument())
                <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <flux:icon icon="document-text" class="size-5 text-zinc-500" />
                            <flux:link :href="asset('storage/' . $job->document_path)" target="_blank">
                                {{ __('View current document') }}
                            </flux:link>
                        </div>

                        <flux:checkbox wire:model="removeDocument" :label="__('Remove this document when saving')" />
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
                    {{ __('Update Job') }}
                </flux:button>
                <flux:button :href="route('admin.jobs.index')" variant="ghost" wire:navigate class="cursor-pointer">
                    {{ __('Cancel') }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
