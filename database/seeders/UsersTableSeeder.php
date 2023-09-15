<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            [
                'name' => 'Administrator',
                'username' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin12345'),
                'foto' => '/img/user.jpg',
                'level' => 0
            ],
            [
                'name' => 'Kasir 1',
                'username' => 'Kasir 1',
                'email' => 'kasir1@gmail.com',
                'password' => bcrypt('kasir12345'),
                'foto' => '/img/user.jpg',
                'level' => 1
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
