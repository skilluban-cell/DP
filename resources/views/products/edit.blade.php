<x-layouts::app.sidebar>
    <flux:main>
        @livewire('products.product-edit', ['product' => $product])
    </flux:main>
</x-layouts::app.sidebar>