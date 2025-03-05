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
                        <span class="text-sm font-medium text-green-600 bg-green-50 px-2.5 py-0.5 rounded-full">
                            +{{ number_format(($totalIncome / max(1, $totalExpenses)) * 100, 1) }}%
                        </span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Total Income</h3>
                    <div class="mt-2 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalIncome, 2) }}</p>
                        <p class="ml-2 text-sm text-gray-500">this month</p>
                    </div>
                    <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-green-500 to-green-600"
                            style="width: {{ min(100, ($totalIncome / max(1, $totalIncome + $totalExpenses)) * 100) }}%">
                        </div>
                    </div>
                </div>

                <!-- Total Expenses -->
                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-arrow-down text-red-600"></i>
                        </div>
                        <span class="text-sm font-medium text-red-600 bg-red-50 px-2.5 py-0.5 rounded-full">-
                            {{ number_format(($totalExpenses / max(1, $totalIncome)) * 100, 1) }}%</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Total Expenses</h3>
                    <div class="mt-2 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalExpenses, 2) }}</p>
                        <p class="ml-2 text-sm text-gray-500">this month</p>
                    </div>
                    <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-red-500 to-red-600"
                            style="width: {{ min(100, ($totalExpenses / max(1, $totalIncome + $totalExpenses)) * 100) }}%">
                        </div>
                    </div>
                </div>

                <!-- Available Balance -->
                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-wallet text-blue-600"></i>
                        </div>
                        <span
                            class="text-sm font-medium text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-full">Available</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500">Available Balance</h3>
                    <div class="mt-2 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $availableBalance > 0 ? number_format($availableBalance, 2) : 0 }}$</p>
                        <p class="ml-2 text-sm text-gray-500">to spend</p>
                    </div>
                    <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600"
                            style="width: {{ min(100, ($availableBalance / max(1, $totalIncome)) * 100) }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Spending Chart -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Spending Overview</h3>
                        <canvas id="spendingChart" class="w-full h-[300px]"></canvas>
                    </div>
                </div>

                <!-- Right Column - Quick Actions & Goals -->
                <div class="space-y-8">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a  href="{{ route('transaction.create') }}"
                                class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-plus text-blue-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-600">Add Income</p>
                            </a>
                            <a href="{{ route('transaction.create') }}"
                                class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-minus text-red-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-600">Add Expense</p>
                            </a>
                            <a href="{{ route('goal.index') }}"
                                class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-bullseye text-purple-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-600">Set Goal</p>
                            </a>
                            <a href="{{ route('transaction.index') }}"
                                class="p-4 text-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-file-invoice text-green-600 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-600">Reports</p>
                            </a>
                        </div>
                    </div>

                    <!-- Savings Goals -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Savings Goals</h3>
                        <div class="space-y-4">
                            @forelse($savingsGoals as $goal)
                            <div class="p-4 rounded-xl bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $goal->name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            ${{ number_format($goal->current_amount, 2) }} of ${{ number_format($goal->target, 2) }}
                                        </p>
                                    </div>
                                    <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                                        {{ number_format(($goal->current_amount / $goal->target) * 100, 1) }}%
                                    </span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600"
                                         style="width: {{ number_format(($goal->current_amount / $goal->target) * 100, 1) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No savings goals yet.</p>
                        @endforelse
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
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentTransactions as $transaction)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $transaction->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-{{ $transaction->type == 'income' ? 'green' : 'red' }}-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-{{ $transaction->type == 'income' ? 'arrow-up text-green-600 transform rotate-180' : 'arrow-down text-red-600' }}"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $transaction->description }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type == 'expense' ? '-' : '' }}${{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-50 text-blue-600 rounded-full">
                                            {{ $transaction->category->name }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No recent transactions</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
