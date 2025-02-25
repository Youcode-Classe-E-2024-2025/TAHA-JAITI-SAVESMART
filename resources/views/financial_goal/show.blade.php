@extends('layouts.dash')
@section('title', '7sebFlosk - View Financial Goal')
@section('content')
    <!-- Main Content -->
    <div class="p-4 sm:ml-64 bg-gray-900">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Financial Goal Details</h1>
                <p class="text-gray-400">View your financial goal</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('financial_goals.edit', $financialGoal) }}" class="px-4 py-2 rounded-full bg-lime-400 text-black hover:bg-yellow-400 transition-colors">
                    Edit Goal
                </a>
                <form action="{{ route('financial_goals.destroy', $financialGoal) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition-colors">
                        Delete Goal
                    </button>
                </form>
            </div>
        </div>
        <!-- Goal Details -->
        <div class="glass rounded-3xl p-6 space-y-4">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-bold">{{ $financialGoal->name }}</h2>
                <span class="px-2 py-1 text-xs rounded-full bg-lime-400/20 text-lime-400">
                    Target: ${{ number_format($financialGoal->target_amount, 2) }}
                </span>
            </div>
            <div>
                <p class="text-gray-400">Start Date: {{ $financialGoal->start_date }}</p>
                <p class="text-gray-400">End Date: {{ $financialGoal->end_date ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold">Description</h3>
                <p class="text-gray-400">{{ $financialGoal->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>
@endsection
