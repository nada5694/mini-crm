<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'id'       => 'a7ba44c7-ecba-41b5-b1c4-692d1fbb070d',
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => bcrypt('123456789'),
            'role'     => 'admin',
        ]);

        User::create([
            'id'       => '7a06e753-c7ce-422c-9f98-ba047f12954f',
            'name'     => 'Employee User',
            'email'    => 'employee@example.com',
            'password' => bcrypt('123456789'),
            'role'     => 'employee',
        ]);
    }
}
