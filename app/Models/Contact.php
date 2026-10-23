<?php

namespace App\Models;

use App\Enums\ContactType;
use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'name', 'email', 'phone', 'organization', 'subject', 'message'])]
class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => ContactType::class,
        ];
    }

    /**
     * Limit the query to a single enquiry type.
     *
     * @param  Builder<Contact>  $query
     * @return Builder<Contact>
     */
    public function scopeOfType(Builder $query, ContactType $type): Builder
    {
        return $query->where('type', $type->value);
    }
}
