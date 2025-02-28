@extends('layouts.app')
@section('title', 'Add Transaction - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900">Add Transaction</h1>
                        <p class="mt-2 text-sm text-gray-600">Record a new income or expense transaction.</p>
                    </div>
                    <div>
                        <a href="{{ route('transaction.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
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
                    <p class="mt-1 text-sm text-gray-500">Fill in the details of your transaction.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('transaction.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Transaction Type -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Type</label>
                                <div class="flex space-x-4">
                                    <label class="relative flex items-center p-4 rounded-lg border cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-500 @error('type') border-red-300 @else border-gray-200 @enderror flex-1">
                                        <input type="radio" name="type" value="income" class="sr-only" {{ old('type') == 'income' ? 'checked' : '' }} required>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                                <i class="fas fa-arrow-up text-green-600"></i>
                                            </div>
                                            <div>
                                                <span class="block text-sm font-medium text-gray-900">Income</span>
                                                <span class="block text-xs text-gray-500">Money you receive</span>
                                            </div>
                                        </div>
                                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
                                    </label>

                                    <label class="relative flex items-center p-4 rounded-lg border cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-500 @error('type') border-red-300 @else border-gray-200 @enderror flex-1">
                                        <input type="radio" name="type" value="expense" class="sr-only" {{ old('type') == 'expense' ? 'checked' : '' }} required>
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                                                <i class="fas fa-arrow-down text-red-600"></i>
                                            </div>
                                            <div>
                                                <span class="block text-sm font-medium text-gray-900">Expense</span>
                                                <span class="block text-xs text-gray-500">Money you spend</span>
                                            </div>
                                        </div>
                                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
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
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Transaction Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-2 border @error('name') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="E.g., Salary, Grocery Shopping">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">$</span>
                                    </div>
                                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0.01" required
                                        class="pl-10 w-full px-4 py-2 border @error('amount') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0.00">
                                </div>
                                @error('amount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date and Category -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required
                                    class="w-full px-4 py-2 border @error('transaction_date') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('transaction_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select id="category_id" name="category_id" required
                                    class="w-full px-4 py-2 border @error('category_id') border-red-300 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select a category</option>

                                    @if(isset($categories) && count($categories) > 0)
                                        <optgroup label="Categories">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Family Transaction Checkbox (if applicable) -->
                        @if(auth()->user()->family_id)
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_family" name="is_family" type="checkbox" value="1" {{ old('is_family') ? 'checked' : '' }}
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
                            <a href="{{ route('transaction.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Transaction
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Tips Card -->
            <div class="mt-6 bg-blue-50 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-1">
                            <i class="fas fa-lightbulb text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Quick Tips</h3>
                            <div class="mt-2 text-sm text-blue-700 space-y-2">
                                <p>✓ Regular transactions can be set up as recurring later from your dashboard.</p>
                                <p>✓ Be specific with transaction names to make your financial analysis easier.</p>
                                <p>✓ You can edit or delete transactions at any time from the transactions list.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show/hide appropriate categories based on transaction type
            const typeRadios = document.querySelectorAll('input[name="type"]');
            const categorySelect = document.getElementById('category_id');
            const incomeCategories = categorySelect.querySelector('optgroup[label="Categories"]');
            const expenseCategories = categorySelect.querySelector('optgroup[label="Categories"]');

            function updateCategoryVisibility() {
                const selectedType = document.querySelector('input[name="type"]:checked')?.value;

                if (incomeCategories && expenseCategories) {
                    if (selectedType === 'income') {
                        incomeCategories.style.display = '';
                        expenseCategories.style.display = 'none';

                        // Reset selection if currently selected option is now hidden
                        const currentOption = categorySelect.options[categorySelect.selectedIndex];
                        if (currentOption.parentElement === expenseCategories) {
                            categorySelect.value = '';
                        }
                    } else if (selectedType === 'expense') {
                        incomeCategories.style.display = 'none';
                        expenseCategories.style.display = '';

                        // Reset selection if currently selected option is now hidden
                        const currentOption = categorySelect.options[categorySelect.selectedIndex];
                        if (currentOption.parentElement === incomeCategories) {
                            categorySelect.value = '';
                        }
                    } else {
                        // Both visible if nothing selected yet
                        incomeCategories.style.display = '';
                        expenseCategories.style.display = '';
                    }
                }
            }

            // Initial update
            updateCategoryVisibility();

            // Update on change
            typeRadios.forEach(radio => {
                radio.addEventListener('change', updateCategoryVisibility);
            });
        });
    </script>
@endsection
