<?php

namespace App\Models;

use App\Models\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UserAudit;

    protected $table = 'tags';
    protected $fillable = [
        'name',
        'active',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
