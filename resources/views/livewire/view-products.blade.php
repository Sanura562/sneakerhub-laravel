<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-6 space-y-4">
        <h2 class="text-2xl font-bold">Admin Panel</h2>
        <nav class="flex flex-col space-y-2">
            <a href="/admin-dashboard" class="flex items-center px-4 py-2 rounded hover:bg-gray-800 transition">📊
                Dashboard</a>
            <a href="/addProducts" class="flex items-center px-4 py-2 rounded hover:bg-gray-800 transition">➕ Add
                Product</a>
            <a href="/viewProducts" class="flex items-center px-4 py-2 rounded bg-gray-800">📦 View Products</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">All Products</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full">
                <thead class="bg-gray-100 text-left text-gray-700">
                    <tr>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Brand</th>
                        <th class="py-3 px-6">Price</th>
                        <th class="py-3 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $product->Name }}</td>
                        <td class="py-4 px-6">{{ $product->Brand }}</td>
                        <td class="py-4 px-6 font-medium text-green-600">${{ number_format($product->Price, 2) }}</td>
                        <td class="py-4 px-6 space-x-2">
                            <a href="{{ route('products.edit', $product->_id) }}" class="btn btn-blue">Update</a>
                            <form action="{{ route('products.destroy', $product->_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>