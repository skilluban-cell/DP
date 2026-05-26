<?php

namespace App\Livewire\Reports;

use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Livewire\Component;

class ReportIndex extends Component
{
    public int|string $warehouse_id = '';
    public string $search = '';

    public function render()
    {
        $stock = Stock::query()
            ->with(['product.category', 'warehouse'])
            ->when($this->warehouse_id, fn($q) =>
                $q->where('warehouse_id', $this->warehouse_id)
            )
            ->when($this->search, fn($q) =>
                $q->whereHas('product', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
            )
            ->orderBy('quantity')
            ->get();

        $totalIn  = StockMovement::where('type', 'in')->sum('quantity');
        $totalOut = StockMovement::where('type', 'out')->sum('quantity');

        return view('livewire.reports.report-index', [
            'stock'      => $stock,
            'warehouses' => Warehouse::orderBy('name')->get(),
            'totalIn'    => $totalIn,
            'totalOut'   => $totalOut,
        ]);
    }
}