<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ViewProducts extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function confirmDelete($productId)
    {
        Product::where('_id', $productId)->delete();
        $this->products = Product::all(); // Refresh the list
        session()->flash('message', 'Product deleted successfully!');
    }

    public function render()
    {
        return view('livewire.view-products');
    }
}