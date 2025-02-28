@extends('layouts.app')
@section('title', 'Financial Goals - 7sebFlosk')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Financial Goals</h1>
                <p class="mt-2 text-sm text-gray-600">Track your progress towards your financial dreams.</p>
            </div>
            <a href="{{ route('goal.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i>
                New Goal
            </a>
        </div>

        <!-- Goals Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($financialGoals as $goal)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-200">
                    <!-- Goal Cover Image -->
                    <div class="h-40 bg-gradient-to-r from-blue-400 to-purple-500 relative">
                        @if($goal->cover)
                            <img src="{{ asset('storage/' . $goal->cover) }}" alt="{{ $goal->name }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $goal->status === 'active' ? 'bg-green-50 text-green-600' : 'bg-blue-50 text-blue-600' }}">
                                {{ ucfirst($goal->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Goal Content -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $goal->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $goal->description }}</p>

                        <!-- Progress Bar -->
                        <div class="mb-2 flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-700">
                                ${{ number_format($goal->current_amount, 2) }} of ${{ number_format($goal->target, 2) }}
                            </span>
                            <span class="text-sm font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                                {{ round(($goal->current_amount / $goal->target) * 100) }}%
                            </span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-4">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"
                                 style="width: {{ min(($goal->current_amount / $goal->target) * 100, 100) }}%"></div>
                        </div>

                        <!-- Deadline -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                <span>Deadline: {{ \Carbon\Carbon::parse($goal->deadline)->format('M d, Y') }}</span>
                            </div>

                            <!-- Actions Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                    <a href="{{ route('goal.edit', $goal) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    <a href="{{ route('goal.show', $goal) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-eye mr-2"></i> View Details
                                    </a>
                                    <form action="{{ route('goal.destroy', $goal) }}" method="POST" class="block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="return confirm('Are you sure you want to delete this goal?')">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl shadow-sm p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto flex items-center justify-center mb-4">
                        <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Financial Goals Yet</h3>
                    <p class="text-gray-600 mb-6">Start setting financial goals to track your progress and achieve your dreams.</p>
                    <a href="{{ route('goal.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-plus mr-2"></i>
                        Create Your First Goal
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($financialGoals->hasPages())
            <div class="mt-6">
                {{ $financialGoals->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
