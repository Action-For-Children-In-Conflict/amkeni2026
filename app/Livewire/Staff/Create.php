<?php

namespace App\Livewire\Staff;

use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $role = '';
    public $content = '';
    public $image;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'role' => 'required|min:3|max:100',
        'content' => 'required|min:20',
        'image' => 'required|image|max:10240',
    ];

    public function saveStaff()
    {
        $this->validate();

        $imagePath = $this->image->store('staff', 'public');

        Staff::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'user_id' => Auth::id(),
            'role' => $this->role,
            'content' => $this->content,
            'image_url' => $imagePath,
        ]);

        session()->flash('status', __('Staff member created successfully.'));

        return $this->redirectRoute('admin.staff.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.staff.create');
    }
}
