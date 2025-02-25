@extends('layouts.app')
@section('title', '7sebFlosk - Dashboard')
@section('content')
    <!-- Main Content -->
    <div class="p-4 bg-gray-100">
        <!-- Stats Cards -->
        <div class="grid gap-4 mb-8 md:grid-cols-4">
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-2 text-gray-600">Total Balance</h3>
                <p class="text-3xl font-bold gradient-text">$24,563.00</p>
                <span class="text-green-500">+2.3% from last month</span>
            </div>
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-2 text-gray-600">Monthly Income</h3>
                <p class="text-3xl font-bold gradient-text">$8,350.00</p>
                <span class="text-green-500">+5.1% from last month</span>
            </div>
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-2 text-gray-600">Monthly Expenses</h3>
                <p class="text-3xl font-bold gradient-text">$4,423.00</p>
                <span class="text-orange-500">+12.5% from last month</span>
            </div>
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-2 text-gray-600">Savings Rate</h3>
                <p class="text-3xl font-bold gradient-text">47%</p>
                <span class="text-green-500">On track to goal</span>
            </div>
        </div>
        <!-- Charts Section -->
        <div class="grid gap-4 mb-8 md:grid-cols-2">
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-4 text-xl font-bold">Expense Breakdown</h3>
                <div class="aspect-square">
                    <!-- Placeholder for Pie Chart -->
                    <div class="w-full h-full rounded-full bg-gradient-to-r from-green-100 to-green-300"></div>
                </div>
            </div>
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-4 text-xl font-bold">Monthly Overview</h3>
                <div class="aspect-square">
                    <!-- Placeholder for Line Chart -->
                    <div class="w-full h-full bg-gradient-to-r from-green-100 to-green-300 rounded-xl"></div>
                </div>
            </div>
        </div>
        <!-- Recent Transactions & Goals -->
        <div class="grid gap-4 mb-8 md:grid-cols-2">
            <!-- Recent Transactions -->
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-4 text-xl font-bold">Recent Transactions</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/10">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-green-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Grocery Shopping</p>
                                <p class="text-sm text-gray-400">Today, 2:35 PM</p>
                            </div>
                        </div>
                        <p class="font-medium text-red-500">-$84.50</p>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/10">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-green-100">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Salary Deposit</p>
                                <p class="text-sm text-gray-400">Yesterday</p>
                            </div>
                        </div>
                        <p class="font-medium text-green-500">+$3,500.00</p>
                    </div>
                </div>
            </div>
            <!-- Savings Goals -->
            <div class="p-6 glass rounded-3xl">
                <h3 class="mb-4 text-xl font-bold">Savings Goals</h3>
                <div class="space-y-4">
                    <div class="p-4 rounded-xl bg-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-medium">New Car</p>
                            <p class="text-sm text-gray-400">$15,000 / $30,000</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-gray-200">
                            <div class="w-1/2 h-full rounded-full bg-gradient-to-r from-green-100 to-green-300"></div>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl bg-white/10">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-medium">Vacation</p>
                            <p class="text-sm text-gray-400">$2,500 / $5,000</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-gray-200">
                            <div class="w-1/2 h-full rounded-full bg-gradient-to-r from-green-100 to-green-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }
        .gradient-text {
            background: linear-gradient(to right, #4ade80, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection
