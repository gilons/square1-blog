<?php

namespace App\Console\Commands;

use App\Repositories\PostRepository;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Console\Command;

class PostsInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user and add a collection of post under that user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = UserService::createAdminUser();
        $posts = PostRepository::fetchPosts();
        $posts = array_map(function ($ele) use ($user) {
            return [
                'title' => $ele['title'],
                'content' => $ele['description'],
                'user_id' => $user->id,
                'slug' => PostService::createSlug($ele['title']),
                'created_at' => $ele['publication_date'],
                'updated_at' => $ele['publication_date'],
            ];
        }, $posts);
        PostService::createPostsInBulk($posts);
        $this->info("all posts successfully fetched and saved!");
        return 0;
    }
}
