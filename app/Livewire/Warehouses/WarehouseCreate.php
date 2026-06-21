<?php

namespace App\Livewire\Warehouses;

use App\Models\Warehouse;
use Livewire\Component;

class WarehouseCreate extends Component
{
    public string $name = '';
    public string $address = '';

    protected array $rules = [
        'name' => 'required|min:2',
        'address' => 'nullable',
    ];

    public function save(): void
    {
        $this->validate();

        Warehouse::create([
            'name'    => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Склад успішно додано!');
        $this->redirect(route('warehouses.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.warehouses.warehouse-create');
    }
}
