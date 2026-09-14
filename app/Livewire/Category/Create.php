<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public string  $title ='';
    public function saveCategory()
    {
        $this->validate([
            'title' => 'required|string|max:255',
        ]);

        Category::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ]);

        session()->flash('status', __('Category created successfully.'));

        return redirect()->route('admin.categories.index');
    }       

    public function render()
    {
        return view('livewire.category.create', [
            'categories' => Category::all(),
        ]);
    }
}
