<div>
    <flux:heading size="xl" class="mb-6">Звіти та залишки</flux:heading>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-5">
            <div class="text-zinc-500 text-sm mb-1">Загальний прихід</div>
            <div class="text-3xl font-bold text-green-600">{{ number_format($totalIn, 2) }}</div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-5">
            <div class="text-zinc-500 text-sm mb-1">Загальна витрата</div>
            <div class="text-3xl font-bold text-red-600">{{ number_format($totalOut, 2) }}</div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-5">
            <div class="text-zinc-500 text-sm mb-1">Поточний залишок</div>
            <div class="text-3xl font-bold text-blue-600">{{ number_format($totalIn - $totalOut, 2) }}</div>
        </div>
    </div>

    <div class="flex gap-3 mb-4">
        <flux:input wire:model.live="search" placeholder="Пошук товару..." icon="magnifying-glass" class="flex-1" />
        <flux:select wire:model.live="warehouse_id" class="w-48">
            <flux:select.option value="">Всі склади</flux:select.option>
            @foreach($warehouses as $warehouse)
                <flux:select.option value="{{ $warehouse->id }}">{{ $warehouse->name }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 text-left">Товар</th>
                    <th class="px-4 py-3 text-left">Категорія</th>
                    <th class="px-4 py-3 text-left">Склад</th>
                    <th class="px-4 py-3 text-left">Залишок</th>
                    <th class="px-4 py-3 text-left">Од. виміру</th>
                    <th class="px-4 py-3 text-left">Статус</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($stock as $item)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-4 py-3 font-medium">{{ $item->product->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $item->product->category->name }}</td>
                        <td class="px-4 py-3">{{ $item->warehouse->name }}</td>
                        <td class="px-4 py-3 font-bold">{{ number_format($item->quantity, 2) }}</td>
                        <td class="px-4 py-3">{{ $item->product->unit }}</td>
                        <td class="px-4 py-3">
                            @if($item->quantity <= 0)
                                <span class="text-red-600 font-medium">❌ Немає</span>
                            @elseif($item->quantity <= 5)
                                <span class="text-orange-500 font-medium">⚠️ Мало</span>
                            @else
                                <span class="text-green-600 font-medium">✅ В наявності</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-zinc-400">Даних не знайдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>