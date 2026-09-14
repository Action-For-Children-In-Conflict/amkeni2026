<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//fillables 
#[Fillable(['title','slug'])]
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    // Define the relationship with the Blog model
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    // Define the relationship with the Publication model
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }







}
