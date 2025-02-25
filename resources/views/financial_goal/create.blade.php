@extends('layouts.app')
@section('title', '7sebFlosk - Create Financial Goal')
@section('content')
    <!-- Main Content -->
    <div class="p-4 sm:ml-64 bg-gray-900">
        <!-- Form Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Create Financial Goal</h1>
            <p class="text-gray-400">Set a new financial goal</p>
        </div>
        <!-- Create Form -->
        <form action="{{ route('financial_goals.store') }}" method="POST"
              class="glass rounded-3xl p-6 space-y-6">
            @csrf
            <!-- Basic Information -->
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-400">Name</label>
                <input name="name"
                       type="text"
                       class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                       placeholder="Enter goal name" required>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-400">Target Amount</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">$</span>
                    <input name="target_amount"
                           type="number" step="0.01"
                           class="w-full pl-8 pr-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                           placeholder="0.00" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-400">Start Date</label>
                <input type="date"
                       name="start_date"
                       class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                       required>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-400">End Date</label>
                <input type="date"
                       name="end_date"
                       class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-400">Description</label>
                <textarea name="description"
                          class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                          placeholder="Enter description"></textarea>
            </div>
            <!-- Form Actions -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="px-6 py-2 bg-lime-400 text-black rounded-xl hover:bg-yellow-400 transition-colors">
                    Save Goal
                </button>
                <a href="{{ route('financial_goals.index') }}" type="button"
                   class="px-6 py-2 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
