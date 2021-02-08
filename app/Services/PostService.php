<?php
namespace App\Services;

use App\Models\Post;
use App\Observers\PostObserver;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class PostService
{

    public static function savePost($data)
    {
        return Post::create($data);
    }

    private function getCacheKey($slug)
    {
        $key = $this->getKey('posts-key');
        return $key . '_' . $slug;
    }

    private function getKey($key)
    {
        return Config::get($key, ['date' => Carbon::now()])['date'];

    }

    private function getUsersPostsKey($slug)
    {
        $key = $this->getKey('my-post-key');
        return $key . '_' . $slug . '-user';
    }

    private function returnPosts($sorter = 'title', $order = 'asc')
    {
        $currentPage = request()->get('page', 1);
        $key = $this->getCacheKey('posts' . '_' . $sorter . '_' . $order . '_' . $currentPage);
        return Cache::remember($key, 30, function () use ($sorter, $order) {
            return Post::with('user')->orderBy($sorter, $order)->paginate(30);
        });
    }

    private function returnPostsByUser($userId, $sorter, $order)
    {
        $key = $this->getUsersPostsKey('my-posts' . $userId);
        return Cache::remember($key, 30, function () use ($userId, $sorter, $order) {
            return Post::where('user_id', $userId)->with('user')->orderBy($sorter, $order)->get();
        });

    }

    public static function getPosts($sorter, $order)
    {
        $self = new Self();
        return $self->returnPosts($sorter, $order);
    }

    private function constructSearch($query, $key, $search)
    {
        $search = strtolower($search);
        $search = explode(' ', $search);
        foreach ($search as $item) {
            $query = $query->orWhereRaw("Lower(" . $key . ") like '%" . $item . "%'");
        }
        return $query;
    }
    private function prepareSearchQuery($search, $userId = false)
    {
        $query = Post::query();
        if ($userId) {
            $query = $query->where('user_id', $userId);
            $query = $query->where(function ($query) use ($search) {
                $query = $this->constructSearch($query, 'title', $search);
                $query = $this->constructSearch($query, 'content', $search);
                return $query;
            });
        } else {
            $query = $this->constructSearch($query, 'title', $search);
            $query = $this->constructSearch($query, 'content', $search);
            $query = $query->orWhereHas('user', function ($q) use ($search) {
                return $q->whereRaw("Lower(" . 'name' . ") like '%" . $search . "%'");
            });

        }
        return $query;
    }

    public static function searchPost($sorter = 'title', $order = 'asc', $search = '')
    {
        $self = new Self();
        $query = $self->prepareSearchQuery($search);
        return $query->with('user')->orderBy($sorter, $order)->paginate(30);
    }

    public static function searchMyPosts($search, $userId, $sorter = 'title', $order = 'asc', )
    {
        $self = new Self();
        $query = $self->prepareSearchQuery($search, $userId);
        return $query->with('user')->orderBy($sorter, $order)->get();
    }

    public static function postsByUser($userId, $sorter = 'title', $order = 'asc')
    {
        $self = new Self();
        return $self->returnPostsByUser($userId, $sorter, $order);
    }

    public static function getSinglePost($slug)
    {

        $key = 'post-' . $slug;
        $currentCacheValue = Cache::get($key, false);
        if ($currentCacheValue) {
            return $currentCacheValue;
        } else {
            return Cache::rememberForever($key, function () use ($slug) {
                $post = Post::where('slug', $slug)->with('user')->get()->first();
                return $post;
            });
        }

    }

    public static function getRandomPosts($number = 4)
    {
        return Post::with('user')->inRandomOrder()->get()->take($number);

    }

    public static function RegisterPostObserver()
    {
        return Post::observe(PostObserver::class);
    }

    public static function createPostsInBulk($posts)
    {
        return Post::insert($posts);
    }

    public static function createSlug($title)
    {
        return SlugService::createSlug(Post::class, 'slug', $title, ['unique' => true]);
    }

}
