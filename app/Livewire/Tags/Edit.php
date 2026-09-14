<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public Tag $tag;
    public $title = '';

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
        $this->title = $tag->title;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:tags,name,' . $this->tag->id,
        ]);

        $this->tag->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ]);

        session()->flash('message', __('Tag updated successfully.'));
        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('livewire.tags.edit');
    }
}
