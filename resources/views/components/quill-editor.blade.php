@props(['property' => 'content', 'label' => __('Content')])

<flux:field>
    <flux:label>{{ $label }}</flux:label>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    {{-- Quill keeps its own DOM, so Livewire must not re-render this subtree.
         The entangle binding keeps the Livewire property in sync both ways. --}}
    <div wire:ignore x-data="{
        content: @entangle($property),
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
    });" class="quill-editor">
        <div x-ref="editor"
            class="min-h-[300px] bg-white text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm">
        </div>
    </div>

    <flux:error :name="$property" />
</flux:field>
