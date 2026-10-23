<div class="p-6">
    <header class="mb-6 flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ __('Enquiries') }}</flux:heading>
            <flux:subheading>{{ __('Messages from the contact, volunteer and partner forms.') }}</flux:subheading>
        </div>
    </header>

    @include('layouts.errors.base')

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center">
        <div class="w-full max-w-md">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                :placeholder="__('Search name, email, organization or subject...')" clearable />
        </div>

        <div class="w-full sm:w-48">
            <flux:select wire:model.live="type">
                <flux:select.option value="">{{ __('All types') }}</flux:select.option>
                @foreach ($types as $value => $label)
                    <flux:select.option value="{{ $value }}">{{ $label }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
            <thead class="bg-zinc-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500">{{ __('From') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500">{{ __('Type') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500">{{ __('Subject') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-zinc-500">{{ __('Received') }}</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-zinc-500">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse ($contacts as $contact)
                    <tr wire:key="contact-{{ $contact->id }}">
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $contact->name }}</div>
                            <div class="text-sm text-zinc-500">{{ $contact->email }}</div>
                            @if ($contact->organization)
                                <div class="text-xs text-zinc-400">{{ $contact->organization }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <flux:badge color="{{ match ($contact->type) {
                                \App\Enums\ContactType::Volunteer => 'orange',
                                \App\Enums\ContactType::Partner => 'green',
                                default => 'blue',
                            } }}">
                                {{ $contact->type->label() }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $contact->subject ?: \Illuminate\Support\Str::limit($contact->message, 60) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                            {{ $contact->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <flux:button wire:click="openViewModal({{ $contact->id }})" variant="ghost" size="sm" icon="eye" class="cursor-pointer">
                                {{ __('View') }}
                            </flux:button>
                            <flux:button wire:click="openDeleteModal({{ $contact->id }})" variant="ghost" color="red" size="sm" icon="trash" class="cursor-pointer">
                                {{ __('Delete') }}
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-zinc-500">
                            {{ __('No enquiries found.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>

    <!-- View Enquiry Modal -->
    <flux:modal name="view-contact" variant="filled" class="w-full max-w-2xl">
        @if ($viewingContact)
            <div class="space-y-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <flux:heading size="lg">{{ $viewingContact->subject ?: __('Enquiry details') }}</flux:heading>
                        <flux:subheading>{{ $viewingContact->created_at->format('d M Y, H:i') }}</flux:subheading>
                    </div>
                    <flux:badge>{{ $viewingContact->type->label() }}</flux:badge>
                </div>

                <dl class="grid grid-cols-1 gap-3 text-sm sm:grid-cols-2">
                    <div>
                        <dt class="font-medium text-zinc-500">{{ __('Name') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">{{ $viewingContact->name }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-zinc-500">{{ __('Email') }}</dt>
                        <dd>
                            <a href="mailto:{{ $viewingContact->email }}" class="text-blue-600 hover:underline">{{ $viewingContact->email }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium text-zinc-500">{{ __('Phone') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">{{ $viewingContact->phone ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-zinc-500">{{ __('Organization') }}</dt>
                        <dd class="text-zinc-900 dark:text-white">{{ $viewingContact->organization ?: '-' }}</dd>
                    </div>
                </dl>

                <div>
                    <dt class="mb-1 text-sm font-medium text-zinc-500">{{ __('Message') }}</dt>
                    <div class="whitespace-pre-line rounded-lg bg-zinc-50 p-4 text-sm text-zinc-800 dark:bg-zinc-800 dark:text-zinc-200">{{ $viewingContact->message }}</div>
                </div>

                <div class="flex justify-end gap-2">
                    <flux:button href="mailto:{{ $viewingContact->email }}" variant="primary" icon="envelope">
                        {{ __('Reply by email') }}
                    </flux:button>
                    <flux:modal.close>
                        <flux:button variant="ghost">{{ __('Close') }}</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        @endif
    </flux:modal>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-contact" variant="filled" class="min-w-[22rem]">
        <form wire:submit="confirmDelete" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure?') }}</flux:heading>
                <flux:subheading>
                    {{ __('This action cannot be undone. This will permanently delete the enquiry.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" color="red">{{ __('Delete Enquiry') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
