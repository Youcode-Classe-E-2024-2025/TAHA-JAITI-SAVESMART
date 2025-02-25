{{-- transactions.blade.php --}}
@extends('layouts.app')
@section('title', '7sebFlosk - Transactions')
@section('content')
    <!-- Main Content -->
    <div class="p-4 bg-gray-100">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Transactions</h1>
                <p class="text-gray-600">Manage your income and expenses</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('transaction.create') }}" class="px-4 py-2 rounded-full bg-green-500 text-white hover:bg-green-600 transition-colors">
                    New Transaction
                </a>
                <button
                    class="px-4 py-2 rounded-full border border-gray-300 text-gray-700 hover:bg-gray-200 transition-colors">
                    Export CSV
                </button>
            </div>
        </div>
        <form action="{{ route('dashboard.transactions') }}" method="GET">
            <div class="grid gap-4 mb-8 md:grid-cols-2">
                <div class="glass rounded-xl p-4">
                    <select name="category_id"
                            class="w-full bg-transparent border-gray-300 rounded-lg focus:border-green-500 focus:ring-green-500">
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
                            class="w-full bg-transparent border-gray-300 rounded-lg focus:border-green-500 focus:ring-green-500">
                        <option value="">All Types</option>
                        <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Apply Filters</button>
        </form>
        <!-- Transactions Table -->
        <div class="glass rounded-3xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Date</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Frequency</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @if ($transactions->isEmpty())
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">No transactions found.</td>
                    </tr>
                @else
                    @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">{{ $transaction->date_received }}</td>
                            <td class="p-4">{{ $transaction->category->name }}</td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">{{ ucfirst($transaction->frequency) }}</span>
                            </td>
                            <td class="p-4 {{ $transaction->type === 'income' ? 'text-green-600' : 'text-orange-500' }}">
                                {{ $transaction->type === 'income' ? "+ $transaction->amount" : "- $transaction->amount" }}
                            </td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="text-green-600 hover:text-green-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('transaction.destroy', $transaction) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-lg hover:bg-gray-200">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
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
                @endif
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4 p-4 glass rounded-xl">
            <div class="text-sm text-gray-500">
                {{ $transactions->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection

<style>
    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.125);
    }
</style>
