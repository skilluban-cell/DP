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
});