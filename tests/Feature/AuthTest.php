<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated user is redirected to login', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('unauthenticated user cannot access products', function () {
    $response = $this->get('/products');
    $response->assertRedirect('/login');
});

test('unauthenticated user cannot access categories', function () {
    $response = $this->get('/categories');
    $response->assertRedirect('/login');
});

test('unauthenticated user cannot access warehouses', function () {
    $response = $this->get('/warehouses');
    $response->assertRedirect('/login');
});

test('unauthenticated user cannot access movements', function () {
    $response = $this->get('/movements');
    $response->assertRedirect('/login');
});

test('unauthenticated user cannot access reports', function () {
    $response = $this->get('/reports');
    $response->assertRedirect('/login');
});

test('authenticated user can access dashboard', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertOk();
});

test('authenticated user can access products', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/products');
    $response->assertOk();
});

test('authenticated user can access categories', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/categories');
    $response->assertOk();
});

test('authenticated user can access warehouses', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/warehouses');
    $response->assertOk();
});

test('login page is accessible', function () {
    $response = $this->get('/login');
    $response->assertOk();
});

test('user can login with correct credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email'    => $user->email,
        'password' => 'password123',
    ]);

    $this->assertAuthenticated();
});

test('user cannot login with wrong password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $this->post('/login', [
        'email'    => $user->email,
        'password' => 'wrongpassword',
    ]);

    $this->assertGuest();
});