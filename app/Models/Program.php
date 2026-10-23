<?php

namespace App\Models;

use Database\Factories\ProgramFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

// fillables
#[Fillable(['title', 'slug', 'content', 'user_id', 'tag_id', 'image_url', 'description'])]
class Program extends Model
{
    /** @use HasFactory<ProgramFactory> */
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
