@extends('layouts.app')

@section('title', '7sebFlosk - Create Account')

@section('content')
    <div class="min-h-screen w-full flex items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-md relative">
            <!-- Card Container -->
            <div class="w-full bg-gray-900/50 backdrop-blur-sm border border-gray-800 rounded-xl p-6 sm:p-8">
                <!-- Subtle top gradient border -->
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-yellow-500 to-lime-500 rounded-t-xl"></div>

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-white mb-2">Create Account</h1>
                    <p class="text-gray-400 text-sm">Join us today and get started</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                        <p class="text-sm text-red-400 text-center">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Sign Up Form -->
                <form method="POST" action="{{ route('auth.signuppost') }}" class="space-y-6">
                    @csrf

                    <!-- Name Input -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-300">
                            Full Name
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                placeholder="John Doe"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>
                        @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                placeholder="name@example.com"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                        @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation Input -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- is_head Input -->
                    <div class="space-y-2">
                        <label for="is_head" class="block text-sm font-medium text-gray-300">
                            Family account?
                        </label>
                        <div class="relative flex items-center">
                            <input
                                type="checkbox"
                                id="is_head"
                                name="is_head"
                                class="h-5 w-5 rounded border-gray-700 bg-gray-900/50 text-yellow-500 focus:ring-yellow-500/20 focus:ring-offset-0"
                            >
                            <label for="is_head" class="ml-2 text-sm text-gray-400">
                                Create a family account that can have multiple members
                            </label>
                        </div>
                        @error('is_head')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sign Up Button -->
                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-yellow-500 to-lime-500 text-white rounded-lg font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-yellow-500/50"
                    >
                        Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center">
                    <p class="text-gray-400">
                        Already have an account?
                        <a href="{{ route('auth.login') }}" class="text-yellow-500 hover:text-yellow-400 font-medium ml-1 transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
