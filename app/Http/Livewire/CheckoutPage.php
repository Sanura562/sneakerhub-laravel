<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutPage extends Component
{
    public $product;
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;
    public $address = '';
    public $paymentMethod = 'cod';

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->subtotal = $this->product->Discount_Price ?? $this->product->Price;
        $this->shipping = 0;
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
            'items' => [[
                'ProductID' => $this->product->_id,
                'Name' => $this->product->Name,
                'Price' => $this->product->Discount_Price ?? $this->product->Price,
            ]],
            'address' => $this->address,
            'total' => $this->total,
            'payment_method' => $this->paymentMethod,
            'status' => 'Pending',
        ]);

        session()->flash('message', 'Order placed successfully!');
        return redirect()->to('/thank-you');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
    
}