<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Склади</flux:heading>
        <flux:button variant="primary" icon="plus" wire:click="openCreate">
            Додати склад
        </flux:button>
    </div>

    @if($showForm)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl mb-6">
            <flux:heading size="lg" class="mb-4">
                {{ $editingId ? 'Редагувати склад' : 'Новий склад' }}
            </flux:heading>
            <form wire:submit="save">
                <div class="grid gap-4">
                    <flux:field>
                        <flux:label>Назва складу</flux:label>
                        <flux:input wire:model="name" placeholder="Наприклад: Головний склад" />
                        <flux:error name="name" />
                    </flux:field>
                    <flux:field>
                        <flux:label>Адреса</flux:label>
                        <flux:input wire:model="address" placeholder="Адреса (необов'язково)" />
                    </flux:field>
                </div>
                <div class="flex gap-3 mt-4">
                    <flux:button type="submit" variant="primary">Зберегти</flux:button>
                    <flux:button variant="ghost" wire:click="$set('showForm', false)">Скасувати</flux:button>
                </div>
            </form>
        </div>
    @endif

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
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-4 py-3 font-medium">{{ $warehouse->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $warehouse->address ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $warehouse->stock_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <flux:button size="sm" wire:click="openEdit({{ $warehouse->id }})">
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