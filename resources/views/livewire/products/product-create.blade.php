<div>
    <div class="flex items-center gap-3 mb-6">
        <flux:button href="{{ route('products.index') }}" variant="ghost" icon="arrow-left" wire:navigate />
        <flux:heading size="xl">Додати товар</flux:heading>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl">
        <form wire:submit="save">
            <div class="grid gap-4">

                <flux:field>
                    <flux:label>Назва товару</flux:label>
                    <flux:input wire:model="name" placeholder="Наприклад: Смартфон Samsung" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Артикул (SKU)</flux:label>
                    <flux:input wire:model="sku" placeholder="Наприклад: EL-001" />
                    <flux:error name="sku" />
                </flux:field>

                <flux:field>
                    <flux:label>Категорія</flux:label>
                    <flux:select wire:model="category_id">
                        <flux:select.option value="">-- Оберіть категорію --</flux:select.option>
                        @foreach($categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="category_id" />
                </flux:field>

                <div class="grid grid-cols-2 gap-4">
                    <flux:field>
                        <flux:label>Ціна (грн)</flux:label>
                        <flux:input wire:model="price" type="number" step="0.01" placeholder="0.00" />
                        <flux:error name="price" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Одиниця виміру</flux:label>
                        <flux:select wire:model="unit">
                            <flux:select.option value="шт">шт</flux:select.option>
                            <flux:select.option value="кг">кг</flux:select.option>
                            <flux:select.option value="л">л</flux:select.option>
                            <flux:select.option value="м">м</flux:select.option>
                        </flux:select>
                        <flux:error name="unit" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Опис</flux:label>
                    <flux:textarea wire:model="description" placeholder="Опис товару (необов'язково)" rows="3" />
                    <flux:error name="description" />
                </flux:field>

                <flux:field>
    <flux:label>Фото товару</flux:label>
    <input type="file" wire:model="photo" accept="image/*" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200" />
    <flux:error name="photo" />
    @if($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="mt-2 h-24 rounded object-cover" />
    @endif
</flux:field>

            </div>

            <div class="flex gap-3 mt-6">
                <flux:button type="submit" variant="primary">Зберегти</flux:button>
                <flux:button href="{{ route('products.index') }}" variant="ghost" wire:navigate>Скасувати</flux:button>
            </div>
        </form>
    </div>
</div>