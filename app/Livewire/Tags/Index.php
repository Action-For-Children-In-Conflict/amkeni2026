<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $tagIdBeingDeleted = null;

    public function openDeleteModal($id)
    {
        $this->tagIdBeingDeleted = $id;
        $this->dispatch('modal-show', name: 'delete-tag');
    }

    public function confirmDelete()
    {
        Tag::find($this->tagIdBeingDeleted)?->delete();
        $this->dispatch('modal-close', name: 'delete-tag');
        $this->tagIdBeingDeleted = null;
        session()->flash('message', __('Tag deleted successfully.'));
    }

    public function render()
    {
        return view('livewire.tags.index', [
            'tags' => Tag::where('name', 'like', '%' . $this->search . '%')
                ->withCount('programs')
                ->latest()
                ->paginate(10),
        ]);
    }
}
