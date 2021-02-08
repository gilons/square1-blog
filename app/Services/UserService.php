<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createAdminUser()
    {
        $adminUser = config('constants.user');
        return User::firstOrCreate(['email' => $adminUser['email']], 
        ['email' => $adminUser['email'],
            'name' => $adminUser['name'],
            'password' => Hash::make($adminUser['password']),
        ]);
    }
}
