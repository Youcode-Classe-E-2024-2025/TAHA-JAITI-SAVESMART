@extends('layouts.app')
@section('title', $goal->name . ' - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <i class="fas fa-home mr-2 text-sm"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <a href="{{ route('goal.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-1">
                                Financial Goals
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                            <span class="text-sm font-medium text-gray-500 md:ml-1 truncate max-w-xs">{{ $goal->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Goal Header Card -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8 border border-gray-100">
                <!-- Cover Image with Overlay -->
                <div class="h-56 relative">
                    @if ($goal->cover)
                        <img src="{{ asset('storage/' . $goal->cover) }}" alt="{{ $goal->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1.5 text-sm font-semibold rounded-full {{ $goal->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            <i class="fas {{ $goal->status === 'active' ? 'fa-circle-play' : 'fa-circle-check' }} mr-1"></i>
                            {{ ucfirst($goal->status) }}
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
                        <a href="{{ route('goal.edit', $goal) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Goal
                        </a>
                        <button id="openAllocationModal" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            <i class="fas fa-coins mr-2"></i>
                            Allocate Funds
                        </button>
                        @if($goal->status === 'active')
                            <form action="{{ route('goal.markAsDone', $goal) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Mark as Done
                                </button>
                            </form>
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
                                        style="width: {{ min(($goal->current_amount / $goal->target) * 100, 100) }}%"></div>
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
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($goal->deadline)->format('M d, Y') }}</span>
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
                                    <span class="text-sm font-medium {{ $daysRemaining > 30 ? 'text-green-600' : ($daysRemaining > 0 ? 'text-amber-600' : 'text-red-600') }}">
                                        {{ $daysRemaining > 0 ? $daysRemaining . ' days' : 'Deadline passed' }}
                                    </span>
                                </div>

                                @if(isset($goal->family_id))
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
                                    <span class="text-sm font-medium text-gray-900">{{ $goal->created_at->format('M d, Y') }}</span>
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
                                    \Carbon\Carbon::now()->diffInMonths(
                                        \Carbon\Carbon::parse($goal->deadline),
                                        false,
                                    ),
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
                                    <span class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget, 2) }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-week text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Weekly Allocation</span>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget / 4, 2) }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day text-gray-400 mr-3 w-5"></i>
                                        <span class="text-sm text-gray-500">Daily Allocation</span>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">${{ number_format($monthlyTarget / 30, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-start mb-8">
                <a href="{{ route('goal.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Goals
                </a>
            </div>
        </div>
    </div>

    <!-- Allocation Modal (You would need to implement this) -->
    <div id="allocationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-coins text-green-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Allocate Funds to Goal
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Add funds to your "{{ $goal->name }}" goal. Current progress: {{ round(($goal->current_amount / $goal->target) * 100) }}%
                                </p>
                            </div>
                            <form action="{{ route('goal.deposit', $goal) }}" method="POST" id="allocationForm" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" step="0.01" min="0.01" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="submitAllocation" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Add Funds
                    </button>
                    <button type="button" id="closeAllocationModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('allocationModal');
            const openModalBtn = document.getElementById('openAllocationModal');
            const closeModalBtn = document.getElementById('closeAllocationModal');
            const submitBtn = document.getElementById('submitAllocation');

            window.openAllocationModal = function() {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const closeModal = function() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            openModalBtn.addEventListener('click', window.openAllocationModal);
            closeModalBtn.addEventListener('click', closeModal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

        });
    </script>
@endsection
