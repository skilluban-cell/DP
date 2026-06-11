<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Livewire\Component;

class WarehouseEdit extends Component
{
    public Warehouse $warehouse;
    public string $name = '';
    public string $address = '';

    public function mount(Warehouse $warehouse): void
    {
        $this->warehouse = $warehouse;
        $this->name      = $warehouse->name;
        $this->address   = $warehouse->address ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $this->warehouse->update([
            'name'    => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Склад оновлено!');
        $this->redirect(route('warehouses.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.warehouses.warehouse-edit');
    }
}