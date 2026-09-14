<?php

namespace App\Livewire\Programs;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $programIdBeingDeleted = null;

    public function openDeleteModal($id)
    {
        $this->programIdBeingDeleted = $id;
        $this->dispatch('modal-show', name: 'delete-program');
    }

    public function confirmDelete()
    {
        if ($this->programIdBeingDeleted) {
            Program::find($this->programIdBeingDeleted)?->delete();
            session()->flash('danger', __('Program deleted successfully.'));
        }

        $this->dispatch('modal-hide', name: 'delete-program');
        $this->programIdBeingDeleted = null;
    }

    public function render()
    {
        return view('livewire.programs.index', [
            'programs' => Program::query()
                ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
                ->latest()
                ->paginate(12),
        ]);
    }
}
