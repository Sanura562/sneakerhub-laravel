<div>
    <div class="container mx-auto px-4 mt-6">
        <div class="flex justify-start">
            <label for="category" class="mr-2 font-semibold text-gray-700">Filter:</label>
            <select wire:model="filter" id="category" name="category"
                class="rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="all">All</option>



            </select>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            @forelse ($products as $product)
            <a href="{{ route('product.view', ['id' => $product->_id]) }}" class="block">
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $product->img_url }}" alt="{{ $product->Name }}"
                        class="w-full h-46 object-contain bg-white">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->Name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">Brand: {{ $product->Brand ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">{{ $product->Category ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">Discount:
                            {{ $product->Discount_Price ? '$' . number_format($product->Discount_Price, 2) : 'N/A' }}
                        </p>
                        <p class="text-gray-500 text-sm mt-2">{{ Str::limit($product->Description, 100) }}</p>
                        <p class="text-indigo-600 font-bold mt-1">
                            {{ $product->Price ? 'LKR ' . number_format($product->Price, 2) : 'N/A' }}
                        </p>
                        <div class="mt-4 text-right">
                            <button wire:click.prevent="addToCart({{ $product->_id }})"
                                class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <p class="col-span-full text-center text-gray-500">No products available.</p>
            @endforelse

        </div>
    </main>

    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 transition-opacity duration-300">
        {{ session('message') }}
    </div>
    @endif
</div>
</div>