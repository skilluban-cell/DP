<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        // Кожен товар на кожному складі
        for ($productId = 1; $productId <= 10; $productId++) {
            for ($warehouseId = 1; $warehouseId <= 2; $warehouseId++) {
                Stock::create([
                    'product_id'   => $productId,
                    'warehouse_id' => $warehouseId,
                    'quantity'     => rand(10, 100),
                ]);
            }
        }
    }
}