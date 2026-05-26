<div>
    <div class="flex items-center justify-between mb-6">
        <flux:heading size="xl">Товари</flux:heading>
        <flux:button href="{{ route('products.create') }}" variant="primary" icon="plus" wire:navigate>
            Додати товар
        </flux:button>
    </div>

    @if(session('success'))
        <flux:callout variant="success" class="mb-4">{{ session('success') }}</flux:callout>
    @endif

    <div class="mb-4">
        <flux:input wire:model.live="search" placeholder="Пошук за назвою або артикулом..." icon="magnifying-glass" />
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 text-left cursor-pointer" wire:click="sort('name')">Назва</th>
                    <th class="px-4 py-3 text-left cursor-pointer" wire:click="sort('sku')">Артикул</th>
                    <th class="px-4 py-3 text-left">Категорія</th>
                    <th class="px-4 py-3 text-left cursor-pointer" wire:click="sort('price')">Ціна</th>
                    <th class="px-4 py-3 text-left">Од. виміру</th>
                    <th class="px-4 py-3 text-left">Дії</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                @forelse($products as $product)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $product->sku }}</td>
                        <td class="px-4 py-3">{{ $product->category->name }}</td>
                        <td class="px-4 py-3">{{ number_format($product->price, 2) }} грн</td>
                        <td class="px-4 py-3">{{ $product->unit }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <flux:button size="sm" href="{{ route('products.edit', $product) }}" wire:navigate>
                                    Редагувати
                                </flux:button>
                                <flux:button size="sm" variant="danger" wire:click="delete({{ $product->id }})" wire:confirm="Видалити товар?">
                                    Видалити
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-zinc-400">Товарів не знайдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-4 py-3">
            {{ $products->links() }}
        </div>
    </div>
</div>