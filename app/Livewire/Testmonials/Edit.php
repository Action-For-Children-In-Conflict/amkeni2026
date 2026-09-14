<?php

namespace App\Livewire\Testmonials;

use App\Models\Testmonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Testmonial $testmonial;
    public $name = '';
    public $position = '';
    public $content = '';
    public $image;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'position' => 'required|min:3|max:100',
        'content' => 'required|min:20|max:1000',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
    ];

    public function mount(Testmonial $testmonial)
    {
        $this->testmonial = $testmonial;
        $this->name = $testmonial->name;
        $this->position = $testmonial->position;
        $this->content = $testmonial->content;
    }

    public function updateTestmonial()
    {
        $this->validate();

        if ($this->image) {
            if ($this->testmonial->image) {
                Storage::disk('public')->delete($this->testmonial->image);
            }
            $this->testmonial->image = $this->image->store('testmonials', 'public');
        }

        $this->testmonial->name = $this->name;
        $this->testmonial->slug = Str::slug($this->name);
        $this->testmonial->position = $this->position;
        $this->testmonial->content = $this->content;
        $this->testmonial->save();

        session()->flash('status', __('Testimonial updated successfully.'));

        return $this->redirectRoute('admin.testmonials.index', navigate: true);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.testmonials.edit');
    }
}
