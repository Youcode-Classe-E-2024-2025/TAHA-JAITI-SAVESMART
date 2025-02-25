{{-- transactions.blade.php --}}
@extends('layouts.dash')

@section('title', '7sebFlosk - Transactions')

@section('content')
    <!-- Main Content -->
    <div class="p-4 sm:ml-64 bg-gray-900">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Transactions</h1>
                <p class="text-gray-400">Manage your income and expenses</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="px-4 py-2 rounded-full bg-lime-400 text-black hover:bg-yellow-400 transition-colors">
                    New Transaction
                </button>
                <button
                    class="px-4 py-2 rounded-full border border-gray-700 text-gray-400 hover:bg-gray-800 transition-colors">
                    Export CSV
                </button>
            </div>
        </div>

        <form action="{{ route('dashboard.transactions') }}" method="GET">
            <div class="grid gap-4 mb-8 md:grid-cols-4">
                <div class="glass rounded-xl p-4">
                    <select name="category_id"
                            class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category_id') === $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="glass rounded-xl p-4">
                    <select name="type"
                            class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                        <option value="">All Types</option>
                        <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>
                <div class="glass rounded-xl p-4">
                    <input type="date" name="date" value="{{ request('date') }}"
                           class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                </div>
            </div>
            <button type="submit" class="bg-lime-400 text-white px-4 py-2 rounded-lg">Apply Filters</button>
        </form>

        <!-- Transactions Table -->
        <div class="glass rounded-3xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-800/50">
                <tr>
                    <th class="p-4">Date</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Frequency</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                @if (count($transactions) > 0)
                    @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-800/30">
                            <td class="p-4">{{ $transaction->created_at }}</td>
                            <td class="p-4">{{ $transaction->category->name }}</td>
                            <td class="p-4">
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-lime-400/20 text-lime-400">{{ ucfirst($transaction->frequency) }}</span>
                            </td>
                            <td class="p-4 {{ $transaction->type === 'income' ? 'text-lime-400' : 'text-yellow-400' }}">
                                {{ $transaction->type === 'income' ? "+ $transaction->amount" : "- $transaction->amount" }}
                            </td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('trans.edit', $transaction) }}" class="text-lime-400 hover:text-yellow-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('trans.destroy', $transaction) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-lg hover:bg-gray-700">
                                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h1>Nothing</h1>
                @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4 p-4 glass rounded-xl">
            <div class="text-sm text-gray-400">
                Showing 1 to 10 of 50 entries
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">Previous</button>
                <button class="px-4 py-2 rounded-lg bg-lime-400 text-black hover:bg-yellow-400">1</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">2</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">3</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">Next</button>
            </div>
        </div>
    </div>
@endsection
