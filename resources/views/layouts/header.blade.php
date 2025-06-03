<nav class="bg-white shadow-md fixed top-0 inset-x-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="font-semibold text-lg text-gray-800">SneakerHub</a>
            </div>

            <!-- Nav Links (centered) -->
            <div class="hidden md:flex flex-1 justify-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="/store" class="text-gray-700 hover:text-blue-600">All Shoes</a>
                <a href="/cart" class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                    <img src="https://static.vecteezy.com/system/resources/previews/004/999/463/non_2x/shopping-cart-icon-illustration-free-vector.jpg"
                        alt="Cart" class="h-5 w-5 mr-1">
                </a>
            </div>

            <!-- Right Buttons -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}"
                    class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="/user-profile"
                    class="bg-gray-800 text-white font-semibold px-4 py-2 rounded-md hover:bg-gray-900 transition">
                    Profile
                </a>
            </div>
        </div>
    </div>
</nav>