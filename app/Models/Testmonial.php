<?php

namespace App\Models;

use Database\Factories\TestmonialFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// fillable attributes
#[Fillable(['name', 'slug', 'content', 'position', 'user_id', 'image'])]

class Testmonial extends Model
{
    /** @use HasFactory<TestmonialFactory> */
    use HasFactory;
}
