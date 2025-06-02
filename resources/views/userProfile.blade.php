@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6">My Profile</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mb-8">
        @csrf

        <div class="flex items-center space-x-6 mb-6">
            <div class="shrink-0">
                @if($user->profile_image)
                <img class="h-24 w-24 object-cover rounded-full" src="{{ asset('storage/' . $user->profile_image) }}"
                    alt="Profile Image" />
                @else
                <div class="h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-3xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif
            </div>
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" name="profile_image" accept="image/*" class="block w-full text-sm text-gray-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded file:border-0
                  file:text-sm file:font-semibold
                  file:bg-indigo-50 file:text-indigo-700
                  hover:file:bg-indigo-100
                " />
            </label>
        </div>

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full border px-3 py-2 rounded" />
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                class="w-full border px-3 py-2 rounded" />
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block font-semibold mb-1">Phone</label>
            <input id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full border px-3 py-2 rounded" />
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block font-semibold mb-1">Address</label>
            <textarea id="address" name="address" rows="3"
                class="w-full border px-3 py-2 rounded">{{ old('address', $user->address) }}</textarea>
            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
            Update Profile
        </button>
    </form>

    <hr class="my-8" />

    <h2 class="text-2xl font-semibold mb-4">Change Password</h2>
    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf

        <div class="mb-4">
            <label for="current_password" class="block font-semibold mb-1">Current Password</label>
            <input id="current_password" name="current_password" type="password" required
                class="w-full border px-3 py-2 rounded" />
            @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">New Password</label>
            <input id="password" name="password" type="password" required class="w-full border px-3 py-2 rounded" />
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block font-semibold mb-1">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="w-full border px-3 py-2 rounded" />
        </div>

        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
            Change Password
        </button>
    </form>
</div>
@endsection