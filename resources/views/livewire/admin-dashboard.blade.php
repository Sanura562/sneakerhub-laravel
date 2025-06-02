<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="flex flex-col w-64 h-screen bg-gray-100 text-black p-6 space-y-6">
        <h2 class="text-2xl font-extrabold mb-6">Admin Panel</h2>
        <nav class="flex flex-col space-y-3">
            <a href="#"
                class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-black font-medium">📊
                Dashboard</a>
            <a href="/addProducts"
                class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-black font-medium">➕ Add
                Product</a>
            <a href="/viewProducts"
                class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-black font-medium">📦 All
                Products</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-black-700 mb-3">Users</h2>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <ul>
                    @forelse($users as $user)
                    <li class="border-b border-gray-200 px-6 py-3 hover:bg-gray-50">{{ $user->name }} - <span
                            class="text-black-500">{{ $user->email }}</span></li>
                    @empty
                    <li class="px-6 py-4 text-gray-500">No users found.</li>
                    @endforelse
                </ul>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Orders</h2>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <ul>
                    @forelse($orders as $order)
                    <li class="border-b border-gray-200 px-6 py-3 hover:bg-gray-50">Order ID: {{ $order->id }} - Amount:
                        <span class="text-green-600 font-semibold">${{ $order->total }}</span>
                    </li>
                    @empty
                    <li class="px-6 py-4 text-gray-500">No orders yet.</li>
                    @endforelse
                </ul>
            </div>
        </section>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.confirm-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                const confirmed = confirm('Are you sure you want to delete this item?');
                if (!confirmed) {
                    e.preventDefault();
                }
            });
        });
    });
    </script>
</div>