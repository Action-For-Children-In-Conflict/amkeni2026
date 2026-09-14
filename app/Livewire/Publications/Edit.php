<?php

namespace App\Livewire\Publications;

use App\Models\Publication;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Publication $publication;
    public $title = '';
    public $description = '';
    public $category_id = '';
    public $content = '';
    public $image;
    public $file;
    public $is_published = false;
    public $is_featured = false;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:500',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|min:20',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function mount(Publication $publication)
    {
        $this->publication = $publication;
        $this->title = $publication->title;
        $this->description = $publication->description;
        $this->category_id = $publication->category_id;
        $this->content = $publication->content;
        $this->is_published = $publication->is_published;
        $this->is_featured = $publication->is_featured;
    }

    public function updatePublication()
    {
        $this->validate();

        if ($this->image) {
            if ($this->publication->image_path) {
                Storage::disk('public')->delete($this->publication->image_path);
            }
            $this->publication->image_path = $this->image->store('publications', 'public');
        }

        if ($this->file) {
            if ($this->publication->file_path) {
                Storage::disk('public')->delete($this->publication->file_path);
            }
            $this->publication->file_path = $this->file->store('publications/files', 'public');
        }

        $this->publication->title = $this->title;
        $this->publication->description = $this->description;
        $this->publication->category_id = $this->category_id;
        $this->publication->content = $this->content;
        $this->publication->is_published = $this->is_published;
        $this->publication->is_featured = $this->is_featured;
        $this->publication->save();

        session()->flash('status', __('Publication updated successfully.'));

        return $this->redirectRoute('admin.publications.index', navigate: true);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function removeFile()
    {
        $this->file = null;
    }

    public function render()
    {
        return view('livewire.publications.edit', [
            'categories' => Category::all(),
        ]);
    }
}
