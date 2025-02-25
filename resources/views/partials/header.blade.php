<!-- partials/header.blade.php -->
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="https://via.placeholder.com/40" alt="Logo" class="h-8 mr-3">
                <span class="text-2xl font-bold text-gray-900">7sebFlosk</span>
            </a>
        </div>
        <!-- Navigation -->
        <nav class="hidden md:flex space-x-4">
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Dashboard</a>
            <a href="{{ route('dashboard.transactions') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Transactions</a>
            <a href="{{ route('financial_goals.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">Financial Goals</a>
        </nav>
        <!-- User Menu -->
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button id="user-menu" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                <!-- Dropdown Menu -->
                <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">

                    <form action="{{ route('auth.logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('user-menu').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('user-dropdown');
        if (!event.target.closest('#user-menu')) {
            dropdown.classList.add('hidden');
        }
    });
</script>
