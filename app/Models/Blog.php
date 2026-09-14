<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//fillable  Attribute: Specifies which attributes can be mass assigned. In this case, all attributes are fillable.

#[Fillable(['title', 'slug', 'user_id', 'category_id', 'image_url', 'content'])]
class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
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
