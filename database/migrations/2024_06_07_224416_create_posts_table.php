<?php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->unsigned();

            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('status_id')->constrained('post_statuses');
            $table->text('content');

            /**
             * The `publish_at` column will be used to schedule the post to be published at a specific date and time.
             * If the `publish_at` column is `NULL`, the post is not scheduled to be published.
             */
            $table->timestamp('publish_at')->nullable();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
