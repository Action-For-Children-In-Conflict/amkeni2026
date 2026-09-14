<?php

namespace App\Livewire\Staff;

use App\Models\Staff;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Staff $staff;
    public $name = '';
    public $role = '';
    public $content = '';
    public $image;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'role' => 'required|min:3|max:100',
        'content' => 'required|min:20',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
    ];

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->name = $staff->name;
        $this->role = $staff->role;
        $this->content = $staff->content;
    }

    public function updateStaff()
    {
        $this->validate();

        if ($this->image) {
            if ($this->staff->image_url) {
                Storage::disk('public')->delete($this->staff->image_url);
            }
            $this->staff->image_url = $this->image->store('staff', 'public');
        }

        $this->staff->name = $this->name;
        $this->staff->slug = Str::slug($this->name);
        $this->staff->role = $this->role;
        $this->staff->content = $this->content;
        $this->staff->save();

        session()->flash('status', __('Staff member updated successfully.'));

        return $this->redirectRoute('admin.staff.index', navigate: true);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.staff.edit');
    }
}
