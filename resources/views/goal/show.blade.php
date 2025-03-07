@extends('layouts.app')
@section('title', $goal->name . ' - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <i class="fas fa-home mr-2 text-sm"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <a href="{{ route('goal.index') }}"
                                class="text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-1">
                                Financial Goals
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <span
                                class="text-sm font-medium text-gray-500 md:ml-1 truncate max-w-xs">{{ $goal->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Goal Header Card -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8 border border-gray-100">
                <!-- Cover Image with Overlay -->
                <div class="h-56 relative">
                    @if ($goal->cover)
                        <img src="{{ asset('storage/' . $goal->cover) }}" alt="{{ $goal->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        <span
                            class="px-3 py-1.5 text-sm font-semibold rounded-full {{ $goal->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            <i class="fas {{ $goal->status === 'active' ? 'fa-circle-play' : 'fa-circle-check' }} mr-1"></i>
                            {{ ucfirst($goal->status) }}
                        </span>
                    </div>

                    <!-- Status Badge -->
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-3 py-1.5 text-sm font-semibold rounded-full {{ $goal->type === 'needs' ? 'bg-green-100 text-green-700' : ($goal->type === 'wants' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                            <i class="fas {{ $goal->type === 'needs' ? 'fa-circle-play' : 'fa-circle-check' }} mr-1"></i>
                            {{ ucfirst($goal->type) }}
                        </span>
                    </div>

                    <!-- Goal Title (positioned at bottom of cover) -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h1 class="text-3xl font-bold text-white">{{ $goal->name }}</h1>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        <a href="{{ route('goal.edit', $goal) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Goal
                        </a>
                        @if ($goal->status === 'active')
                            <form action="{{ route('goal.deposit', $goal) }}" method="POST" id="allocationForm">
                                @csrf
                                <button id="openAllocationModal"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                    <i class="fas fa-coins mr-2"></i>
                                    Allocate Funds
                                </button>
                            </form>


                            <p class="text-sm text-gray-500 self-center">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Amount to allocate <span
                                    class="font-bold text-green-600 text-md">${{ $opt }}</span>
                            </p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="text-gray-700 mb-8 bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Description
                        </h3>
                        <p class="text-gray-600">{{ $goal->description }}</p>
                    </div>

                    <!-- Progress Card -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
                        <div class="p-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                                Progress Tracker
                            </h3>

                            <!-- Amount Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="block text-sm font-medium text-gray-500 mb-1">Target Amount</span>
                                    <span class="block text-2xl font-bold text-gray-900">
                                        <i class="fas fa-bullseye text-red-500 mr-1"></i>
                                        ${{ number_format($goal->target, 2) }}
                                    </span>
                                </div>
                                <div class="bg-blue-50 rounded-lg p-4 text-center">
                                    <span class="block text-sm font-medium text-gray-500 mb-1">Current Amount</span>
                                    <span class="block text-2xl font-bold text-blue-600">
                                        <i class="fas fa-piggy-bank text-blue-500 mr-1"></i>
                                        ${{ number_format($goal->current_amount, 2) }}
                                    </span>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="block text-sm font-medium text-gray-500 mb-1">Remaining</span>
                                    <span class="block text-2xl font-bold text-gray-900">
                                        <i class="fas fa-hourglass-half text-amber-500 mr-1"></i>
                                        ${{ number_format($goal->target - $goal->current_amount, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-2">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm font-medium text-blue-700 bg-blue-50 px-3 py-1 rounded-full">
                                        <i class="fas fa-percentage mr-1"></i>
                                        {{ round(($goal->current_amount / $goal->target) * 100) }}% Complete
                                    </span>
                                </div>
                                <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full transition-all duration-500"
                                        style="width: {{ min(($goal->current_amount / $goal->target) * 100, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Goal Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Goal Details -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-list-check text-indigo-500 mr-2"></i>
                                Goal Details
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Deadline</span>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($goal->deadline)->format('M d, Y') }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-hourglass text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Time Remaining</span>
                                    </div>
                                    @php
                                        $daysRemaining = \Carbon\Carbon::now()->diffInDays(
                                            \Carbon\Carbon::parse($goal->deadline),
                                            false,
                                        );
                                    @endphp
                                    <span
                                        class="text-sm font-medium {{ $daysRemaining > 30 ? 'text-green-600' : ($daysRemaining > 0 ? 'text-amber-600' : 'text-red-600') }}">
                                        {{ $daysRemaining > 0 ? $daysRemaining . ' days' : 'Deadline passed' }}
                                    </span>
                                </div>

                                @if (isset($goal->family_id))
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <div class="flex items-center">
                                            <i class="fas fa-users text-gray-400 mr-3 w-5"></i>
                                            <span class="text-sm text-gray-500">Family Goal</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $goal->family->name ?? 'Yes' }}
                                        </span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock-rotate-left text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Created</span>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $goal->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Allocation Plan -->
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-calculator text-green-500 mr-2"></i>
                                Allocation Plan
                            </h3>
                            @php
                                $monthsRemaining = max(
                                    1,
                                    \Carbon\Carbon::now()->diffInMonths(\Carbon\Carbon::parse($goal->deadline), false),
                                );
                                $amountRemaining = $goal->target - $goal->current_amount;
                                $monthlyTarget = round($amountRemaining / $monthsRemaining, 2);
                            @endphp
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Months Remaining</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $monthsRemaining }} months</span>
                                </div>

                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Monthly Allocation</span>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget, 2) }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-week text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Weekly Allocation</span>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget / 4, 2) }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Daily Allocation</span>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget / 30, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-start mb-8">
                <a href="{{ route('goal.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Goals
                </a>
            </div>
        </div>
    </div>
@endsection
