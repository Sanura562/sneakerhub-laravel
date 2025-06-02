@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">Explore Our Shoe Collection</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        {{-- Product 1 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://example.com/images/airmax270.jpg" alt="Air Max 270"
                    class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Air Max 270</h2>
                <p class="text-gray-700 mb-1 truncate" title="Comfortable and stylish running shoes.">Comfortable and
                    stylish running shoes.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">$150.00</p>
                        <p class="text-sm line-through text-gray-400">$130.00</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Nike</p>
                        <p>Category: Running</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>

        {{-- Product 2 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://example.com/images/ultraboost21.jpg" alt="UltraBoost 21"
                    class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">UltraBoost 21</h2>
                <p class="text-gray-700 mb-1 truncate" title="Responsive running shoe with great energy return.">
                    Responsive running shoe with great energy return.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">$180.00</p>
                        <p class="text-sm line-through text-gray-400">$160.00</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Adidas</p>
                        <p>Category: Running</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>

        {{-- Product 3 --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                <img src="https://example.com/images/classicvans.jpg" alt="Classic Vans"
                    class="object-contain h-full w-full">
            </div>
            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">Classic Vans</h2>
                <p class="text-gray-700 mb-1 truncate" title="Iconic skate shoes with timeless style.">Iconic skate
                    shoes with timeless style.</p>
                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">$60.00</p>
                        <p class="text-sm line-through text-gray-400">$50.00</p>
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: Vans</p>
                        <p>Category: Casual</p>
                    </div>
                </div>
                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>
    </div>
</div>
@endsection