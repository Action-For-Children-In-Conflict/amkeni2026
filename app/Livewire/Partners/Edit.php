<?php

namespace App\Livewire\Partners;

use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Partner $partner;
    public $name = '';
    public $role = '';
    public $website_url = '';
    public $content = '';
    public $image;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'role' => 'required|min:3|max:100',
        'website_url' => 'required|url',
        'content' => 'required|min:20',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
    ];

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->name = $partner->name;
        $this->role = $partner->role;
        $this->website_url = $partner->website_url;
        $this->content = $partner->content;
    }

    public function updatePartner()
    {
        $this->validate();

        if ($this->image) {
            if ($this->partner->image_url) {
                Storage::disk('public')->delete($this->partner->image_url);
            }
            $this->partner->image_url = $this->image->store('partners', 'public');
        }

        $this->partner->name = $this->name;
        $this->partner->slug = Str::slug($this->name);
        $this->partner->role = $this->role;
        $this->partner->website_url = $this->website_url;
        $this->partner->content = $this->content;
        $this->partner->save();

        session()->flash('status', __('Partner updated successfully.'));

        return $this->redirectRoute('admin.partners.index', navigate: true);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.partners.edit');
    }
}