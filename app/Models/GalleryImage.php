<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['image_url', 'caption', 'sort_order'])]
class GalleryImage extends Model
{
    // Define the relationship with the owning model (program, blog, event or story)
    public function galleryable(): MorphTo
    {
        return $this->morphTo();
    }
}
