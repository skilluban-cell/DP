<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    public string $search = '';

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('livewire.categories.category-index', compact('categories'));
    }
}