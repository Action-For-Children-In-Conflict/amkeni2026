<div class="p-6">

    <header class="mb-6">
        <flux:heading size="xl">{{ __('Edit Program') }}</flux:heading>
        <flux:subheading>{{ __('Update the details for :title', ['title' => $program->title]) }}</flux:subheading>
    </header>

    <form wire:submit="save" class="space-y-6 max-w-2xl">
        <flux:field>
            <flux:label>{{ __('Title') }}</flux:label>
            <flux:input wire:model="title" placeholder="{{ __('Enter program title') }}" />
            <flux:error name="title" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Tag') }}</flux:label>
            <flux:select wire:model="tag_id" placeholder="{{ __('Select a tag') }}">
                @foreach ($tags as $tag)
                    <flux:select.option value="{{ $tag->id }}" style="color: green !important;">{{ $tag->title }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="tag_id" />
        </flux:field>

        {{-- Image Upload --}}
        <div>
            <flux:label>{{ __('Program Image') }}</flux:label>
            <input type="file" wire:model="image"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200" />
            <flux:error name="image" />
        </div>

        {{-- Image Preview --}}
        <div class="mt-4">
            <flux:label>{{ __('Current/New Image Preview') }}</flux:label>
            <div class="mt-2 relative inline-block">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}"
                        class="h-40 w-auto rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700">
                    <button type="button" wire:click="$set('image', null)"
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600">
                        <flux:icon icon="x-mark" variant="mini" />
                    </button>
                @elseif ($program->image_url)
                    <img src="{{ asset($program->image_url) }}"
                        class="h-40 w-auto rounded-lg object-cover shadow-md border border-gray-200 dark:border-gray-700">
                @endif
            </div>
        </div>
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
                        class="min-h-[300px] bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm">
                    </div>
                </div>

                <flux:error name="content" />
            </flux:field>
        </div>

        <div class="flex gap-4 mt-10 py-7 justify-end">
            <flux:spacer />
            <flux:button :href="route('admin.programs.index')" variant="ghost" wire:navigate>{{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary" color="blue">{{ __('Update Program') }}</flux:button>
        </div>
    </form>
</div>
