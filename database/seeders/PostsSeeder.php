<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Services\PostService;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        Post::truncate();
        $faker = Factory::create();
        while ($i < 200) {
            Post::create(['title' => $faker->sentence(10),
                'content' => $faker->paragraph(6),
                'user_id' => $faker->numberBetween(1,10),
            ]);
            $i++;
        }

    }
}
