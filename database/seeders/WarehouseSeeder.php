<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        Warehouse::firstOrCreate(
            ['name' => 'Головний склад'],
            ['address' => 'вул. Складська, 1']
        );

        Warehouse::firstOrCreate(
            ['name' => 'Склад №2'],
            ['address' => 'вул. Промислова, 15']
        );
    }
}