@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold mb-6">
        Welcome, {{ Auth::user()->name }} (Admin)
    </h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Total Users</h2>
            <p class="text-4xl text-indigo-600">{{ $usersCount ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Total Products</h2>
            <p class="text-4xl text-indigo-600">{{ $productsCount ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Total Orders</h2>
            <p class="text-4xl text-indigo-600">{{ $ordersCount ?? 0 }}</p>
        </div>
    </div>

    {{-- Latest Products Table --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Latest Products</h2>

        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Brand</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestProducts as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->Name }}</td>
                    <td class="border border-gray-300 px-4 py-2">${{ number_format($product->Price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->Brand }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->Category }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('products.edit', $product->_id) }}"
                            class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product->_id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection