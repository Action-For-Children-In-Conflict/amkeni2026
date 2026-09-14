<?php

namespace App\Livewire\Staff;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    public $search = '';

    public ?int $staffIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->staffIdToDelete = $id;
        $this->modal('delete-staff')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->staffIdToDelete = null;
        $this->modal('delete-staff')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->staffIdToDelete)) {
            return;
        }

        Staff::findOrFail($this->staffIdToDelete)->delete();

        session()->flash('danger', __('Staff member deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.staff.index', [
            'staff' => Staff::where('name', 'like', '%' . $this->search . '%')
                ->with('user')
                ->latest()
                ->paginate(10),
        ]);
    }
}
