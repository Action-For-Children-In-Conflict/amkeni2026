<?php

namespace App\Livewire\Publications;

use App\Models\Publication;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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
        'image' => 'nullable|image|max:10240',
        'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function savePublication()
    {
        $this->validate();

        $imagePath = null;
        $filePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('publications', 'public');
        }

        if ($this->file) {
            $filePath = $this->file->store('publications/files', 'public');
        }

        Publication::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'content' => $this->content,
            'image_path' => $imagePath,
            'file_path' => $filePath,
            'is_published' => $this->is_published,
            'is_featured' => $this->is_featured,
        ]);

        session()->flash('status', __('Publication created successfully.'));

        return $this->redirectRoute('admin.publications.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.publications.create', [
            'categories' => Category::all(),
        ]);
    }
}
