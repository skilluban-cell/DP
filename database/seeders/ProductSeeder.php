<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'Смартфон Samsung A54',  'sku' => 'EL-001', 'price' => 12999, 'unit' => 'шт'],
            ['category_id' => 1, 'name' => 'Навушники Sony WH-1000', 'sku' => 'EL-002', 'price' => 8499,  'unit' => 'шт'],
            ['category_id' => 2, 'name' => 'Пральна машина Bosch',   'sku' => 'HH-001', 'price' => 24999, 'unit' => 'шт'],
            ['category_id' => 2, 'name' => 'Холодильник LG',         'sku' => 'HH-002', 'price' => 19999, 'unit' => 'шт'],
            ['category_id' => 3, 'name' => 'Дриль Makita',           'sku' => 'TL-001', 'price' => 3499,  'unit' => 'шт'],
            ['category_id' => 3, 'name' => 'Набір викруток',         'sku' => 'TL-002', 'price' => 599,   'unit' => 'шт'],
            ['category_id' => 4, 'name' => 'Папір А4 (пачка)',       'sku' => 'ST-001', 'price' => 129,   'unit' => 'шт'],
            ['category_id' => 4, 'name' => 'Ручки кулькові (10шт)',  'sku' => 'ST-002', 'price' => 89,    'unit' => 'шт'],
            ['category_id' => 5, 'name' => 'Цукор (1кг)',            'sku' => 'FD-001', 'price' => 49,    'unit' => 'кг'],
            ['category_id' => 5, 'name' => 'Олія соняшникова (1л)',  'sku' => 'FD-002', 'price' => 79,    'unit' => 'л'],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, ['description' => null]));
        }
    }
}