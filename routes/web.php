<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Товари
    Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

    Route::get('/products/create', function () {
        return view('products.create');
    })->name('products.create');

  Route::get('/products/{product}/edit', function (\App\Models\Product $product) {
    return view('products.edit', compact('product'));
})->name('products.edit');

    // Категорії
    Route::get('/categories', function () {
        return view('categories.index');
    })->name('categories.index');

    // Склади
    Route::get('/warehouses', function () {
        return view('warehouses.index');
    })->name('warehouses.index');

    // Рух товарів
    Route::get('/movements', function () {
        return view('movements.index');
    })->name('movements.index');

    // Звіти
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports.index');

    Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::delete('/products/{product}', function (\App\Models\Product $product) {
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Товар видалено!');
})->name('products.destroy');

Route::delete('/categories/{category}', function (\App\Models\Category $category) {
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'Категорію видалено!');
})->name('categories.destroy');

Route::delete('/warehouses/{warehouse}', function (\App\Models\Warehouse $warehouse) {
    $warehouse->delete();
    return redirect()->route('warehouses.index')->with('success', 'Склад видалено!');
})->name('warehouses.destroy');

Route::get('/categories/{category}/edit', function (\App\Models\Category $category) {
    return view('categories.edit', compact('category'));
})->name('categories.edit');
});