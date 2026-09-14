<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Blog $blog;
    public $title = '';
    public $category_id = '';
    public $image;
    public $content = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        'content' => 'required',
    ];

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->title = $blog->title;
        $this->category_id = $blog->category_id;
        $this->content = $blog->content;
    }

    public function updateBlog()
    {
        $this->validate();

        if ($this->image) {
            if ($this->blog->image_url) {
                Storage::disk('public')->delete($this->blog->image_url);
            }
            $this->blog->image_url = $this->image->store('blogs', 'public');
        }

        $this->blog->title = $this->title;
        $this->blog->slug = Str::slug($this->title);
        $this->blog->category_id = $this->category_id;
        $this->blog->content = $this->content;
        $this->blog->save();

        session()->flash('status', __('Blog post updated successfully.'));

        return $this->redirectRoute('admin.blogs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.blog.edit', [
            'categories' => Category::all(),
        ]);
    }
}
