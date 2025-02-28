@extends('layouts.app')
@section('title', 'Edit Transaction - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900">Edit Transaction</h1>
                        <p class="mt-2 text-sm text-gray-600">Modify your transaction details.</p>
                    </div>
                    <div>
                        <a href="{{ route('transaction.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Transactions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Transaction Form Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Transaction Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Update the details of your transaction.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaction.update', $transaction) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Transaction Type -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Type</label>
                                <div class="flex space-x-4">
                                    <label
                                        class="relative flex items-center p-4 rounded-lg border cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-500 @error('type') border-red-300 @else border-gray-200 @enderror flex-1">
                                        <input type="radio" name="type" value="income" class="sr-only"
                                            {{ old('type') == 'income' ? 'checked' : '' }} required>
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                                <i class="fas fa-arrow-up text-green-600"></i>
                                            </div>
                                            <div>
                                                <span class="block text-sm font-medium text-gray-900">Income</span>
                                                <span class="block text-xs text-gray-500">Money you receive</span>
                                            </div>
                                        </div>
                                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none"
                                            aria-hidden="true"></div>
                                    </label>

                                    <label
                                        class="relative flex items-center p-4 rounded-lg border cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-500 @error('type') border-red-300 @else border-gray-200 @enderror flex-1">
                                        <input type="radio" name="type" value="expense" class="sr-only"
                                            {{ old('type') == 'expense' ? 'checked' : '' }} required>
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                                                <i class="fas fa-arrow-down text-red-600"></i>
                                            </div>
                                            <div>
                                                <span class="block text-sm font-medium text-gray-900">Expense</span>
                                                <span class="block text-xs text-gray-500">Money you spend</span>
                                            </div>
                                        </div>
                                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none"
                                            aria-hidden="true"></div>
                                    </label>
                                </div>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Transaction Name and Amount -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Transaction
                                    Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $transaction->name) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" id="amount" name="amount"
                                        value="{{ old('amount', $transaction->amount) }}" step="0.01" required
                                        class="w-full pl-7 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                @error('amount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date and Category -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="transaction_date"
                                    class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="date" id="transaction_date" name="transaction_date"
                                    value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                @error('transaction_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select id="category_id" name="category_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Family Transaction Checkbox (if applicable) -->
                        @if (auth()->user()->family_id)
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_family" name="is_family" type="checkbox" value="1"
                                        {{ $transaction->family_id ? 'checked' : '' }}
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_family" class="font-medium text-gray-700">Family Transaction</label>
                                    <p class="text-gray-500">Share this transaction with your family members</p>
                                </div>
                            </div>
                        @endif


                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('transaction.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Cancel</a>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Update Transaction
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
