<?php

namespace App\Models;

use Database\Factories\TestmonialFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

// fillable attributes
#[Fillable(['name', 'slug', 'content', 'position', 'user_id', 'image'])]

class Testmonial extends Model
{
    /** @use HasFactory<TestmonialFactory> */
    use HasFactory;

    // Extra images shown in the detail-page gallery slider
    public function galleryImages(): MorphMany
    {
        return $this->morphMany(GalleryImage::class, 'galleryable')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
