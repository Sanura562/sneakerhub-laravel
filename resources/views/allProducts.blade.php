@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-900">Explore Our Shoe Collection</h1>

    @if ($products->isEmpty())
    <p class="text-center text-gray-500 text-lg">No products available.</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            {{-- Image Placeholder --}}
            <div class="relative h-64 bg-gray-100 flex items-center justify-center">
                @if(isset($product->img_url) && $product->img_url !== '')
                <img src="{{ $product->img_url }}" alt="{{ $product->Name }}" class="object-contain h-full w-full">
                @else
                <span class="text-gray-400 text-3xl">No Image</span>
                @endif
            </div>

            <div class="p-5">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 truncate">{{ $product->Name ?? 'N/A' }}</h2>
                <p class="text-gray-700 mb-1 truncate" title="{{ $product->Description ?? '' }}">
                    {{ $product->Description ?? 'No description available.' }}</p>

                <div class="flex items-center justify-between mt-3">
                    <div>
                        <p class="text-lg font-bold text-indigo-600">${{ $product->Price ?? 'N/A' }}</p>
                        @if($product->Discount_Price && $product->Discount_Price > 0)
                        <p class="text-sm line-through text-gray-400">${{ $product->Discount_Price }}</p>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 text-right">
                        <p>Brand: {{ $product->Brand ?? 'N/A' }}</p>
                        <p>Category: {{ $product->Category ?? 'N/A' }}</p>
                    </div>
                </div>

                <button
                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition duration-300">
                    View Details
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection