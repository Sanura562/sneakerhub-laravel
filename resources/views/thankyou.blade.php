    @extends('layouts.app')

    @section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg text-center">
            <h2 class="text-3xl font-bold text-green-600 mb-4">Thank You!</h2>
            <p class="text-gray-700 mb-6">Your order has been placed successfully. We will contact you soon with
                shipping details.</p>
            <a href="{{ route('store') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Continue Shopping
            </a>
        </div>
    </div>
    @endsection