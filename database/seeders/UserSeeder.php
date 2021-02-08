<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\UserService;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        $users = [];
        $faker = Factory::create();
        while ($i < 10) {
            User::create (['name' => $faker->name('male'),
                'email' => $faker->email,
                'password' => Hash::make('00000000'),
            ]);
            $i++;
        }
       //return UserService::insertMany($users);
    }
}
