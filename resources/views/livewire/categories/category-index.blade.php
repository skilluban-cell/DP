<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Категорії</flux:heading>
        <flux:button variant="primary" icon="plus" wire:click="openCreate">
            Додати категорію
        </flux:button>
    </div>

    @if($showForm)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl mb-6">
            <flux:heading size="lg" class="mb-4">
                {{ $editingId ? 'Редагувати категорію' : 'Нова категорія' }}
            </flux:heading>
            <form wire:submit="save">
                <div class="grid gap-4">
                    <flux:field>
                        <flux:label>Назва</flux:label>
                        <flux:input wire:model="name" placeholder="Назва категорії" />
                        <flux:error name="name" />
                    </flux:field>
                    <flux:field>
                        <flux:label>Опис</flux:label>
                        <flux:textarea wire:model="description" rows="2" placeholder="Опис (необов'язково)" />
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
        <flux:input wire:model.live="search" placeholder="Пошук категорії..." icon="magnifying-glass" />
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 text-left">Назва</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-left">Товарів</th>
                    <th class="px-4 py-3 text-left">Дії</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($categories as $category)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $category->slug }}</td>
                        <td class="px-4 py-3">{{ $category->products_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <flux:button size="sm" wire:click="openEdit({{ $category->id }})">
                                    Редагувати
                                </flux:button>
                                <form method="POST" action="/categories/{{ $category->id }}" onsubmit="return confirm('Видалити категорію?')">
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
                        <td colspan="4" class="px-4 py-8 text-center text-zinc-400">Категорій не знайдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>