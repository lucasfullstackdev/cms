<?php

namespace App\Models;

use App\Models\Traits\UserAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UserAudit;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'status_id',
        'content',
        'publish_at',
    ];

    public function publishAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatDateTime($value),
        );
    }

    public function status()
    {
        return $this->belongsTo(PostStatus::class, 'status_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
