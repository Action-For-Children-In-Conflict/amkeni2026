{{-- Success Messages --}}
@if (session()->has('message') || session()->has('status'))
    <div x-data="{ show: true }" x-show="show" class="mb-4 flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-900 shadow-sm dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">
        <div class="flex items-center gap-3">
            <flux:icon icon="check-circle" variant="mini" class="size-5 text-emerald-600 dark:text-emerald-500" />
            <div class="text-sm font-medium">
                {{ session('message') ?? session('status') }}
            </div>
        </div>
        <button type="button" x-on:click="show = false" class="ml-auto rounded-md p-1.5 text-emerald-500 hover:bg-emerald-100 focus:outline-none dark:hover:bg-emerald-500/20">
            <flux:icon icon="x-mark" variant="mini" class="size-4" />
        </button>
    </div>
@endif

{{-- Error/Danger Messages --}}
@if (session()->has('danger') || session()->has('error') || $errors->any())
    <div x-data="{ show: true }" x-show="show" class="mb-4 flex flex-col rounded-xl border border-red-100 bg-red-50 p-4 text-red-900 shadow-sm dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <flux:icon icon="exclamation-circle" variant="mini" class="size-5 text-red-600 dark:text-red-500" />
                <div class="text-sm font-bold">
                    @if(session()->has('danger'))
                        {{ session('danger') }}
                    @elseif(session()->has('error'))
                        {{ session('error') }}
                    @elseif($errors->count() === 1)
                        {{ __('There was an error with your submission:') }}
                    @else
                        {{ __('There were :count errors with your submission:', ['count' => $errors->count()]) }}
                    @endif
                </div>
            </div>
            <button type="button" x-on:click="show = false" class="rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none dark:hover:bg-red-500/20">
                <flux:icon icon="x-mark" variant="mini" class="size-4" />
            </button>
        </div>

        @if ($errors->any())
            <ul class="mt-2 list-inside list-disc text-sm space-y-1 ml-8">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif