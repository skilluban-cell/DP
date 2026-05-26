<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@diplom.com'],
            [
                'name'     => 'Адміністратор',
                'password' => Hash::make('password'),
                'role_id'  => 1,
            ]
        );

        User::firstOrCreate(
            ['email' => 'manager@diplom.com'],
            [
                'name'     => 'Менеджер',
                'password' => Hash::make('password'),
                'role_id'  => 2,
            ]
        );
    }
}