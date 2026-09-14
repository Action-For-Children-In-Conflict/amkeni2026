<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'slug'])]
class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;


 
     //relationships with Program model
        public function programs()
        {
            return $this->hasMany(Program::class);
        }
        //relationships with Event model
        public function events()
        {
            return $this->hasMany(Event::class);
        }
     

}
