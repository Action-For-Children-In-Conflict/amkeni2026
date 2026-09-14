<?php

namespace App\Livewire\Partners;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    public $search = '';

    public ?int $partnerIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->partnerIdToDelete = $id;
        $this->modal('delete-partner')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->partnerIdToDelete = null;
        $this->modal('delete-partner')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->partnerIdToDelete)) {
            return;
        }

        Partner::findOrFail($this->partnerIdToDelete)->delete();

        session()->flash('danger', __('Partner deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.partners.index', [
            'partners' => Partner::where('name', 'like', '%' . $this->search . '%')
                ->with('user')
                ->latest()
                ->paginate(12),
        ]);
    }
}
