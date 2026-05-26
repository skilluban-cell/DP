<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin',   'label' => 'Адміністратор', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manager', 'label' => 'Менеджер',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}