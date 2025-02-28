@extends('layouts.app')
@section('title', 'Transactions - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900">Transactions</h1>
                        <p class="mt-2 text-sm text-gray-600">View and manage all your income and expenses in one place.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-chart-line mr-2"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('transaction.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>
                            Add Transaction
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filters & Search Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                    <p class="mt-1 text-sm text-gray-500">Refine the transaction list to find what you're looking for.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaction.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Date Range -->
                        <div>
                            <label for="date_range" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                            <select id="date_range" name="date_range"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="all" {{ request('date_range') == 'all' ? 'selected' : '' }}>All Time</option>
                                <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                                <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                                <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                            </select>
                        </div>



                        <!-- Transaction Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select id="type" name="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Types</option>
                                <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Transaction name...">
                            </div>
                        </div>

                        <!-- Show Family Transactions (if applicable) -->
                        @if(auth()->user()->family_id)
                        <div>
                            <label for="view_mode" class="block text-sm font-medium text-gray-700 mb-1">View</label>
                            <select id="view_mode" name="view_mode"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="personal" {{ request('view_mode') == 'personal' ? 'selected' : '' }}>My Transactions</option>
                                <option value="family" {{ request('view_mode') == 'family' ? 'selected' : '' }}>Family Transactions</option>
                                <option value="all" {{ request('view_mode') == 'all' ? 'selected' : '' }}>All Transactions</option>
                            </select>
                        </div>
                        @endif

                        <!-- Filter Buttons -->
                        <div class="md:col-span-2 lg:col-span-4 flex items-center justify-end space-x-3 mt-2">
                            <a href="{{ route('transaction.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Clear Filters
                            </a>
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Transaction List Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Transactions</h3>
                        <p class="mt-1 text-sm text-gray-500">Showing {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} of {{ $transactions->total() ?? 0 }} transactions</p>
                    </div>
                    <div class="flex space-x-2">
                        {{-- <a href="{{ route('transaction.export', request()->query()) }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500"> --}}
                            <i class="fas fa-file-export mr-1"></i>
                            Export
                        </a>
                    </div>
                </div>

                <!-- Transactions Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $transaction->transaction_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $transaction->category->type == 'personal' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ $transaction->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm
                                        {{ $transaction->type == 'income' ? 'text-green-600 font-medium' : 'text-red-600 font-medium' }}">
                                        {{ $transaction->type == 'income' ? '+' : '-' }}
                                        {{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if(isset($viewMode) && $viewMode != 'personal')
                                            {{ $transaction->user()->name }}
                                            @if($transaction->family_id)
                                                <span class="ml-1 inline-flex items-center px-1.5 py-0.5 rounded-full text-xs bg-purple-100 text-purple-800">
                                                    <i class="fas fa-users text-xs mr-1"></i> Family
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-3">
                                            <a href="{{ route('transaction.edit', $transaction->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                                                <i class="fas fa-receipt text-blue-600 text-xl"></i>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 mb-1">No transactions found</h3>
                                            <p class="text-sm text-gray-500 mb-4">Start adding your financial transactions to track your spending.</p>
                                            <a href="{{ route('transaction.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                                <i class="fas fa-plus mr-2"></i>
                                                Add First Transaction
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $transactions->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
