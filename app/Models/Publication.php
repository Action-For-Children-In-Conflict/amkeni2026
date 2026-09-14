<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//fillables attributes for the publication model
#[Fillable(['title', 'description', 'content', 'user_id', 'category_id', 'image_path', 'file_path', 'is_published', 'is_featured'])]
class Publication extends Model
{
    /** @use HasFactory<\Database\Factories\PublicationFactory> */
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



}
