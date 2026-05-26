<?php

namespace App\Livewire\Movements;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;

class MovementIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterType = '';
    public bool $showForm = false;

    public int|string $product_id = '';
    public int|string $warehouse_id = '';
    public string $type = 'in';
    public string $quantity = '';
    public string $note = '';

    public function openCreate(): void
    {
        $this->reset(['product_id', 'warehouse_id', 'type', 'quantity', 'note']);
        $this->type = 'in';
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'product_id'   => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type'         => 'required|in:in,out',
            'quantity'     => 'required|numeric|min:0.01',
            'note'         => 'nullable',
        ]);

        // Оновлюємо залишки
        $stock = Stock::firstOrCreate(
            ['product_id' => $this->product_id, 'warehouse_id' => $this->warehouse_id],
            ['quantity' => 0]
        );

        if ($this->type === 'in') {
            $stock->increment('quantity', $this->quantity);
        } else {
            if ($stock->quantity < $this->quantity) {
                $this->addError('quantity', 'Недостатньо товару на складі!');
                return;
            }
            $stock->decrement('quantity', $this->quantity);
        }

        StockMovement::create([
            'product_id'   => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'user_id'      => auth()->id(),
            'type'         => $this->type,
            'quantity'     => $this->quantity,
            'note'         => $this->note,
        ]);

        $this->reset(['product_id', 'warehouse_id', 'quantity', 'note', 'showForm']);
        $this->type = 'in';
    }

    public function render()
    {
        $movements = StockMovement::query()
            ->with(['product', 'warehouse', 'user'])
            ->when($this->search, fn($q) =>
                $q->whereHas('product', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
            )
            ->when($this->filterType, fn($q) =>
                $q->where('type', $this->filterType)
            )
            ->latest()
            ->paginate(10);

        return view('livewire.movements.movement-index', [
            'movements'  => $movements,
            'products'   => Product::orderBy('name')->get(),
            'warehouses' => Warehouse::orderBy('name')->get(),
        ]);
    }
}