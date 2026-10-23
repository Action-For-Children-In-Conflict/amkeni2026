<?php

namespace App\Livewire\Gallery;

use App\Models\Blog;
use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\Program;
use App\Models\Testmonial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manager extends Component
{
    use WithFileUploads;

    private const TYPES = [
        'program' => Program::class,
        'blog' => Blog::class,
        'event' => Event::class,
        'story' => Testmonial::class,
    ];

    #[Locked]
    public string $galleryableType = '';

    #[Locked]
    public int $galleryableId = 0;

    public $photo = null;

    public string $caption = '';

    /**
     * @var array<int, ?string>
     */
    public array $captions = [];

    public function mount(string $type, int $id): void
    {
        abort_unless(array_key_exists($type, self::TYPES), 404);

        $this->galleryableType = $type;
        $this->galleryableId = $id;
        $this->syncCaptions();
    }

    public function addImage(): void
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);

        $imagePath = $this->photo->store('gallery', 'public');
        $nextOrder = (int) $this->galleryable()->galleryImages()->max('sort_order');

        $this->galleryable()->galleryImages()->create([
            'image_url' => $imagePath,
            'caption' => $this->caption ?: null,
            'sort_order' => $nextOrder + 1,
        ]);

        $this->reset('photo', 'caption');
        $this->resetValidation();
        $this->syncCaptions();
    }

    public function updateCaption(int $imageId): void
    {
        $this->validate([
            "captions.{$imageId}" => 'nullable|string|max:255',
        ]);

        $image = $this->galleryable()->galleryImages()->findOrFail($imageId);
        $caption = trim((string) ($this->captions[$imageId] ?? ''));

        $image->update(['caption' => $caption !== '' ? $caption : null]);
    }

    public function deleteImage(int $imageId): void
    {
        $image = $this->galleryable()->galleryImages()->findOrFail($imageId);

        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        $this->syncCaptions();
    }

    public function render()
    {
        return view('livewire.gallery.manager', [
            'images' => $this->galleryable()->galleryImages()->get(),
            'typeLabel' => ucfirst($this->galleryableType),
        ]);
    }

    private function galleryable(): Model
    {
        $modelClass = self::TYPES[$this->galleryableType] ?? null;

        abort_if($modelClass === null, 404);

        return $modelClass::query()->findOrFail($this->galleryableId);
    }

    private function syncCaptions(): void
    {
        /** @var Collection<int, GalleryImage> $images */
        $images = $this->galleryable()->galleryImages()->get();

        $this->captions = $images
            ->mapWithKeys(fn (GalleryImage $image): array => [$image->id => $image->caption])
            ->all();
    }
}
