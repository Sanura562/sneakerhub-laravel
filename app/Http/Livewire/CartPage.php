<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartPage extends Component
{
    public $cart;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Cart::where('User_ID', Auth::id())->value('items') ?? [];
    }

    public function incrementQuantity($itemId)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['ItemID'] === $itemId) {
                $item['Quantity']++;
                $item['Total_Price'] = $item['Quantity'] * $item['Price'];
            }
        }
        $this->saveCart();
    }

    public function decrementQuantity($itemId)
    {
        foreach ($this->cartItems as $index => &$item) {
            if ($item['ItemID'] === $itemId) {
                if ($item['Quantity'] > 1) {
                    $item['Quantity']--;
                    $item['Total_Price'] = $item['Quantity'] * $item['Price'];
                } else {
                    unset($this->cartItems[$index]);
                }
                break;
            }
        }
        $this->cartItems = array_values($this->cartItems); // reindex
        $this->saveCart();
    }

    public function addToCart($product)
    {
        $newItem = [
            'ItemID' => (string) Str::uuid(),
            'ProductID' => $product['_id'],
            'product_name' => $product['product_name'],
            'img_url' => $product['img_url'] ?? '',
            'Quantity' => 1,
            'Price' => $product['price'],
            'Total_Price' => $product['price'],
        ];

        $this->cartItems[] = $newItem;
        $this->saveCart();
    }

    public function saveCart()
    {
        $cart = Cart::firstOrCreate(['User_ID' => Auth::id()]);
        $cart->items = $this->cartItems;
        $cart->UpdatedAt = now();
        $cart->save();

        $this->loadCart(); // Refresh
    }
     public static function currentUserCart()
    {
        if (!Auth::check()) {
            return null;
        }

        return static::firstOrCreate(
            ['User_ID' => Auth::id()],
            ['CreatedAt' => now(), 'UpdatedAt' => now(), 'items' => []]
        );
    }

    public function render()
    {
        $subtotal = collect($this->cartItems)->sum('Total_Price');

        return view('livewire.shopping-cart', [
            'cartItems' => $this->cartItems,
            'subtotal' => $subtotal,
        ]);
    }
    
}