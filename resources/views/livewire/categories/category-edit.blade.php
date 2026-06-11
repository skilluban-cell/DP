<div>
    <div class="flex items-center gap-3 mb-6">
        <flux:button href="{{ route('categories.index') }}" variant="ghost" icon="arrow-left" wire:navigate />
        <flux:heading size="xl">Редагувати категорію</flux:heading>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-6 max-w-2xl">
        <form wire:submit="save">
            <div class="grid gap-4">
                <flux:field>
                    <flux:label>Назва категорії</flux:label>
                    <flux:input wire:model="name" />
                    <flux:error name="name" />
                </flux:field>
                <flux:field>
                    <flux:label>Опис</flux:label>
                    <flux:textarea wire:model="description" rows="3" />
                </flux:field>
            </div>
            <div class="flex gap-3 mt-6">
                <flux:button type="submit" variant="primary">Оновити</flux:button>
                <flux:button href="{{ route('categories.index') }}" variant="ghost" wire:navigate>Скасувати</flux:button>
            </div>
        </form>
    </div>
</div>