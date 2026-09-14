<?php

namespace App\Livewire\Partners;

use App\Models\Partner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $role = '';
    public $website_url = '';
    public $image;
    public $content = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'role' => 'required|min:3|max:100',
        'website_url' => 'required|url',
        'image' => 'required|image|max:10240',
        'content' => 'required|min:20',
    ];

    public function savePartner()
    {
        $this->validate();

        $imagePath = $this->image->store('partners', 'public');

        Partner::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'role' => $this->role,
            'website_url' => $this->website_url,
            'image_url' => $imagePath,
            'content' => $this->content,
            'user_id' => Auth::id(),
        ]);

        session()->flash('status', __('Partner created successfully.'));

        return $this->redirectRoute('admin.partners.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.partners.create');
    }
}
