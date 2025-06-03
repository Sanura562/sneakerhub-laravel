<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-10 rounded-lg shadow-lg text-center w-full max-w-xl">
        <div class="flex flex-col items-center space-y-4">
            <div class="text-5xl text-indigo-600">
                <i class="fas fa-user-circle"></i>
            </div>
            <h2 class="text-2xl font-bold text-indigo-600">Welcome Back</h2>
        </div>

        <div class="mt-8 text-left">
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-semibold mb-1">Full Name</label>
                <p class="text-gray-900 font-medium text-lg">{{ $name }}</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-600 text-sm font-semibold mb-1">Email Address</label>
                <p class="text-gray-900 font-medium text-lg">{{ $email }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>