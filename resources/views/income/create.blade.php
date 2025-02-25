@extends('layouts.dash')

@section('title', '7sebFlosk - Add a new Income')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
            <!-- Form Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold">Add New Income</h1>
                <p class="text-gray-400">Record your income sources</p>
            </div>

            <!-- Income Form -->
            <form action="{{ route('income.store') }}" method="POST"
                class="glass rounded-3xl p-6 space-y-6">
                @csrf
                <!-- Basic Information -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">$</span>
                            <input name="amount"
                                type="number" step="0.01"
                                   class="w-full pl-8 pr-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                                   placeholder="0.00">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Date</label>
                        <input type="date"
                               class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                    </div>
                </div>

                <!-- Source and Category -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Source</label>
                        <select
                            name="source"
                            class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                            <option value="">Select Source</option>
                            <option value="salary">Salary</option>
                            <option value="freelance">Freelance</option>
                            <option value="investments">Investments</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Category</label>
                        <select class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                            <option value="">Select Category</option>
                            <option value="regular">Regular Income</option>
                            <option value="bonus">Bonus</option>
                            <option value="passive">Passive Income</option>
                        </select>
                    </div>
                </div>

                <!-- Recurring Options -->
                <div class="space-y-4">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Frequency</label>
                            <select
                                name="type"
                                class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                                <option value="monthly">Monthly</option>
                                <option value="weekly">Weekly</option>
                                <option value="daily">Daily</option>
                                <option value="one-time">One-Time</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                            class="px-6 py-2 bg-lime-400 text-black rounded-xl hover:bg-yellow-400 transition-colors">
                        Save Income
                    </button>
                    <button type="button"
                            class="px-6 py-2 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
