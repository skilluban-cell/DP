<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Склади</flux:heading>
        <flux:button href="{{ route('warehouses.create') }}" variant="primary" icon="plus" wire:navigate>
            Додати склад
        </flux:button>
    </div>

    <div class="mb-4">
        <flux:input wire:model.live="search" placeholder="Пошук складу..." icon="magnifying-glass" />
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 text-left">Назва</th>
                    <th class="px-4 py-3 text-left">Адреса</th>
                    <th class="px-4 py-3 text-left">Позицій</th>
                    <th class="px-4 py-3 text-left">Дії</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($warehouses as $warehouse)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800" wire:key="warehouse-{{ $warehouse->id }}">
                        <td class="px-4 py-3 font-medium">{{ $warehouse->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $warehouse->address ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $warehouse->stock_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <flux:button size="sm" href="{{ route('warehouses.edit', $warehouse) }}" wire:navigate>
    Редагувати
</flux:button>
                                <form method="POST" action="/warehouses/{{ $warehouse->id }}" onsubmit="return confirm('Видалити склад?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
        Видалити
    </button>
</form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-zinc-400">Складів не знайдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>