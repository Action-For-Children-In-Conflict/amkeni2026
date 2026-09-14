<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    public $search = '';

    public ?int $blogIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->blogIdToDelete = $id;
        $this->modal('delete-blog')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->blogIdToDelete = null;
        $this->modal('delete-blog')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->blogIdToDelete)) {
            return;
        }

        Blog::findOrFail($this->blogIdToDelete)->delete();

        session()->flash('danger', __('Blog deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.blog.index', [
            'blogs' => Blog::where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ]);
    }
    
}
