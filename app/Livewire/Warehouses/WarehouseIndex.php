<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Livewire\Component;

class WarehouseIndex extends Component
{
    public string $search = '';

    public function delete(int $id): void
    {
        Warehouse::findOrFail($id)->delete();
    }

    public function render()
    {
        $warehouses = Warehouse::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->withCount('stock')
            ->orderBy('name')
            ->get();

        return view('livewire.warehouses.warehouse-index', compact('warehouses'));
    }
}