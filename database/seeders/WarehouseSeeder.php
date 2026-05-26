<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Warehouse::insert([
            [
                'name'       => 'Головний склад',
                'address'    => 'вул. Складська, 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Склад №2',
                'address'    => 'вул. Промислова, 15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}