<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Електроніка',
            'Побутова техніка',
            'Інструменти',
            'Канцтовари',
            'Продукти харчування',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name'        => $name,
                    'description' => null,
                ]
            );
        }
    }
}