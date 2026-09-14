<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//fillables
#[Fillable(['title', 'slug', 'content', 'user_id', 'tag_id', 'image_url', ])]
class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
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
