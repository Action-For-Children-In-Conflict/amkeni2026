<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Event $event;

    public $title = '';

    public $content = '';

    public $date = '';

    public $time = '';

    public $location = '';

    public $image_url;

    public $tag_id = '';

    public function mount(Event $event): void
    {
        $this->event = $event;
        $this->title = $event->title;
        $this->content = $event->content;
        $this->date = $event->date;
        $this->time = $event->time;
        $this->location = $event->location;
        $this->tag_id = $event->tag_id;
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'tag_id' => 'required|exists:tags,id',
        ];
    }

    public function update(): void
    {
        $this->validate();

        if ($this->image_url && ! is_string($this->image_url)) {
            if ($this->event->image_url) {
                Storage::disk('public')->delete($this->event->image_url);
            }
            $this->event->image_url = $this->image_url->store('events', 'public');
        }

        $this->event->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'tag_id' => $this->tag_id,
            'user_id' => $this->event->user_id ?? Auth::id(),
            'image_url' => $this->event->image_url,
        ]);

        session()->flash('message', __('Event updated successfully.'));

        $this->redirectRoute('admin.events.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.events.edit', [
            'tags' => Tag::all(),
        ]);
    }
}
