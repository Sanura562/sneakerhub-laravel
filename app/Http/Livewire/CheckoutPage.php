<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutPage extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;
    public $address = '';
    public $paymentMethod = 'cod'; // e.g., cash on delivery

    public function mount()
    {
        $cart = Cart::where('User_ID', Auth::id())->first();
        $this->cartItems = $cart->items ?? [];
        $this->subtotal = collect($this->cartItems)->sum('Total_Price');
        $this->shipping = 0; // you can make this dynamic
        $this->total = $this->subtotal + $this->shipping;
    }

    public function placeOrder()
    {
        $this->validate([
            'address' => 'required|string|min:5',
            'paymentMethod' => 'required|string',
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'items' => $this->cartItems,
            'address' => $this->address,
            'total' => $this->total,
            'payment_method' => $this->paymentMethod,
            'status' => 'Pending',
        ]);

        Cart::where('User_ID', Auth::id())->update(['items' => []]);

        session()->flash('message', 'Order placed successfully!');
        return redirect()->to('/thank-you');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}