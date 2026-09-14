<?php

namespace App\Livewire\Programs;

use App\Models\Program;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $tag_id = '';
    public $image;
    public $content = '';

    protected $rules = [
        'title' => 'required|string|max:255|unique:programs,title',
        'tag_id' => 'required|exists:tags,id',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240', // 10MB Max
        'content' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $imagePath = $this->image->store('programs', 'public');

        Program::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'tag_id' => $this->tag_id,
            'user_id' => Auth::id(),
            'image_url' => $imagePath,
            'content' => $this->content,
        ]);

        session()->flash('message', __('Program created successfully.'));

        return $this->redirectRoute('admin.programs.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.programs.create', [
            'tags' => Tag::latest()->get(),
        ]);
    }
}
