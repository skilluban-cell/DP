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