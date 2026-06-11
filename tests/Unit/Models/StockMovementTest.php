<?php

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;


uses(\Tests\TestCase::class, \Illuminate\Foundation\Testing\RefreshDatabase::class);

test('stock movement can be created', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();
    $user      = User::factory()->create();

    $movement = StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'in',
        'quantity'     => 10,
        'note'         => 'Тестовий прихід',
    ]);

    expect($movement)->toBeInstanceOf(StockMovement::class)
        ->and($movement->type)->toBe('in')
        ->and($movement->quantity)->toBe('10.00')
        ->and($movement->note)->toBe('Тестовий прихід');
});

test('stock movement belongs to product', function () {
    $product   = Product::factory()->create(['name' => 'Монітор LG']);
    $warehouse = Warehouse::factory()->create();
    $user      = User::factory()->create();

    $movement = StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'in',
        'quantity'     => 5,
    ]);

    expect($movement->product)->toBeInstanceOf(Product::class)
        ->and($movement->product->name)->toBe('Монітор LG');
});

test('stock movement belongs to warehouse', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create(['name' => 'Офіс №1']);
    $user      = User::factory()->create();

    $movement = StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'out',
        'quantity'     => 2,
    ]);

    expect($movement->warehouse)->toBeInstanceOf(Warehouse::class)
        ->and($movement->warehouse->name)->toBe('Офіс №1');
});

test('stock movement belongs to user', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();
    $user      = User::factory()->create(['name' => 'Адміністратор']);

    $movement = StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'in',
        'quantity'     => 7,
    ]);

    expect($movement->user)->toBeInstanceOf(User::class)
        ->and($movement->user->name)->toBe('Адміністратор');
});

test('incoming movement increases stock', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();
    $user      = User::factory()->create();

    $stock = Stock::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'quantity'     => 0,
    ]);

    $stock->increment('quantity', 10);

    StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'in',
        'quantity'     => 10,
    ]);

    expect($stock->fresh()->quantity)->toBe('10.00');
});

test('outgoing movement decreases stock', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();
    $user      = User::factory()->create();

    $stock = Stock::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'quantity'     => 20,
    ]);

    $stock->decrement('quantity', 5);

    StockMovement::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'user_id'      => $user->id,
        'type'         => 'out',
        'quantity'     => 5,
    ]);

    expect($stock->fresh()->quantity)->toBe('15.00');
});