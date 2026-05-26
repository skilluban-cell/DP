<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    public string $search = '';
    public string $name = '';
    public string $description = '';
    public bool $showForm = false;
    public ?int $editingId = null;

    public function openCreate(): void
    {
        $this->reset(['name', 'description', 'editingId']);
        $this->showForm = true;
    }

    public function openEdit(Category $category): void
    {
        $this->editingId   = $category->id;
        $this->name        = $category->name;
        $this->description = $category->description ?? '';
        $this->showForm    = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        Category::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name'        => $this->name,
                'slug'        => Str::slug($this->name),
                'description' => $this->description,
            ]
        );

        $this->reset(['name', 'description', 'editingId', 'showForm']);
    }

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