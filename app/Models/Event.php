<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

// Event fillables Atributes
#[Fillable(['title', 'slug', 'content', 'date', 'location', 'image_url', 'user_id', 'tag_id', 'time'])]
class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Tag model
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    // Extra images shown in the detail-page gallery slider
    public function galleryImages(): MorphMany
    {
        return $this->morphMany(GalleryImage::class, 'galleryable')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
