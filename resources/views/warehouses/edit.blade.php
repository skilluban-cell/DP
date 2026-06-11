<x-layouts::app.sidebar>
    <flux:main>
        @livewire('warehouses.warehouse-edit', ['warehouse' => $warehouse])
    </flux:main>
</x-layouts::app.sidebar>