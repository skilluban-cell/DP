<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductEdit extends Component
{
    use WithFileUploads;
    public Product $product;

    public string $name = '';
    public string $sku = '';
    public string $description = '';
    public string $price = '';
    public string $unit = 'шт';
    public int|string $category_id = '';
    public $photo = null;

    protected function rules(): array
    {
        return [
            'name'        => 'required|min:2',
            'sku'         => "required|unique:products,sku,{$this->product->id}",
            'price'       => 'required|numeric|min:0',
            'unit'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function mount(Product $product): void
    {
        $this->product     = $product;
        $this->name        = $product->name;
        $this->sku         = $product->sku;
        $this->description = $product->description ?? '';
        $this->price       = (string) $product->price;
        $this->unit        = $product->unit;
        $this->category_id = $product->category_id;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
    'name'        => $this->name,
    'sku'         => $this->sku,
    'description' => $this->description,
    'price'       => $this->price,
    'unit'        => $this->unit,
    'category_id' => $this->category_id,
];

if ($this->photo) {
    $data['image'] = $this->photo->store('products', 'public');
}

$this->product->update($data);

        session()->flash('success', 'Товар успішно оновлено!');
        $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.products.product-edit', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}