<!-- resources/views/partials/header.blade.php -->
<header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-gray-800">7sebFlosk</h1>
        </div>
        <nav class="hidden md:flex space-x-6">
            <a href="#dashboard" class="text-gray-600 hover:text-gray-800">Dashboard</a>
            <a href="#transactions" class="text-gray-600 hover:text-gray-800">Transactions</a>
            <a href="#goals" class="text-gray-600 hover:text-gray-800">Goals</a>
            <a href="{{ route('family.index') }}" class="text-gray-600 hover:text-gray-800">Family</a>
        </nav>

        @if (Auth::user())
            <a href="{{ route('auth.logout') }}"
                class="inline-block bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300">Logout</a>
        @else
            <div class="space-x-4">
                <a href="{{ route('auth.login') }}"
                    class="inline-block bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300">Login</a>
                <a href="{{ route('auth.signup') }}"
                    class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Signup</a>
            </div>
        @endif
    </div>
</header>
