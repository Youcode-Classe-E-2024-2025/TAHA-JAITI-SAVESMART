@extends('layouts.app')
@section('title', '7sebFlosk - Edit Transaction')
@section('content')
    <div class="min-h-screen w-full flex items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 bg-white rounded-3xl shadow-2xl">
            <!-- Form Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Edit Transaction</h1>
                <p class="text-gray-600">Update your transaction details</p>
            </div>
            <!-- Edit Form -->
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <!-- Basic Information -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                            <input name="amount"
                                   type="number" step="0.01"
                                   class="w-full pl-8 pr-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                   value="{{ old('amount', $transaction->amount) }}" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Receive Date</label>
                        <input type="date"
                               name="date_received"
                               class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                               value="{{ old('date_received', $transaction->date_received) }}" required>
                    </div>
                </div>
                <!-- Source and Category -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Category</label>
                        <select
                            name="category_id"
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors" required>
                            @if (count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">No category has been created</option>
                            @endif
                        </select>
                    </div>
                </div>
                <!-- Recurring Options -->
                <div class="space-y-4">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Frequency</label>
                            <select
                                name="frequency"
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors" required>
                                <option value="monthly" {{ old('frequency', $transaction->frequency) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="weekly" {{ old('frequency', $transaction->frequency) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="daily" {{ old('frequency', $transaction->frequency) === 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="one-time" {{ old('frequency', $transaction->frequency) === 'one-time' ? 'selected' : '' }}>One-Time</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Type</label>
                            <select
                                name="type"
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors" required>
                                <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                            class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-lime-500 text-white rounded-lg font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-yellow-500/50">
                        Update Transaction
                    </button>
                    <a href="{{ route('transactions.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-100 hover:text-gray-900 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
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
