<?php

namespace App\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

// fillable  Attribute: Specifies which attributes can be mass assigned. In this case, all attributes are fillable.

#[Fillable(['title', 'slug', 'user_id', 'category_id', 'image_url', 'content'])]
class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Extra images shown in the detail-page gallery slider
    public function galleryImages(): MorphMany
    {
        return $this->morphMany(GalleryImage::class, 'galleryable')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
