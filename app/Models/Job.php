<?php

namespace App\Models;

use Database\Factories\JobFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'slug', 'user_id', 'image_url', 'description', 'content', 'document_path'])]
class Job extends Model
{
    /** @use HasFactory<JobFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * The default "jobs" table is reserved by the database queue driver.
     *
     * @var string
     */
    protected $table = 'job_listings';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Whether the job posting has a downloadable document attached.
     */
    public function hasDocument(): bool
    {
        return filled($this->document_path);
    }
}
