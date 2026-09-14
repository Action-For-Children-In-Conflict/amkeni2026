<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Event fillables Atributes 
#[Fillable(['title', 'slug', 'content', 'date', 'location', 'image_url', 'user_id', 'tag_id', 'time'])]
class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
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

    
}
