<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(100)->create();

        $user = User::create([
            'name' => 'JM45X',
            'email' => 'joe45moses@gmail.com',
            'password' => 'password',
        ]);

        $user->assignRole('Administrator');
    }
}
