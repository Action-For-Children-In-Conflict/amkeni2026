<?php

namespace App\Livewire\Jobs;

use App\Models\Job;
use Flux\Concerns\InteractsWithComponents;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use InteractsWithComponents, WithPagination;

    public string $search = '';

    public ?int $jobIdToDelete = null;

    public function openDeleteModal(int $id): void
    {
        $this->jobIdToDelete = $id;
        $this->modal('delete-job')->show();
    }

    public function closeDeleteModal(): void
    {
        $this->jobIdToDelete = null;
        $this->modal('delete-job')->close();
    }

    public function confirmDelete(): void
    {
        if (is_null($this->jobIdToDelete)) {
            return;
        }

        Job::findOrFail($this->jobIdToDelete)->delete();

        session()->flash('danger', __('Job deleted successfully.'));

        $this->closeDeleteModal();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.jobs.index', [
            'jobs' => Job::where('title', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate(10),
        ]);
    }
}
