<?php

namespace App\Livewire\Publications;

use App\Models\Publication;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    public $search = '';

    public ?int $publicationIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->publicationIdToDelete = $id;
        $this->modal('delete-publication')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->publicationIdToDelete = null;
        $this->modal('delete-publication')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->publicationIdToDelete)) {
            return;
        }

        Publication::findOrFail($this->publicationIdToDelete)->delete();

        session()->flash('danger', __('Publication deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.publications.index', [
            'publications' => Publication::where('title', 'like', '%' . $this->search . '%')
                ->with(['user', 'category'])
                ->latest()
                ->paginate(10),
        ]);
    }
}
