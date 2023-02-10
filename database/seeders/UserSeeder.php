<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'permissions' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'is_admin' => 1,
        ]);
        User::create([
            'name' => 'Gozel',
            'username' => 'gozel',
            'password' => bcrypt('password'),
            'is_admin' => 0,
        ]);
    }
}
