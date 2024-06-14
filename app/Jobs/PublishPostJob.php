<?php

namespace App\Jobs;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostStatus as ModelsPostStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Post $post)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->post->status_id = ModelsPostStatus::where('name', PostStatus::PUBLISHED->value)->first()->id;
        $this->post->save();
    }
}
