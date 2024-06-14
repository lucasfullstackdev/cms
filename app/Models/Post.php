<?php

namespace App\Models;

use App\Models\Traits\UserAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
            $model->slug = Str::slug($model->title);
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id() ?? 1;
        });
    }

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
