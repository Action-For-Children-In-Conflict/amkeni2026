<?php

namespace App\Livewire\Contacts;

use App\Enums\ContactType;
use App\Models\Contact;
use Flux\Concerns\InteractsWithComponents;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use InteractsWithComponents, WithPagination;

    public string $search = '';

    public string $type = '';

    public ?int $contactIdToView = null;

    public ?int $contactIdToDelete = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingType(): void
    {
        $this->resetPage();
    }

    public function openViewModal(int $id): void
    {
        $this->contactIdToView = $id;
        $this->modal('view-contact')->show();
    }

    public function closeViewModal(): void
    {
        $this->contactIdToView = null;
        $this->modal('view-contact')->close();
    }

    public function openDeleteModal(int $id): void
    {
        $this->contactIdToDelete = $id;
        $this->modal('delete-contact')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->contactIdToDelete = null;
        $this->modal('delete-contact')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->contactIdToDelete)) {
            return;
        }

        Contact::findOrFail($this->contactIdToDelete)->delete();

        session()->flash('danger', __('Enquiry deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        $search = trim($this->search);

        return view('livewire.contacts.index', [
            'contacts' => Contact::query()
                ->when($search !== '', function ($query) use ($search): void {
                    $query->where(function ($query) use ($search): void {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('organization', 'like', "%{$search}%")
                            ->orWhere('subject', 'like', "%{$search}%");
                    });
                })
                ->when($this->type !== '', fn ($query) => $query->where('type', $this->type))
                ->latest()
                ->paginate(15),
            'viewingContact' => $this->contactIdToView ? Contact::find($this->contactIdToView) : null,
            'types' => ContactType::options(),
        ]);
    }
}
