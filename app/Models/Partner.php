<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//fillables
#[Fillable(['name', 'slug', 'content', 'website_url', 'image_url', 'role' , 'user_id'])]
class Partner extends Model
{
    /** @use HasFactory<\Database\Factories\PartnerFactory> */
    use HasFactory;
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);   
    }
}
