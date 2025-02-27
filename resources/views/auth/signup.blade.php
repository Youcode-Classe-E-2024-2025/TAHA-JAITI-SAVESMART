<!-- resources/views/auth/signup.blade.php -->
@extends('layouts.app')
@section('title', 'Sign Up')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm mx-auto mt-24">
    <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2>
    <form action="{{ route('auth.signup.post') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your name" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your email" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your password" required>
        </div>
        <div class="mb-6">
            <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <input type="password" id="confirm_password" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Confirm your password" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Sign Up
            </button>
        </div>
    </form>
</div>
@endsection
