<?php

namespace App\Observers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        return $this->updateCacheKey($post, $post->created_at);
    }

    private function updateCacheKey($post, $date)
    {
        $user = auth()->user();
        $postDate = ['date' => $date];
        $this->setKey('posts-key', $postDate);
        if (isset($user) && $user->id == $post->user_id) {
            $this->setKey('my-posts-key', $postDate);
        }
    }

    private function setKey($key, $value)
    {
        return Config::set($key, $value);
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        return $this->updateCacheKey($post, $post->updated_at);
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
