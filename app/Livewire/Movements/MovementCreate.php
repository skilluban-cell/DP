<?php

namespace App\Livewire\Movements;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Livewire\Component;

class MovementCreate extends Component
{
    public int|string $product_id = '';
    public int|string $warehouse_id = '';
    public string $type = 'in';
    public string $quantity = '';
    public string $note = '';

    protected function rules(): array
    {
        return [
            'product_id'   => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'type'         => 'required|in:in,out',
            'quantity'     => 'required|numeric|min:0.01',
            'note'         => 'nullable',
        ];
    }

    public function save(): void
    {
        $this->validate();

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

        session()->flash('success', 'Рух товару успішно додано!');
        $this->redirect(route('movements.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.movements.movement-create', [
            'products'   => Product::orderBy('name')->get(),
            'warehouses' => Warehouse::orderBy('name')->get(),
        ]);
    }
}
