<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Категорії</flux:heading>
        <flux:button href="{{ route('categories.create') }}" variant="primary" icon="plus" wire:navigate>
            Додати категорію
        </flux:button>
    </div>

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
                                <flux:button size="sm" href="{{ route('categories.edit', $category) }}" wire:navigate>
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