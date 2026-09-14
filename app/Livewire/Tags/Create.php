<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $title = '';

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ]);

        session()->flash('message', __('Tag created successfully.'));
        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.tags.create');
    }
}
