<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CategoryEdit extends Component
{
    public Category $category;
    public string $name = '';
    public string $description = '';

    public function mount(Category $category): void
    {
        $this->category    = $category;
        $this->name        = $category->name;
        $this->description = $category->description ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $this->category->update([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'description' => $this->description,
        ]);

        session()->flash('success', 'Категорію оновлено!');
        $this->redirect(route('categories.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.categories.category-edit');
    }
}