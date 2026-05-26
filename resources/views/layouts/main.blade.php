<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Облік товарів' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Навігація --}}
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span class="font-bold text-lg text-blue-700">📦 Облік товарів</span>
                <a href="{{ route('dashboard') }}"   class="text-gray-600 hover:text-blue-600">Головна</a>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-blue-600">Товари</a>
                <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-blue-600">Категорії</a>
                <a href="{{ route('warehouses.index') }}" class="text-gray-600 hover:text-blue-600">Склади</a>
                <a href="{{ route('movements.index') }}" class="text-gray-600 hover:text-blue-600">Рух товарів</a>
                <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-blue-600">Звіти</a>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-gray-500 text-sm">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-500 hover:text-red-700">Вийти</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Контент --}}
    <main class="max-w-7xl mx-auto px-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>