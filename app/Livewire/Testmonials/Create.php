<?php

namespace App\Livewire\Testmonials;

use App\Models\Testmonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $position = '';
    public $content = '';
    public $image;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'position' => 'required|min:3|max:100',
        'content' => 'required|min:20|max:1000',
        'image' => 'required|image|max:10240',
    ];

    public function saveTestmonial()
    {
        $this->validate();

        $imagePath = $this->image->store('testmonials', 'public');

        Testmonial::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'position' => $this->position,
            'content' => $this->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        session()->flash('status', __('Testimonial created successfully.'));

        return $this->redirectRoute('admin.testmonials.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.testmonials.create');
    }
}
