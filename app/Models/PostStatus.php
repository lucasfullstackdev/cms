<?php

namespace App\Models;

use App\Models\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UserAudit;

    protected $table = 'post_statuses';
    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'status_id');
    }
}
