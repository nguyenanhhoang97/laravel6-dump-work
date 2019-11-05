<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
            'email' => 'admin@dump.work',
            'password' => Hash::make('admin'),
            'role' => 1
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@dump.work',
            'password' => Hash::make('secret'),
            'role' => 2
        ]);
    }
}