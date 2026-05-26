<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $sku = '';
    public string $description = '';
    public string $price = '';
    public string $unit = 'шт';
    public $photo = null;
    public int|string $category_id = '';

    protected array $rules = [
        'name'        => 'required|min:2',
        'sku'         => 'required|unique:products,sku',
        'price'       => 'required|numeric|min:0',
        'unit'        => 'required',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable',
        'photo' => 'nullable|image|max:2048',
    ];

    public function save(): void
    {
        $this->validate();

        $imagePath = $this->photo ? $this->photo->store('products', 'public') : null;

Product::create([
    'name'        => $this->name,
    'sku'         => $this->sku,
    'description' => $this->description,
    'price'       => $this->price,
    'unit'        => $this->unit,
    'category_id' => $this->category_id,
    'image'       => $imagePath,
]);

        session()->flash('success', 'Товар успішно додано!');
        $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.products.product-create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}