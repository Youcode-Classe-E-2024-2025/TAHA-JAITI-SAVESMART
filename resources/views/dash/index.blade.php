@extends('layouts.dash')

@section('title', '7sebFlosk - Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
            <div class="h-full px-3 py-4 overflow-y-auto glass">
                <div class="mb-8 ml-3">
                    <h2 class="text-2xl font-bold tracking-tighter">
                        <span class="gradient-text">7seb</span>Flosk
                    </h2>
                </div>
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-lime-400/20 group">
                            <svg class="w-5 h-5 text-lime-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4V1m0 3h18M3 4v13m0-13h4.5m-4.5 13h18V8H3m4.5-4v4"/>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v12h12M4 9h12M9 4v12"/>
                            </svg>
                            <span class="ml-3">Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <span class="ml-3">Goals</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded-lg text-gray-400 hover:bg-lime-400/20 group">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3a6 6 0 0 1 6 6c0 3.314-2.686 6-6 6s-6-2.686-6-6 2.686-6 6-6Zm0 0v6m-3-3h6"/>
                            </svg>
                            <span class="ml-3">Family</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="p-4 sm:ml-64">
            <!-- Top Bar -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold">Welcome back, User!</h1>
                    <p class="text-gray-400">Here's your financial overview</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="px-4 py-2 rounded-full bg-lime-400 text-black hover:bg-yellow-400 transition-colors">
                        Add Transaction
                    </button>
                    <div class="w-10 h-10 rounded-full bg-gray-700"></div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-4 mb-8 md:grid-cols-4">
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-2 text-gray-400">Total Balance</h3>
                    <p class="text-3xl font-bold gradient-text">$24,563.00</p>
                    <span class="text-lime-400">+2.3% from last month</span>
                </div>
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-2 text-gray-400">Monthly Income</h3>
                    <p class="text-3xl font-bold gradient-text">$8,350.00</p>
                    <span class="text-lime-400">+5.1% from last month</span>
                </div>
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-2 text-gray-400">Monthly Expenses</h3>
                    <p class="text-3xl font-bold gradient-text">$4,423.00</p>
                    <span class="text-yellow-400">+12.5% from last month</span>
                </div>
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-2 text-gray-400">Savings Rate</h3>
                    <p class="text-3xl font-bold gradient-text">47%</p>
                    <span class="text-lime-400">On track to goal</span>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid gap-4 mb-8 md:grid-cols-2">
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold">Expense Breakdown</h3>
                    <div class="aspect-square">
                        <!-- Placeholder for Pie Chart -->
                        <div class="w-full h-full rounded-full bg-gradient-to-r from-lime-400/20 to-yellow-400/20"></div>
                    </div>
                </div>
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold">Monthly Overview</h3>
                    <div class="aspect-square">
                        <!-- Placeholder for Line Chart -->
                        <div class="w-full h-full bg-gradient-to-r from-lime-400/20 to-yellow-400/20 rounded-xl"></div>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions & Goals -->
            <div class="grid gap-4 mb-8 md:grid-cols-2">
                <!-- Recent Transactions -->
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold">Recent Transactions</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-800/50">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-lime-400/20">
                                    <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Grocery Shopping</p>
                                    <p class="text-sm text-gray-400">Today, 2:35 PM</p>
                                </div>
                            </div>
                            <p class="font-medium text-yellow-400">-$84.50</p>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-800/50">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-lime-400/20">
                                    <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Salary Deposit</p>
                                    <p class="text-sm text-gray-400">Yesterday</p>
                                </div>
                            </div>
                            <p class="font-medium text-lime-400">+$3,500.00</p>
                        </div>
                    </div>
                </div>

                <!-- Savings Goals -->
                <div class="p-6 glass rounded-3xl">
                    <h3 class="mb-4 text-xl font-bold">Savings Goals</h3>
                    <div class="space-y-4">
                        <div class="p-4 rounded-xl bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-medium">New Car</p>
                                <p class="text-sm text-gray-400">$15,000 / $30,000</p>
                            </div>
                            <div class="w-full h-2 rounded-full bg-gray-700">
                                <div class="w-1/2 h-full rounded-full bg-gradient-to-r from-lime-400 to-yellow-400"></div>
                            </div>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-medium">Vacation</p>
                                <p class="text-sm text-gray-400">$2,500 / $5,000</p>
                            </div>
                            <div class="w-full h-2 rounded-full bg-gray-700">
                                <div class="w-1/2 h-full rounded-full bg-gradient-to-r from-lime-400 to-yellow-400"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .glass {
            background: rgba(17, 25, 40, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        .gradient-text {
            background: linear-gradient(to right, #a3e635, #facc15);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection
