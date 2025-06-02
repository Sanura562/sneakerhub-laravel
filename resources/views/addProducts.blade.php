@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">
        {{ isset($product) ? 'Edit Product' : 'Add New Product' }}
    </h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($product) ? route('products.update', $product->_id) : route('products.store') }}"
        method="POST">
        @csrf
        @if(isset($product))
        @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-gray-700">Product ID</label>
            <input type="text" name="ProductID" value="{{ old('ProductID', $product->ProductID ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="Name" value="{{ old('Name', $product->Name ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="Description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('Description', $product->Description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Price</label>
            <input type="number" step="0.01" name="Price" value="{{ old('Price', $product->Price ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stock Quantity</label>
            <input type="number" name="StockQuantity" value="{{ old('StockQuantity', $product->StockQuantity ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Brand</label>
            <input type="text" name="Brand" value="{{ old('Brand', $product->Brand ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Category</label>
            <input type="text" name="Category" value="{{ old('Category', $product->Category ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Discount Price</label>
            <input type="number" step="0.01" name="Discount_Price"
                value="{{ old('Discount_Price', $product->Discount_Price ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700">Image URL</label>
            <input type="url" name="img_url" value="{{ old('img_url', $product->img_url ?? '') }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ isset($product) ? 'Update Product' : 'Add Product' }}
            </button>
        </div>
    </form>
</div>
@endsection