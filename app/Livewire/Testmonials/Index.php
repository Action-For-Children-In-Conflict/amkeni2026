<?php

namespace App\Livewire\Testmonials;

use App\Models\Testmonial;
use Livewire\Component;
use Livewire\WithPagination;
use Flux\Concerns\InteractsWithComponents;

class Index extends Component
{
    use WithPagination, InteractsWithComponents;

    public $search = '';

    public ?int $testmonialIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->testmonialIdToDelete = $id;
        $this->modal('delete-testmonial')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->testmonialIdToDelete = null;
        $this->modal('delete-testmonial')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->testmonialIdToDelete)) {
            return;
        }

        Testmonial::findOrFail($this->testmonialIdToDelete)->delete();

        session()->flash('danger', __('Testimonial deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.testmonials.index', [
            'testmonials' => Testmonial::where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ]);
    }
}
