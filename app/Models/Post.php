<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'status_id',
        'content',
        'publish_at',
        'created_by',
        'updated_by',
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