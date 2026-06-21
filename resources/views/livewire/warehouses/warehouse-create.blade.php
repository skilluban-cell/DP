<div>
    <div class="flex items-center gap-3 mb-6">
        <flux:button href="{{ route('warehouses.index') }}" variant="ghost" icon="arrow-left" wire:navigate />
        <flux:heading size="xl">Додати склад</flux:heading>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl">
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
                    <flux:error name="address" />
                </flux:field>

            </div>

            <div class="flex gap-3 mt-6">
                <flux:button type="submit" variant="primary">Зберегти</flux:button>
                <flux:button href="{{ route('warehouses.index') }}" variant="ghost" wire:navigate>Скасувати</flux:button>
            </div>
        </form>
    </div>
</div>
