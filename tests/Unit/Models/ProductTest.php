<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;


uses(\Tests\TestCase::class, \Illuminate\Foundation\Testing\RefreshDatabase::class);

test('product can be created', function () {
    $category = Category::factory()->create();

    $product = Product::create([
        'name'        => 'Ноутбук Dell',
        'sku'         => 'NB-001',
        'price'       => 25000,
        'unit'        => 'шт',
        'category_id' => $category->id,
    ]);

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('Ноутбук Dell')
        ->and($product->sku)->toBe('NB-001')
        ->and($product->price)->toBe('25000.00');
});

test('product belongs to category', function () {
    $category = Category::factory()->create(['name' => 'Техніка']);
    $product = Product::factory()->create(['category_id' => $category->id]);

    expect($product->category)->toBeInstanceOf(Category::class)
        ->and($product->category->name)->toBe('Техніка');
});

test('product has stock', function () {
    $product = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();

    Stock::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'quantity'     => 10,
    ]);

    expect($product->stock)->toHaveCount(1)
        ->and($product->stock->first()->quantity)->toBe('10.00');
});

test('product has stock movements', function () {
    $product  = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();
    $user     = \App\Models\User::factory()->create();

    StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'in',
        'quantity'     => 5,
    ]);

    expect($product->stockMovements)->toHaveCount(1);
});