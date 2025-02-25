@extends('layouts.app')
@section('title', '7sebFlosk - Family Creation')
@section('content')
    <div class="min-h-screen w-full flex items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-md relative">
            <!-- Card Container -->
            <div class="w-full bg-white rounded-3xl shadow-2xl p-6 sm:p-8">
                <!-- Subtle top gradient border -->
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-yellow-500 to-lime-500 rounded-t-xl"></div>
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Create a Family Account</h1>
                    <p class="text-gray-600 text-sm">Enter your family name</p>
                </div>
                @if (session('status'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                        <p class="text-sm text-red-400 text-center">{{ session('status') }}</p>
                    </div>
                @endif
                <!-- Family Form -->
                <form method="POST" action="{{ route('family.store') }}" class="space-y-6">
                    @csrf
                    <!-- Name Input -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Family Name
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                placeholder="Enter family name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>
                        @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-yellow-500 to-lime-500 text-white rounded-lg font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-yellow-500/50"
                    >
                        Create Family
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.125);
    }
</style>
