<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_slug' => 'elektronika',          'name' => 'Смартфон Samsung A54',  'sku' => 'EL-001', 'price' => 12999, 'unit' => 'шт'],
            ['category_slug' => 'elektronika',          'name' => 'Навушники Sony WH-1000', 'sku' => 'EL-002', 'price' => 8499,  'unit' => 'шт'],
            ['category_slug' => 'pobutova-texnika',     'name' => 'Пральна машина Bosch',   'sku' => 'HH-001', 'price' => 24999, 'unit' => 'шт'],
            ['category_slug' => 'pobutova-texnika',     'name' => 'Холодильник LG',         'sku' => 'HH-002', 'price' => 19999, 'unit' => 'шт'],
            ['category_slug' => 'instrumenti',          'name' => 'Дриль Makita',           'sku' => 'TL-001', 'price' => 3499,  'unit' => 'шт'],
            ['category_slug' => 'instrumenti',          'name' => 'Набір викруток',         'sku' => 'TL-002', 'price' => 599,   'unit' => 'шт'],
            ['category_slug' => 'kanctovari',           'name' => 'Папір А4 (пачка)',       'sku' => 'ST-001', 'price' => 129,   'unit' => 'шт'],
            ['category_slug' => 'kanctovari',           'name' => 'Ручки кулькові (10шт)',  'sku' => 'ST-002', 'price' => 89,    'unit' => 'шт'],
            ['category_slug' => 'produkti-xarcuvannia', 'name' => 'Цукор (1кг)',            'sku' => 'FD-001', 'price' => 49,    'unit' => 'кг'],
            ['category_slug' => 'produkti-xarcuvannia', 'name' => 'Олія соняшникова (1л)',  'sku' => 'FD-002', 'price' => 79,    'unit' => 'л'],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category_slug'])->first();
            if (!$category) continue;

            Product::firstOrCreate(
                ['sku' => $data['sku']],
                [
                    'name'        => $data['name'],
                    'price'       => $data['price'],
                    'unit'        => $data['unit'],
                    'category_id' => $category->id,
                    'description' => null,
                ]
            );
        }
    }
}