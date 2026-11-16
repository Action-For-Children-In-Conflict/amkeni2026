<?php

namespace App\Livewire\Jobs;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public string $title = '';

    public string $description = '';

    public string $content = '';

    public $image;

    public $document;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:500',
        'content' => 'required|min:10',
        'image' => 'required|image|max:10240', // 10MB Max
        'document' => 'nullable|mimes:pdf,doc,docx|max:10240', // 10MB Max
    ];

    public function saveJob()
    {
        $this->validate();

        $imagePath = $this->image->store('jobs', 'public');
        $documentPath = $this->document?->store('jobs/documents', 'public');

        Job::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'user_id' => Auth::id(),
            'image_url' => $imagePath,
            'description' => $this->description,
            'content' => $this->content,
            'document_path' => $documentPath,
        ]);

        session()->flash('status', __('Job created successfully.'));

        return $this->redirectRoute('admin.jobs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.jobs.create');
    }
}
