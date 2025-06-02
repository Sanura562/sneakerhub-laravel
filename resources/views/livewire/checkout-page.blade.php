<div>
    <div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Checkout</h2>

            <div>
                <label class="block font-semibold mb-1">Shipping Address</label>
                <textarea wire:model="address" class="w-full border rounded p-2"></textarea>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Payment Method</label>
                <select wire:model="paymentMethod" class="w-full border rounded p-2">
                    <option value="cod">Cash on Delivery</option>
                    <option value="card">Credit/Debit Card</option>
                </select>
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>${{ number_format($shipping, 2) }}</span>
                </div>
                <div class="flex justify-between font-semibold text-lg">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <button wire:click="placeOrder"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded w-full">
                Place Order
            </button>

            @if (session()->has('message'))
            <div class="text-green-600 text-center mt-4">{{ session('message') }}</div>
            @endif
        </div>
    </div>
</div>