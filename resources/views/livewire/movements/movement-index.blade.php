<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Рух товарів</flux:heading>
        <flux:button type="button" variant="primary" icon="plus" wire:click.prevent="openCreate">
            Додати рух
        </flux:button>
    </div>

    @if($showForm)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl mb-6">
            <flux:heading size="lg" class="mb-4">Новий рух товару</flux:heading>
            <form wire:submit="save">
                <div class="grid gap-4">
                    <flux:field>
                        <flux:label>Товар</flux:label>
                        <flux:select wire:model="product_id">
                            <flux:select.option value="">-- Оберіть товар --</flux:select.option>
                            @foreach($products as $product)
                                <flux:select.option value="{{ $product->id }}">{{ $product->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="product_id" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Склад</flux:label>
                        <flux:select wire:model="warehouse_id">
                            <flux:select.option value="">-- Оберіть склад --</flux:select.option>
                            @foreach($warehouses as $warehouse)
                                <flux:select.option value="{{ $warehouse->id }}">{{ $warehouse->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="warehouse_id" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Тип операції</flux:label>
                        <flux:select wire:model="type">
                            <flux:select.option value="in">📥 Прихід</flux:select.option>
                            <flux:select.option value="out">📤 Витрата</flux:select.option>
                        </flux:select>
                        <flux:error name="type" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Кількість</flux:label>
                        <flux:input wire:model="quantity" type="number" step="0.01" placeholder="0" />
                        <flux:error name="quantity" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Коментар</flux:label>
                        <flux:textarea wire:model="note" rows="2" placeholder="Коментар (необов'язково)" />
                    </flux:field>
                </div>
                <div class="flex gap-3 mt-4">
                    <flux:button type="submit" variant="primary">Зберегти</flux:button>
                    <flux:button variant="ghost" wire:click="$set('showForm', false)">Скасувати</flux:button>
                </div>
            </form>
        </div>
    @endif

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
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
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