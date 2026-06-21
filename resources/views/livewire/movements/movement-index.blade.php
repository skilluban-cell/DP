<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Рух товарів</flux:heading>
        <flux:button href="{{ route('movements.create') }}" variant="primary" icon="plus" wire:navigate>
            Додати рух
        </flux:button>
    </div>

    <div class="flex gap-3 mb-4">
        <flux:input wire:model.live="search" placeholder="Пошук за товаром..." icon="magnifying-glass" class="flex-1" />
        <flux:select wire:model.live="filterType" class="w-40">
            <flux:select.option value="">Всі типи</flux:select.option>
            <flux:select.option value="in">Прихід</flux:select.option>
            <flux:select.option value="out">Витрата</flux:select.option>
        </flux:select>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 text-left">Дата</th>
                    <th class="px-4 py-3 text-left">Товар</th>
                    <th class="px-4 py-3 text-left">Склад</th>
                    <th class="px-4 py-3 text-left">Тип</th>
                    <th class="px-4 py-3 text-left">Кількість</th>
                    <th class="px-4 py-3 text-left">Користувач</th>
                    <th class="px-4 py-3 text-left">Коментар</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($movements as $movement)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800" wire:key="movement-{{ $movement->id }}">
                        <td class="px-4 py-3 text-zinc-500">{{ $movement->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-3 font-medium">{{ $movement->product->name }}</td>
                        <td class="px-4 py-3">{{ $movement->warehouse->name }}</td>
                        <td class="px-4 py-3">
                            @if($movement->type === 'in')
                                <span class="text-green-600 font-medium">📥 Прихід</span>
                            @else
                                <span class="text-red-600 font-medium">📤 Витрата</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $movement->quantity }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $movement->user->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $movement->note ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-zinc-400">Рухів товарів не знайдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-4 py-3">
            {{ $movements->links() }}
        </div>
    </div>
</div>