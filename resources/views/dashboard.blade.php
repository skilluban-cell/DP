<x-layouts::app.sidebar>

    <flux:main>
        <flux:heading size="xl" class="mb-6">Панель керування</flux:heading>

        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-gray-500 text-sm mb-1">Товарів</div>
                <div class="text-3xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-gray-500 text-sm mb-1">Категорій</div>
                <div class="text-3xl font-bold text-green-600">{{ \App\Models\Category::count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-gray-500 text-sm mb-1">Складів</div>
                <div class="text-3xl font-bold text-purple-600">{{ \App\Models\Warehouse::count() }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-gray-500 text-sm mb-1">Рухів товарів</div>
                <div class="text-3xl font-bold text-orange-600">{{ \App\Models\StockMovement::count() }}</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <flux:heading size="lg" class="mb-4">Останні рухи товарів</flux:heading>
            <flux:text>Поки що рухів немає.</flux:text>
        </div>
    </flux:main>

</x-layouts::app.sidebar>