<div class="flex h-full w-full flex-1 flex-col gap-8">
    <div class="flex flex-col gap-1">
        <flux:heading size="xl">{{ __('Dashboard') }}</flux:heading>
        <flux:subheading>
            {{ __('A live overview of the content and people managed through the AfCiC website.') }}
        </flux:subheading>
    </div>

    <section class="flex flex-col gap-4">
        <div class="flex flex-wrap items-end justify-between gap-2">
            <flux:heading size="lg">{{ __('Content') }}</flux:heading>
            <flux:text class="text-sm">
                {{ __(':total records across :models models', ['total' => number_format($contentTotal), 'models' => count($contentStats)]) }}
            </flux:text>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5">
            @foreach ($contentStats as $stat)
                <a
                    @if ($stat['route']) href="{{ route($stat['route']) }}" wire:navigate @endif
                    wire:key="content-{{ $stat['icon'] }}"
                    class="group flex flex-col rounded-xl border border-zinc-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-zinc-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-600"
                >
                    <div class="flex items-start justify-between">
                        <span class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                            <flux:icon :name="$stat['icon']" class="size-5" />
                        </span>

                        @if ($stat['this_month'] > 0)
                            <flux:badge size="sm" color="lime" :title="__(':count added this month', ['count' => $stat['this_month']])">
                                +{{ number_format($stat['this_month']) }}
                            </flux:badge>
                        @endif
                    </div>

                    <p class="mt-6 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                        {{ number_format($stat['count']) }}
                    </p>

                    <div class="mt-1 flex items-center justify-between gap-2">
                        <flux:text class="text-sm">{{ $stat['label'] }}</flux:text>

                        @if ($stat['route'])
                            <flux:icon.arrow-up-right class="size-4 text-zinc-400 transition group-hover:text-zinc-700 dark:group-hover:text-zinc-200" />
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="flex flex-col gap-4">
        <div class="flex flex-wrap items-end justify-between gap-2">
            <flux:heading size="lg">{{ __('Platform') }}</flux:heading>
            <flux:text class="text-sm">{{ __('Accounts, teams and invitations.') }}</flux:text>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($platformStats as $stat)
                <div
                    wire:key="platform-{{ $stat['icon'] }}"
                    class="flex flex-col rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900"
                >
                    <div class="flex items-start justify-between">
                        <span class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                            <flux:icon :name="$stat['icon']" class="size-5" />
                        </span>

                        @if ($stat['this_month'] > 0)
                            <flux:badge size="sm" color="lime" :title="__(':count added this month', ['count' => $stat['this_month']])">
                                +{{ number_format($stat['this_month']) }}
                            </flux:badge>
                        @endif
                    </div>

                    <p class="mt-6 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                        {{ number_format($stat['count']) }}
                    </p>

                    <flux:text class="mt-1 text-sm">{{ $stat['label'] }}</flux:text>
                </div>
            @endforeach
        </div>
    </section>
</div>
