<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $manager = Role::where('name', 'manager')->first();

        User::firstOrCreate(
            ['email' => 'admin@diplom.com'],
            [
                'name'     => 'Адміністратор',
                'password' => Hash::make('password'),
                'role_id'  => $admin?->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'manager@diplom.com'],
            [
                'name'     => 'Менеджер',
                'password' => Hash::make('password'),
                'role_id'  => $manager?->id,
            ]
        );
    }
}