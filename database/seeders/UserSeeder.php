<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name'       => 'Адміністратор',
                'email'      => 'admin@diplom.com',
                'password'   => Hash::make('password'),
                'role_id'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Менеджер',
                'email'      => 'manager@diplom.com',
                'password'   => Hash::make('password'),
                'role_id'    => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}