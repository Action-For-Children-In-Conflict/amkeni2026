<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $category_id = '';
    public $image;
    public $content = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|max:10240', // 10MB Max
        'content' => 'required|min:10',
    ];

    public function saveBlog()
    {
        $this->validate();

        $imagePath = $this->image->store('blogs', 'public');

        Blog::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'image_url' => $imagePath,
            'content' => $this->content,
        ]);

        session()->flash('status', 'Blog post created successfully.');

        return $this->redirectRoute('admin.blogs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.blog.create', [
            'categories' => Category::all(),
        ]);
    }
}
