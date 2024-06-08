<?php

namespace App\Models;

use App\Models\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostTag extends Model
{
    use HasFactory;
    use UserAudit;

    protected $table = 'post_tags';
    protected $fillable = [
        'post_id',
        'tag_id',
    ];
}
