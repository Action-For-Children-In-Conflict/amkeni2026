<?php

namespace App\Livewire\Category;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    #[Url(history: true)]
    public string $search = '';

    public ?int $categoryIdToDelete = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openDeleteModal(int $id): void
    {
        $this->categoryIdToDelete = $id;
        $this->modal('delete-category')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->categoryIdToDelete = null;
        $this->modal('delete-category')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->categoryIdToDelete)) {
            return; // Should not happen if modal is opened correctly
        }

        Category::findOrFail($this->categoryIdToDelete)->delete();

        session()->flash('danger', __('Category deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage(); // Reset pagination to ensure the deleted item is removed from the current page
    }

    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::query()
                ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
                ->latest()
                ->paginate(10),
        ]);
    }
}
