<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryCreate extends Component
{
    public string $name = '';
    public string $description = '';

    protected array $rules = [
        'name' => 'required|min:2',
        'description' => 'nullable',
    ];

    public function save(): void
    {
        $this->validate();

        Category::create([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('success', 'Категорію успішно додано!');
        $this->redirect(route('categories.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.categories.category-create');
    }
}
