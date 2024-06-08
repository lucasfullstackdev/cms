<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tags = [
            'Organization',
            'Planning',
            'Collaboration',
            'Writing',
            'Calendar',
            'API',
            'JSON',
            'Schema',
            'Node',
            'GitHub',
            'REST',
        ];

        $tags = array_map(function ($tag) {
            return [
                'name' => $tag,
                'active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $tags);

        Tag::insert($tags);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
