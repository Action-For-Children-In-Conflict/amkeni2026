<?php

namespace App\Livewire\Jobs;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Job $job;

    public string $title = '';

    public string $description = '';

    public string $content = '';

    public $image;

    public $document;

    public bool $removeDocument = false;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:500',
        'content' => 'required|min:10',
        'image' => 'nullable|image|max:10240',
        'document' => 'nullable|mimes:pdf,doc,docx|max:10240',
        'removeDocument' => 'boolean',
    ];

    public function mount(Job $job): void
    {
        $this->job = $job;
        $this->title = $job->title;
        $this->description = $job->description;
        $this->content = $job->content;
    }

    public function updateJob()
    {
        $this->validate();

        if ($this->image) {
            if ($this->job->image_url) {
                Storage::disk('public')->delete($this->job->image_url);
            }

            $this->job->image_url = $this->image->store('jobs', 'public');
        }

        if ($this->document) {
            if ($this->job->document_path) {
                Storage::disk('public')->delete($this->job->document_path);
            }

            $this->job->document_path = $this->document->store('jobs/documents', 'public');
        } elseif ($this->removeDocument && $this->job->document_path) {
            Storage::disk('public')->delete($this->job->document_path);
            $this->job->document_path = null;
        }

        $this->job->title = $this->title;
        $this->job->slug = Str::slug($this->title);
        $this->job->description = $this->description;
        $this->job->content = $this->content;
        $this->job->save();

        session()->flash('status', __('Job updated successfully.'));

        return $this->redirectRoute('admin.jobs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.jobs.edit');
    }
}
