<!-- resources/views/family/index.blade.php -->
@extends('layouts.app')
@section('title', 'Family')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mx-auto mt-20">
        <h2 class="text-3xl font-bold mb-6 text-center">Family</h2>

        @if (Auth::user()->family_id)
            <div class="bg-gray-50 p-6 rounded-lg mb-6">
                @if (Auth::user()->role === 'head')
                    <form action="{{ route('family.destroy') }}" method="POST">
                        @csrf
                        <button>
                            Delete Family
                        </button>
                    </form>
                @else
                <form action="{{ route('family.destroy') }}" method="POST">
                    @csrf
                    <button>
                        Leave Family
                    </button>
                </form>
                @endif
                <h3 class="text-xl font-semibold mb-4">{{ Auth::user()->family->code ?? 'Your Family' }}</h3>
                <h4 class="text-lg font-semibold mb-4">Family Members</h4>
                <ul class="divide-y divide-gray-200">
                    @foreach (Auth::user()->family->users as $member)
                        <li class="py-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 text-sm font-medium">{{ $member->name }}</p>
                                    <p class="text-gray-500 text-sm">{{ $member->email }}</p>
                                    <p class="text-gray-500 text-sm">{{ ucfirst($member->role) }}</p>
                                </div>
                            </div>
                            @if (Auth::user()->role === 'head' && $member->email !== Auth::user()->email)
                                <div>
                                    <a
                                        class="inline-block bg-gray-200 text-gray-700 py-2 px-4 rounded hover:bg-gray-300">
                                        Remove
                                    </a>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <!-- Create or Join Family Section -->
            <div class="bg-gray-50 p-6 rounded-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Create or Join a Family</h3>
                <p class="text-gray-700 mb-4">You don't have a family yet. You can either create a new family or join an
                    existing one using a code.</p>

                <!-- Create Family Form -->
                <form action="{{ route('family.create') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Family Name</label>
                        <input type="text" id="name" name="name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter family name" required>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Family
                    </button>
                </form>

                <!-- Join Family Form -->
                <form action="{{ route('family.join') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Family Code</label>
                        <input type="text" id="family_code" name="code"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter family code" required>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Join Family
                    </button>
                </form>
            </div>
    </div>
    @endif
@endsection
