@extends('layouts.app')

@section('title', 'Welcome to 7sebFlosk - Smart Finance Management')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-b from-blue-50 to-white">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%234338ca\" fill-opacity=\"0.2\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="pt-20 pb-16 text-center lg:pt-32">
            <h1 class="mx-auto max-w-4xl font-display text-5xl font-bold tracking-tight text-gray-900 sm:text-7xl">
                <span class="relative whitespace-nowrap">
                    <span class="relative bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">7sebFlosk</span>
                </span>
                <span class="block text-4xl sm:text-6xl mt-3">Smart Finance Management</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">
                Take control of your finances with our intelligent tracking and management system. Simple, secure, and smart.
            </p>
            <div class="mt-10 flex justify-center gap-x-6">
                <a href="{{ route('auth.signup') }}" class="group inline-flex items-center justify-center rounded-full py-3 px-6 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:bg-blue-700 hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <span>Get Started For Free</span>
                    <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#how-it-works" class="group inline-flex items-center justify-center rounded-full py-3 px-6 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-blue-600 border-2 border-blue-100 hover:border-blue-200 hover:bg-blue-50 transition-all duration-200">
                    <span>How It Works</span>
                    <i class="fas fa-play ml-3 group-hover:scale-110 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute top-1/2 left-1/4 transform -translate-y-1/2 -translate-x-1/2">
        <div class="w-20 h-20 bg-blue-500/10 rounded-full blur-2xl"></div>
    </div>
    <div class="absolute bottom-1/4 right-1/4 transform translate-y-1/2 translate-x-1/2">
        <div class="w-32 h-32 bg-green-500/10 rounded-full blur-2xl"></div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            <div class="flex flex-col items-center">
                <div class="text-4xl font-bold text-blue-600">
                    <i class="fas fa-users mb-4"></i>
                    <span class="ml-2">50K+</span>
                </div>
                <p class="text-gray-600">Active Users</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-4xl font-bold text-blue-600">
                    <i class="fas fa-chart-line mb-4"></i>
                    <span class="ml-2">₹10M+</span>
                </div>
                <p class="text-gray-600">Managed Money</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-4xl font-bold text-blue-600">
                    <i class="fas fa-shield-alt mb-4"></i>
                    <span class="ml-2">99.9%</span>
                </div>
                <p class="text-gray-600">Secure</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-4xl font-bold text-blue-600">
                    <i class="fas fa-star mb-4"></i>
                    <span class="ml-2">4.9</span>
                </div>
                <p class="text-gray-600">User Rating</p>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-gradient-to-b from-white to-blue-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Everything you need to manage your finances</h2>
            <p class="mt-4 text-lg text-gray-600">Powerful features to help you track, manage, and grow your money.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-chart-pie text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Smart Budgeting</h3>
                <p class="text-gray-600">Automatically categorize your expenses and create intelligent budgets based on your spending patterns.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-piggy-bank text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Savings Goals</h3>
                <p class="text-gray-600">Set and track your savings goals with visual progress indicators and smart recommendations.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-bell text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Smart Alerts</h3>
                <p class="text-gray-600">Get intelligent notifications about unusual spending, upcoming bills, and investment opportunities.</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-receipt text-2xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Bill Tracking</h3>
                <p class="text-gray-600">Never miss a payment with automated bill tracking and payment reminders.</p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-chart-bar text-2xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Financial Reports</h3>
                <p class="text-gray-600">Generate detailed reports and insights about your spending habits and financial health.</p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-mobile-alt text-2xl text-teal-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Mobile Ready</h3>
                <p class="text-gray-600">Access your finances anytime, anywhere with our powerful mobile application.</p>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div id="how-it-works" class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">How It Works</h2>
            <p class="mt-4 text-lg text-gray-600">Get started with 7sebFlosk in three simple steps</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Step 1 -->
            <div class="relative">
                <div class="absolute -left-4 -top-4 w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">1</div>
                <div class="bg-gray-50 rounded-2xl p-8 pt-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Create Account</h3>
                    <p class="text-gray-600">Sign up for free and connect your bank accounts securely.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="absolute -left-4 -top-4 w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">2</div>
                <div class="bg-gray-50 rounded-2xl p-8 pt-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Set Goals</h3>
                    <p class="text-gray-600">Define your financial goals and create personalized budgets.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="absolute -left-4 -top-4 w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">3</div>
                <div class="bg-gray-50 rounded-2xl p-8 pt-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Track & Grow</h3>
                    <p class="text-gray-600">Monitor your progress and watch your savings grow automatically.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Section -->
<div class="bg-gradient-to-b from-blue-50 to-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Simple, Transparent Pricing</h2>
            <p class="mt-4 text-lg text-gray-600">Choose the plan that works best for you</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900">Basic</h3>
                    <div class="mt-4 text-6xl font-bold text-blue-600">Free</div>
                    <p class="mt-2 text-gray-600">Perfect for getting started</p>
                </div>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Basic expense tracking</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Up to 2 savings goals</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Monthly reports</span>
                    </li>
                </ul>
                <a href="{{ route('auth.signup') }}" class="mt-8 block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">Get Started</a>
            </div>

            <!-- Pro Plan -->
            <div class="bg-blue-600 rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 transform scale-105">
                <div class="absolute top-4 right-4">
                    <span class="bg-yellow-400 text-blue-900 text-xs font-bold px-3 py-1 rounded-full">POPULAR</span>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-white">Pro</h3>
                    <div class="mt-4 text-6xl font-bold text-white">₹499<span class="text-lg">/mo</span></div>
                    <p class="mt-2 text-blue-100">For serious money managers</p>
                </div>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Everything in Basic</span>
                    </li>
                    <li class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Unlimited savings goals</span>
                    </li>
                    <li class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Advanced analytics</span>
                    </li>
                    <li class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Priority support</span>
                    </li>
                </ul>
                <a href="{{ route('auth.signup') }}?plan=pro" class="mt-8 block w-full bg-white text-blue-600 text-center py-3 rounded-lg hover:bg-blue-50 transition-colors duration-200">Get Started</a>
            </div>

            <!-- Enterprise Plan -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900">Enterprise</h3>
                    <div class="mt-4 text-6xl font-bold text-blue-600">Custom</div>
                    <p class="mt-2 text-gray-600">For large organizations</p>
                </div>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Everything in Pro</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Custom integration</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-600">Dedicated support</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="text-center lg:text-left mb-8 lg:mb-0">
                <h2 class="text-3xl font-bold text-white mb-2">Ready to take control of your finances?</h2>
                <p class="text-blue-100">Join thousands of users who trust 7sebFlosk for their financial management.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('auth.signup') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 transition-colors duration-200">
                    Get Started
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
