<div>
    <div class="flex items-center gap-3 mb-6">
        <flux:button href="{{ route('movements.index') }}" variant="ghost" icon="arrow-left" wire:navigate />
        <flux:heading size="xl">Додати рух товару</flux:heading>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl">
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

                <div class="grid grid-cols-2 gap-4">
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
                </div>

                <flux:field>
                    <flux:label>Коментар</flux:label>
                    <flux:textarea wire:model="note" rows="2" placeholder="Коментар (необов'язково)" />
                </flux:field>

            </div>

            <div class="flex gap-3 mt-6">
                <flux:button type="submit" variant="primary">Зберегти</flux:button>
                <flux:button href="{{ route('movements.index') }}" variant="ghost" wire:navigate>Скасувати</flux:button>
            </div>
        </form>
    </div>
</div>
