@extends('layouts.app')
@section('title', 'Create Your Account - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6 lg:px-8 flex items-center">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%234338ca\" fill-opacity=\"0.2\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
            </div>
        </div>

        <div class="w-full max-w-md mx-auto relative">
            <!-- Logo -->
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-blue-600 mb-2">7sebFlosk</h2>
                <p class="text-gray-600">Create your account and start managing your finances</p>
            </div>

            <!-- Signup Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <!-- Signup Form -->
                <form action="{{ route('auth.signup.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name"
                                class="block w-full pl-10 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror"
                                placeholder="John Doe" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email"
                                class="block w-full pl-10 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                                placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password" name="password"
                                class="block w-full pl-10 pr-10 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="••••••••" required x-on:input="checkPasswordStrength($el.value)">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                x-on:click="show = !show">
                                <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"
                                    class="text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="mt-2 flex gap-2">
                            <div class="h-1 flex-1 rounded-full bg-gray-200">
                                <div class="h-full rounded-full bg-red-500 transition-all duration-300" id="strength-1">
                                </div>
                            </div>
                            <div class="h-1 flex-1 rounded-full bg-gray-200">
                                <div class="h-full rounded-full bg-yellow-500 transition-all duration-300" id="strength-2">
                                </div>
                            </div>
                            <div class="h-1 flex-1 rounded-full bg-gray-200">
                                <div class="h-full rounded-full bg-green-500 transition-all duration-300" id="strength-3">
                                </div>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500" id="password-strength-text">Password strength: Make it strong!
                        </p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                            Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input :type="show ? 'text' : 'password'" id="password_confirmation"
                                name="password_confirmation"
                                class="block w-full pl-10 pr-10 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                x-on:click="show = !show">
                                <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"
                                    class="text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>



                    <!-- Signup Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- Login Link -->
            <p class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="{{ route('auth.login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strength1 = document.getElementById('strength-1');
            const strength2 = document.getElementById('strength-2');
            const strength3 = document.getElementById('strength-3');
            const strengthText = document.getElementById('password-strength-text');

            // Reset all strengths
            strength1.style.width = '0%';
            strength2.style.width = '0%';
            strength3.style.width = '0%';

            if (password.length === 0) {
                strengthText.textContent = 'Password strength: Make it strong!';
                return;
            }

            let score = 0;

            if (password.length >= 8) score++;
            if (password.length >= 12) score++;

            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            if (score >= 2) strength1.style.width = '100%';
            if (score >= 4) strength2.style.width = '100%';
            if (score >= 6) strength3.style.width = '100%';

            if (score < 2) strengthText.textContent = 'Password strength: Weak';
            else if (score < 4) strengthText.textContent = 'Password strength: Medium';
            else if (score < 6) strengthText.textContent = 'Password strength: Strong';
            else strengthText.textContent = 'Password strength: Very Strong';
        }
    </script>
@endsection
