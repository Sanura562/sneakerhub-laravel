<div>
    <div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Shopping Cart</h1>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
                    @forelse ($cartItems as $item)
                    <div class="flex items-center justify-between border-b pb-4 mb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $item['img_url'] }}" class="h-20 w-20 object-contain rounded" alt="Image">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['product_name'] }}</p>
                                <p class="text-gray-500">$ {{ number_format($item['price'], 2) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <button wire:click="decrement('{{ $item['id'] }}')"
                                class="px-3 py-1 bg-gray-300 text-gray-800 rounded">-</button>
                            <span>{{ $item['quantity'] }}</span>
                            <button wire:click="increment('{{ $item['id'] }}')"
                                class="px-3 py-1 bg-gray-300 text-gray-800 rounded">+</button>
                        </div>

                        <div class="text-right">
                            <p class="text-gray-700">$ {{ number_format($item['total'], 2) }}</p>
                            <button wire:click="remove('{{ $item['id'] }}')"
                                class="text-red-500 text-sm mt-1 hover:underline">Remove</button>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-500">Your cart is empty.</p>
                    @endforelse
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>$ {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-4">
                        <span>Shipping</span>
                        <span>$0.00</span>
                    </div>
                    <hr class="mb-4">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span>$ {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <a href="/checkout-page"
                        class="mt-6 block bg-black text-white text-center py-2 rounded hover:bg-gray-800 transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>