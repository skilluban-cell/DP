<?php

use App\Models\Stock;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockMovement;

uses(\Tests\TestCase::class, \Illuminate\Foundation\Testing\RefreshDatabase::class);

test('warehouse can be created', function () {
    $warehouse = Warehouse::create([
        'name'    => 'Серверна кімната',
        'address' => 'вул. Технічна, 1',
    ]);

    expect($warehouse)->toBeInstanceOf(Warehouse::class)
        ->and($warehouse->name)->toBe('Серверна кімната')
        ->and($warehouse->address)->toBe('вул. Технічна, 1');
});

test('warehouse has stock', function () {
    $warehouse = Warehouse::factory()->create();
    $product   = Product::factory()->create();

    Stock::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'quantity'     => 15,
    ]);

    expect($warehouse->stock)->toHaveCount(1)
        ->and($warehouse->stock->first()->quantity)->toBe('15.00');
});

test('warehouse has stock movements', function () {
    $warehouse = Warehouse::factory()->create();
    $product   = Product::factory()->create();
    $user      = \App\Models\User::factory()->create();

    StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'out',
        'quantity'     => 3,
    ]);

    expect($warehouse->stockMovements)->toHaveCount(1);
});

test('warehouse address is optional', function () {
    $warehouse = Warehouse::create([
        'name'    => 'Склад №2',
        'address' => null,
    ]);

    expect($warehouse->address)->toBeNull();
});