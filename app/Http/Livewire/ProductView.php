<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductView extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function render()
    {
          $products = Product::all();
        return view('livewire.product-view');
    }
}