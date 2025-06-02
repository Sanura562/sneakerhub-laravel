<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Component
{
    public $cartItems = [];

    public function mount()
    {
        $this->cartItems = Cart::currentUserCart()->items;
    }

    public function increment($itemId)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['id'] === $itemId) {
                $item['quantity']++;
                $item['total'] = $item['quantity'] * $item['price'];
            }
        }
        $this->save();
    }

    public function decrement($itemId)
    {
        foreach ($this->cartItems as $index => &$item) {
            if ($item['id'] === $itemId) {
                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                    $item['total'] = $item['quantity'] * $item['price'];
                } else {
                    unset($this->cartItems[$index]);
                }
                break;
            }
        }
        $this->cartItems = array_values($this->cartItems); // Reindex
        $this->save();
    }

    public function remove($itemId)
    {
        $this->cartItems = array_filter($this->cartItems, fn($item) => $item['id'] !== $itemId);
        $this->save();
    }

    public function save()
    {
        $cart = Cart::currentUserCart();
        $cart->items = $this->cartItems;
        $cart->updated_at = now();
        $cart->save();
    }

    public function render()
    {
        $subtotal = collect($this->cartItems)->sum('total');
        return view('livewire.shopping-cart', [
            'cartItems' => $this->cartItems,
            'subtotal' => $subtotal,
        ]);
    }
}