@extends('layouts.app')

@section('title', '7sebFlosk - Login to an existing account')

@section('content')
<!-- Main Container with responsive padding -->
<div class="relative flex items-center justify-center w-full min-h-screen px-4 py-8 sm:px-6">
    <!-- Login Form - Responsive width -->
    <div class="relative p-6 overflow-hidden shadow-md w-full max-w-md shadow-yellow-400/40 backdrop-blur-xl bg-white/5 rounded-2xl sm:p-8 md:p-10">
        <!-- Gradient top border with animation -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-lime-400 via-yellow-300 to-white bg-size-200 animate-gradient-x"></div>

        <!-- Subtle corner accent -->
        <div class="absolute top-0 right-0 w-16 h-16">
            <div class="absolute top-0 right-0 w-16 h-16 rotate-45 transform origin-top-right bg-gradient-to-br from-yellow-400/20 to-transparent"></div>
        </div>

        <!-- Form Header -->
        <div class="mb-8 text-center">
            <h1 class="mb-2 text-2xl font-bold sm:text-3xl bg-gradient-to-r from-lime-400 to-yellow-400 bg-clip-text text-transparent">Welcome Back</h1>
            <p class="text-gray-400 text-sm sm:text-base">Enter your credentials to continue</p>
        </div>

        <!-- Laravel Form -->
        <form method="POST" action="" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full pl-10 pr-4 py-3 text-white border rounded-xl bg-white/5 border-white/10 focus:ring-2 focus:ring-yellow-400/50 focus:border-transparent focus:outline-none transition-all duration-200"
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
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full pl-10 pr-4 py-3 text-white border rounded-xl bg-white/5 border-white/10 focus:ring-2 focus:ring-yellow-400/50 focus:border-transparent focus:outline-none transition-all duration-200"
                        placeholder="••••••••"
                        required
                    >
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Login Button -->
            <button type="submit" class="cursor-pointer relative w-full overflow-hidden group rounded-xl">
                <div class="absolute inset-0 transition-transform duration-300 bg-gradient-to-r from-lime-400 to-yellow-400 group-hover:scale-105"></div>
                <span class="relative block py-3 font-medium text-center text-black">
                    Login
                </span>
            </button>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-8 text-center">
            <p class="text-gray-400">
                Don't have an account?
                {{-- <a href="{{ route('register') }}" class="font-medium transition-colors text-lime-400 hover:text-yellow-400"> --}}
                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    .animate-gradient-x {
        animation: gradient-x 3s ease infinite;
    }
    .bg-size-200 {
        background-size: 200% 200%;
    }
    @keyframes gradient-x {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
</style>
@endsection
