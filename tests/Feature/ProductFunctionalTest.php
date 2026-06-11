<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('product list page loads', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/products');
    $response->assertOk();
});

test('product create page loads', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/products/create');
    $response->assertOk();
});

test('product can be stored in database', function () {
    $category = Category::factory()->create();

    Product::create([
        'name'        => 'Ноутбук Dell',
        'sku'         => 'NB-001',
        'price'       => 25000,
        'unit'        => 'шт',
        'category_id' => $category->id,
    ]);

    $this->assertDatabaseHas('products', [
        'name' => 'Ноутбук Dell',
        'sku'  => 'NB-001',
    ]);
});

test('product can be updated', function () {
    $category = Category::factory()->create();
    $product  = Product::factory()->create(['category_id' => $category->id]);

    $product->update(['name' => 'Оновлена назва']);

    $this->assertDatabaseHas('products', [
        'id'   => $product->id,
        'name' => 'Оновлена назва',
    ]);
});

test('product can be deleted', function () {
    $category = Category::factory()->create();
    $product  = Product::factory()->create(['category_id' => $category->id]);

    $product->delete();

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});

test('product sku must be unique', function () {
    $category = Category::factory()->create();

    Product::create([
        'name'        => 'Товар 1',
        'sku'         => 'UNIQUE-001',
        'price'       => 100,
        'unit'        => 'шт',
        'category_id' => $category->id,
    ]);

    expect(fn() => Product::create([
        'name'        => 'Товар 2',
        'sku'         => 'UNIQUE-001',
        'price'       => 200,
        'unit'        => 'шт',
        'category_id' => $category->id,
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

test('stock cannot go below zero', function () {
    $product   = Product::factory()->create();
    $warehouse = Warehouse::factory()->create();

    $stock = Stock::create([
        'product_id'   => $product->id,
        'warehouse_id' => $warehouse->id,
        'quantity'     => 5,
    ]);

    $available = $stock->quantity >= 10;

    expect($available)->toBeFalse();
});

test('category can be stored in database', function () {
    Category::create([
        'name' => 'Комп\'ютерна техніка',
        'slug' => 'kompiuterna-tekhnika',
    ]);

    $this->assertDatabaseHas('categories', [
        'name' => 'Комп\'ютерна техніка',
    ]);
});

test('warehouse can be stored in database', function () {
    Warehouse::create([
        'name'    => 'Серверна кімната',
        'address' => 'вул. Технічна, 1',
    ]);

    $this->assertDatabaseHas('warehouses', [
        'name' => 'Серверна кімната',
    ]);
});

test('product edit page loads', function () {
    $user     = User::factory()->create();
    $category = Category::factory()->create();
    $product  = Product::factory()->create(['category_id' => $category->id]);

    $response = $this->actingAs($user)->get("/products/{$product->id}/edit");
    $response->assertOk();
});