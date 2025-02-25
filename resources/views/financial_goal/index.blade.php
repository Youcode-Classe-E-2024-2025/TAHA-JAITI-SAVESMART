@extends('layouts.dash')
@section('title', '7sebFlosk - Financial Goals')
@section('content')
    <!-- Main Content -->
    <div class="p-4 sm:ml-64 bg-gray-900">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Financial Goals</h1>
                <p class="text-gray-400">Manage your financial goals</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('financial_goals.create') }}" class="px-4 py-2 rounded-full bg-lime-400 text-black hover:bg-yellow-400 transition-colors">
                    New Goal
                </a>
            </div>
        </div>
        <form action="{{ route('financial_goals.index') }}" method="GET">
            <div class="grid gap-4 mb-8 md:grid-cols-3">
                <div class="glass rounded-xl p-4">
                    <input type="text" name="name" placeholder="Name" value="{{ request('name') }}"
                           class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                </div>
                <div class="glass rounded-xl p-4">
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                </div>
                <div class="glass rounded-xl p-4">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="w-full bg-transparent border-gray-700 rounded-lg focus:border-lime-400 focus:ring-lime-400">
                </div>
            </div>
            <button type="submit" class="bg-lime-400 text-white px-4 py-2 rounded-lg">Apply Filters</button>
        </form>
        <!-- Financial Goals Table -->
        <div class="glass rounded-3xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-800/50">
                <tr>
                    <th class="p-4">Name</th>
                    <th class="p-4">Target Amount</th>
                    <th class="p-4">Start Date</th>
                    <th class="p-4">End Date</th>
                    <th class="p-4">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                @if ($financialGoals->isEmpty())
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-400">No financial goals found.</td>
                    </tr>
                @else
                    @foreach($financialGoals as $goal)
                        <tr class="hover:bg-gray-800/30">
                            <td class="p-4">{{ $goal->name }}</td>
                            <td class="p-4">${{ number_format($goal->target_amount, 2) }}</td>
                            <td class="p-4">{{ $goal->start_date }}</td>
                            <td class="p-4">{{ $goal->end_date ?? 'N/A' }}</td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('financial_goals.edit', $goal) }}" class="text-lime-400 hover:text-yellow-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('financial_goals.destroy', $goal) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-lg hover:bg-gray-700">
                                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor"
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
            <div class="text-sm text-gray-400">
                {{ $financialGoals->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
