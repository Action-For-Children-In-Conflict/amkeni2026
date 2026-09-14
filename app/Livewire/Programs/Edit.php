<?php

namespace App\Livewire\Programs;

use App\Models\Program;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Program $program;

    public $title = '';

    public $tag_id = '';

    public $image;

    public $content = '';

    public function mount(Program $program)
    {
        $this->program = $program;
        $this->title = $program->title;
        $this->tag_id = $program->tag_id;
        $this->content = $program->content;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:programs,title,'.$this->program->id,
            'tag_id' => 'required|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'content' => 'required|string',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            if ($this->program->image_url) {
                Storage::disk('public')->delete($this->program->image_url);
            }
            $this->program->image_url = $this->image->store('programs', 'public');
        }

        $this->program->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'tag_id' => $this->tag_id,
            'content' => $this->content,
            'image_url' => $this->program->image_url,
        ]);

        session()->flash('message', __('Program updated successfully.'));

        return $this->redirectRoute('admin.programs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.programs.edit', [
            'tags' => Tag::latest()->get(),
        ]);
    }
}
