<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|string|min:3|max:255')]
    public $title = '';

    #[Validate('required|string')]
    public $content = '';

    #[Validate('required|date')]
    public $date = '';

    #[Validate('required')]
    public $time = '';

    #[Validate('required|string')]
    public $location = '';

    #[Validate('required|image|mimes:jpeg,png,jpg|max:10240')] // 10MB Max
    public $image_url;

    #[Validate('required|exists:tags,id')]
    public $tag_id = '';

    public function save()
    {
        $this->validate();

        $imagePath = $this->image_url->store('events', 'public');

        Event::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'image_url' => $imagePath,
            'tag_id' => $this->tag_id,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Event created successfully.');
        return  $this->redirectRoute('admin.events.index',navigate:true);
    }

    public function render()
    {
        return view('livewire.events.create', [
            'tags' => Tag::all(),
        ]);
    }
}
