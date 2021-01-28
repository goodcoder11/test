<?php

namespace Database\Seeders;

use App\Services\UserService;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(UserService $userService)
    {
        $user = $userService->saveUser(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => '123', // this will be changes to bcrypt at the DB save time
            ],
            [
                'email' => 'admin@gmail.com'
            ]
        );

        $userService->addRole($user->id, 'admin');
    }
}
