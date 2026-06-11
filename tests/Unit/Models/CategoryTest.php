<?php

use App\Models\Category;
use App\Models\Product;


uses(\Tests\TestCase::class, \Illuminate\Foundation\Testing\RefreshDatabase::class);

test('category can be created', function () {
    $category = Category::create([
        'name' => 'Комп\'ютерна техніка',
        'slug' => 'kompiuterna-tekhnika',
    ]);

    expect($category)->toBeInstanceOf(Category::class)
        ->and($category->name)->toBe('Комп\'ютерна техніка')
        ->and($category->slug)->toBe('kompiuterna-tekhnika');
});

test('category has many products', function () {
    $category = Category::factory()->create();

    Product::factory()->count(3)->create(['category_id' => $category->id]);

    expect($category->products)->toHaveCount(3);
});

test('category without description is valid', function () {
    $category = Category::create([
        'name' => 'Оргтехніка',
        'slug' => 'orgteknika',
        'description' => null,
    ]);

    expect($category->description)->toBeNull();
});