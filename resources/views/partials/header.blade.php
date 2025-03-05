<header class="bg-white border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-lg"></i>
                    </div>
                    <span
                        class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">
                        7sebFlosk
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('transaction.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('transactions') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <i class="fas fa-exchange-alt mr-2"></i>
                        Transactions
                    </a>
                    <a href="{{ route('goal.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('goals') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <i class="fas fa-bullseye mr-2"></i>
                        Goals
                    </a>
                    <a href="{{ route('category.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('goals') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <i class="fas fa-tag mr-2"></i>
                        Categories
                    </a>
                    <a href="{{ route('family.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('family.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <i class="fas fa-users mr-2"></i>
                        Family
                    </a>
                @endauth
            </nav>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-blue-600">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                            <span class="hidden md:block text-sm font-medium text-gray-700">
                                {{ Auth::user()->name }}
                            </span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded-xl bg-white py-2 shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('auth.logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt w-5 mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('auth.login') }}"
                            class="text-sm font-medium text-gray-700 hover:text-gray-900 px-4 py-2 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            Log in
                        </a>
                        <a href="{{ route('auth.signup') }}"
                            class="text-sm font-medium bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow">
                            Sign up
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button type="button"
                    class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none"
                    @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
                    <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                    <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" class="lg:hidden" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1">
        <nav class="px-4 py-2 space-y-1 bg-gray-50 border-t border-gray-100">
            @auth
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <i class="fas fa-chart-pie w-5 mr-2"></i>
                    Dashboard
                </a>
                <a href=""
                    class="flex items-center px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('transactions') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <i class="fas fa-exchange-alt w-5 mr-2"></i>
                    Transactions
                </a>
                <a href=""
                    class="flex items-center px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('goals') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <i class="fas fa-bullseye w-5 mr-2"></i>
                    Goals
                </a>
                <a href="{{ route('family.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('family.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    <i class="fas fa-users w-5 mr-2"></i>
                    Family
                </a>
            @endauth
        </nav>
    </div>
</header>

<div class="h-16"></div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('header', () => ({
            mobileMenuOpen: false
        }))
    })
</script>
