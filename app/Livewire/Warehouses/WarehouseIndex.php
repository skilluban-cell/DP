<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Livewire\Component;

class WarehouseIndex extends Component
{
    public string $search = '';
    public string $name = '';
    public string $address = '';
    public bool $showForm = false;
    public ?int $editingId = null;

    public function openCreate(): void
    {
        $this->name = '';
        $this->address = '';
        $this->editingId = null;
        $this->showForm = true;
    }

    public function openEdit(Warehouse $warehouse): void
    {
        $this->editingId = $warehouse->id;
        $this->name      = $warehouse->name;
        $this->address   = $warehouse->address ?? '';
        $this->showForm  = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        Warehouse::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name'    => $this->name,
                'address' => $this->address,
            ]
        );

        $this->name = '';
        $this->address = '';
        $this->editingId = null;
        $this->showForm = false;
    }

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