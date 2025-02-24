@extends('layouts.app')

@section('title', '7sebFlosk - Home Page')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen px-6 pt-32 pb-20 overflow-hidden">
        <!-- Background Shapes -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute rounded-full top-1/4 left-1/4 w-72 h-72 bg-lime-400 mix-blend-multiply filter blur-xl opacity-30"></div>
            <div class="absolute bg-yellow-400 rounded-full top-1/3 right-1/4 w-96 h-96 mix-blend-multiply filter blur-xl opacity-30"></div>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="space-y-8 lg:pr-12">
                    <h1 class="text-6xl font-bold leading-tight tracking-tighter md:text-8xl">
                        <span class="gradient-text">Finance</span><br/>
                        Reimagined.
                    </h1>
                    <p class="max-w-lg text-xl tracking-wide text-gray-400">
                        Break free from traditional money management. Experience the future of personal finance with 7sebFlosk.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#start" class="relative px-8 py-4 overflow-hidden text-black rounded-full group bg-lime-400">
                            <span class="relative z-10 font-medium tracking-wider">Start Your Journey</span>
                            <div class="absolute inset-0 transition-transform transform translate-y-full bg-yellow-400 group-hover:translate-y-0"></div>
                        </a>
                        <a href="#demo" class="relative px-8 py-4 overflow-hidden border rounded-full group border-white/20">
                            <span class="relative z-10 font-medium tracking-wider">Watch Demo</span>
                            <div class="absolute inset-0 transition-transform transform translate-y-full bg-white/10 group-hover:translate-y-0"></div>
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative z-10 transition-transform duration-500 transform hover:scale-105">
                        <img src="/storage/hero.webp" alt="7sebFlosk Interface" class="rounded-full shadow-2xl opacity-75 blur-sm">
                        <!-- Decorative Elements -->
                        <div class="absolute w-64 h-64 bg-yellow-400 rounded-full -top-8 -right-8 mix-blend-multiply filter blur-lg opacity-70"></div>
                        <div class="absolute w-64 h-64 rounded-full -bottom-8 -left-8 bg-lime-400 mix-blend-multiply filter blur-lg opacity-70"></div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 gap-8 mt-32 md:grid-cols-4">
                <div class="appear">
                    <div class="text-4xl font-bold gradient-text">98%</div>
                    <div class="mt-2 text-gray-400">User Satisfaction</div>
                </div>
                <div class="appear">
                    <div class="text-4xl font-bold gradient-text">50K+</div>
                    <div class="mt-2 text-gray-400">Active Users</div>
                </div>
                <div class="appear">
                    <div class="text-4xl font-bold gradient-text">$2M+</div>
                    <div class="mt-2 text-gray-400">Money Managed</div>
                </div>
                <div class="appear">
                    <div class="text-4xl font-bold gradient-text">4.9</div>
                    <div class="mt-2 text-gray-400">App Store Rating</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="relative py-32 diagonal-box bg-lime-400">
        <div class="px-6 mx-auto max-w-7xl diagonal-content">
            <div class="mb-20 text-black">
                <h2 class="mb-8 text-5xl font-bold tracking-tighter md:text-7xl">Features that<br/>Break the Mold</h2>
                <p class="max-w-2xl text-xl">Discover tools that transform how you think about money management.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Feature Cards -->
                <div class="p-8 text-black transition-transform transform glass rounded-3xl hover:-translate-y-2 appear">
                    <div class="flex items-center justify-center w-16 h-16 mb-6 bg-black rounded-2xl">
                        <svg class="w-8 h-8 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold">Smart Tracking</h3>
                    <p class="text-black/70">AI-powered expense tracking that learns and adapts to your spending habits.</p>
                </div>

                <div class="p-8 text-black transition-transform transform glass rounded-3xl hover:-translate-y-2 appear">
                    <div class="flex items-center justify-center w-16 h-16 mb-6 bg-black rounded-2xl">
                        <svg class="w-8 h-8 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold">Visual Insights</h3>
                    <p class="text-black/70">Beautiful, interactive charts that make understanding your finances a breeze.</p>
                </div>

                <div class="p-8 text-black transition-transform transform glass rounded-3xl hover:-translate-y-2 appear">
                    <div class="flex items-center justify-center w-16 h-16 mb-6 bg-black rounded-2xl">
                        <svg class="w-8 h-8 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold">Quick Actions</h3>
                    <p class="text-black/70">Lightning-fast transactions and updates with our intuitive interface.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="relative px-6 py-32 overflow-hidden">
        <div class="mx-auto max-w-7xl">
            <h2 class="mb-20 text-5xl font-bold tracking-tighter md:text-7xl">The Process<br/>is Simple.</h2>

            <div class="grid gap-12 md:grid-cols-3">
                <div class="appear">
                    <div class="mb-6 font-bold text-8xl text-lime-400">01</div>
                    <h3 class="mb-4 text-2xl font-bold">Connect Your Accounts</h3>
                    <p class="text-gray-400">Securely link your bank accounts and cards in just a few taps.</p>
                </div>
                <div class="appear">
                    <div class="mb-6 font-bold text-8xl text-lime-400">02</div>
                    <h3 class="mb-4 text-2xl font-bold">Set Your Goals</h3>
                    <p class="text-gray-400">Define your financial goals and let us help you achieve them.</p>
                </div>
                <div class="appear">
                    <div class="mb-6 font-bold text-8xl text-lime-400">03</div>
                    <h3 class="mb-4 text-2xl font-bold">Watch Your Growth</h3>
                    <p class="text-gray-400">Track your progress and celebrate your financial wins.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative px-6 py-32 overflow-hidden">
        <div class="relative mx-auto max-w-7xl">
            <div class="absolute inset-0 bg-gradient-to-r from-lime-400/20 to-yellow-400/20 rounded-3xl"></div>
            <div class="relative p-12 glass rounded-3xl md:p-20">
                <div class="max-w-2xl">
                    <h2 class="mb-8 text-4xl font-bold tracking-tighter md:text-6xl">Ready to Transform Your Finances?</h2>
                    <p class="mb-12 text-xl text-gray-400">Join thousands of users who are already experiencing the future of money management.</p>
                    <a href="#start" class="inline-block px-12 py-4 font-medium tracking-wider text-black transition-colors rounded-full bg-lime-400 hover:bg-yellow-400">
                        Get Started Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
