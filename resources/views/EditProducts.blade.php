@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-md rounded-md">
    <h2 class="text-2xl font-bold mb-6">Update Product</h2>
    <form action="{{ route('products.update', $product->_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="Name" class="block text-gray-700 font-semibold">Product Name</label>
            <input type="text" name="Name" id="Name" value="{{ old('Name', $product->Name) }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="Brand" class="block text-gray-700 font-semibold">Brand</label>
            <input type="text" name="Brand" id="Brand" value="{{ old('Brand', $product->Brand) }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="Price" class="block text-gray-700 font-semibold">Price</label>
            <input type="number" step="0.01" name="Price" id="Price" value="{{ old('Price', $product->Price) }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="Description" class="block text-gray-700 font-semibold">Description</label>
            <textarea name="Description" id="Description" class="w-full border border-gray-300 px-4 py-2 rounded-md"
                rows="4">{{ old('Description', $product->Description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="img_url" class="block text-gray-700 font-semibold">Image URL</label>
            <input type="url" name="img_url" id="img_url" value="{{ old('img_url', $product->img_url) }}"
                class="w-full border border-gray-300 px-4 py-2 rounded-md">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Update
            Product</button>
    </form>
</div>
@endsection