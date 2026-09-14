<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public Category $category;
    public string $title = '';

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->title = $category->title;
    }

    public function updateCategory()
    {
        $this->validate([
            'title' => 'required|string|max:255',
        ]);

        $this->category->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ]);

        session()->flash('status', __('Category updated successfully.'));

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}
