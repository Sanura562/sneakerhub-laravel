<div class="bg-gray-100 min-h-screen py-10 px-4 sm:px-8">
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden grid md:grid-cols-2 gap-6 p-6">
        <!-- Product Image -->
        <div class="flex justify-center items-center">
            <img src="{{ $product->img_url }}" alt="{{ $product->Name }}"
                class="w-full h-auto object-contain rounded-md">
        </div>

        <!-- Product Info -->
        <div class="flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->Name }}</h1>
                <p class="text-gray-500 text-sm mb-1"><strong>Brand:</strong> {{ $product->Brand }}</p>
                <p class="text-gray-500 text-sm mb-1"><strong>Category:</strong> {{ $product->Category }}</p>

                <div class="mt-4 mb-2">
                    @if ($product->Discount_Price && $product->Discount_Price < $product->Price)
                        <span class="text-2xl text-indigo-600 font-semibold">
                            ${{ number_format($product->Discount_Price, 2) }}
                        </span>
                        <span class="line-through text-gray-400 text-sm ml-2">
                            ${{ number_format($product->Price, 2) }}
                        </span>
                        @else
                        <span class="text-2xl text-indigo-600 font-semibold">
                            ${{ number_format($product->Price, 2) }}
                        </span>
                        @endif
                </div>

                <p class="text-gray-600 leading-relaxed mt-4">
                    {{ $product->Description }}
                </p>
            </div>

            <div class="mt-6">
                <button wire:click="addToCart('{{ $product->_id }}')"
                    class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Add to Cart
                </button>
                <a href="{{ route('checkout', ['id' => $product->_id]) }}"
                    class="mt-4 block w-full bg-black hover:bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                    Buy Now

                </a>
            </div>
        </div>
    </div>
</div>