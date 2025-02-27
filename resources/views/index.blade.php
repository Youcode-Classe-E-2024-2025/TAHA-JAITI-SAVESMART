@extends('layouts.app')
@section('title', 'Dashboard - 7sebFlosk')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="mt-2 text-sm text-gray-600">Here's what's happening with your finances today.</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Income -->
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-down text-green-600 transform rotate-180"></i>
                    </div>
                    <span class="text-sm font-medium text-green-600 bg-green-50 px-2.5 py-0.5 rounded-full">+12.5%</span>
                </div>
                <h3 class="text-sm font-medium text-gray-500">Total Income</h3>
                <div class="mt-2 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">$1,500.00</p>
                    <p class="ml-2 text-sm text-gray-500">this month</p>
                </div>
                <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-green-600 w-3/4 rounded-full"></div>
                </div>
            </div>

            <!-- Total Expenses -->
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-down text-red-600"></i>
                    </div>
                    <span class="text-sm font-medium text-red-600 bg-red-50 px-2.5 py-0.5 rounded-full">-8.4%</span>
                </div>
                <h3 class="text-sm font-medium text-gray-500">Total Expenses</h3>
                <div class="mt-2 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">$1,000.00</p>
                    <p class="ml-2 text-sm text-gray-500">this month</p>
                </div>
                <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-red-500 to-red-600 w-1/2 rounded-full"></div>
                </div>
            </div>

            <!-- Available Balance -->
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-wallet text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-full">Available</span>
                </div>
                <h3 class="text-sm font-medium text-gray-500">Available Balance</h3>
                <div class="mt-2 flex items-baseline">
                    <p class="text-2xl font-semibold text-gray-900">$500.00</p>
                    <p class="ml-2 text-sm text-gray-500">to spend</p>
                </div>
                <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 w-1/4 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Spending Chart -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Spending Overview</h3>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200">Week</button>
                            <button class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">Month</button>
                            <button class="px-3 py-1 text-sm font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200">Year</button>
                        </div>
                    </div>
                    <!-- Placeholder Chart -->
                    <div class="relative h-[300px] w-full">
                        <div class="absolute inset-0 bg-gradient-to-b from-blue-50 to-transparent rounded-lg"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-[200px] bg-gradient-to-t from-blue-500/10 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 h-px bg-blue-500/20"></div>
                        <!-- Placeholder Chart Lines -->
                        <div class="absolute bottom-0 left-0 right-0 h-[180px] flex items-end justify-between px-4">
                            @for ($i = 0; $i < 12; $i++)
                                <div class="w-4 bg-gradient-to-t from-blue-600 to-blue-400 rounded-t-full"
                                     style="height: {{ rand(40, 160) }}px"></div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Actions & Goals -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-plus text-blue-600 text-xl mb-2"></i>
                            <p class="text-sm font-medium text-gray-600">Add Income</p>
                        </button>
                        <button class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-minus text-red-600 text-xl mb-2"></i>
                            <p class="text-sm font-medium text-gray-600">Add Expense</p>
                        </button>
                        <button class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-bullseye text-purple-600 text-xl mb-2"></i>
                            <p class="text-sm font-medium text-gray-600">Set Goal</p>
                        </button>
                        <button class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-file-invoice text-green-600 text-xl mb-2"></i>
                            <p class="text-sm font-medium text-gray-600">Reports</p>
                        </button>
                    </div>
                </div>

                <!-- Savings Goals -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Savings Goals</h3>
                    <div class="space-y-4">
                        <!-- Goal 1 -->
                        <div class="p-4 rounded-xl bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900">New Laptop</h4>
                                    <p class="text-sm text-gray-500">$300 of $1,200</p>
                                </div>
                                <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">25%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full w-1/4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Goal 2 -->
                        <div class="p-4 rounded-xl bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900">Europe Trip</h4>
                                    <p class="text-sm text-gray-500">$1,000 of $5,000</p>
                                </div>
                                <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">20%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full w-1/5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="mt-8">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
                        <button class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Oct 1, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-shopping-basket text-green-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Groceries</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-red-600">-$150.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-50 text-blue-600 rounded-full">Alimentation</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sep 30, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-home text-blue-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Rent</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-red-600">-$800.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="px-2 py-1 text-xs font-medium bg-purple-50 text-purple-600 rounded-full">Logement</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sep 29, 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-film text-yellow-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Movie Night</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-red-600">-$50.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="px-2 py-1 text-xs font-medium bg-pink-50 text-pink-600 rounded-full">Divertissement</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
