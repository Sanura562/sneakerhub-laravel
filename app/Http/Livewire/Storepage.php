<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Storepage extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $cart = Cart::firstOrCreate(
            ['User_ID' => Auth::id()],
            ['items' => [], 'CreatedAt' => now(), 'UpdatedAt' => now()]
        );

        $items = $cart->items ?? [];
        $existingIndex = collect($items)->search(fn($item) => $item['ProductID'] === (string) $product->_id);

        if ($existingIndex !== false) {
            $items[$existingIndex]['Quantity'] += 1;
            $items[$existingIndex]['Total_Price'] = $items[$existingIndex]['Quantity'] * $items[$existingIndex]['Price'];
        } else {
            $items[] = [
                'ItemID' => (string) Str::uuid(),
                'ProductID' => (string) $product->_id,
                'product_name' => $product->product_name,
                'img_url' => $product->img_url,
                'Quantity' => 1,
                'Price' => $product->price,
                'Total_Price' => $product->price,
            ];
        }

        $cart->items = $items;
        $cart->UpdatedAt = now();
        $cart->save();

        $this->dispatchBrowserEvent('cart-updated', ['message' => 'Product added to cart!']);
    }

    public function render()
    {
        return view('livewire.storepage', [
            'products' => $this->products,
        ]);
    }
}