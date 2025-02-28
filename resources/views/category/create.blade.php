@extends('layouts.app')
@section('title', 'Create Category - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Create New Category</h1>
                        <p class="mt-2 text-sm text-gray-600">Add a new category to organize your income and expenses.</p>
                    </div>
                    <a href="{{ route('category.index') }}"
                        class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Categories
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Category Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Fill in the information below to create your new category.</p>
                </div>

                <form action="{{ route('category.store') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission:
                                    </h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g., Groceries, Rent, Salary">
                        <p class="mt-1 text-sm text-gray-500">Choose a clear, descriptive name for your category.</p>
                    </div>

                    <!-- Type Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Personal Option -->
                            <label for="personal" class="relative block cursor-pointer">
                                <input type="radio" id="personal" name="type" value="personal" class="sr-only"
                                    checked>
                                <div
                                    class="p-4 border-2 border-gray-200 rounded-xl group hover:border-blue-200 peer-checked:border-blue-500">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Personal</h4>
                                            <p class="text-xs text-gray-500">Only visible to you</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100">
                                    <div class="w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </label>

                            <!-- Family Option -->
                            <label for="family" class="relative block cursor-pointer">
                                <input type="radio" id="family" name="type" value="family" class="sr-only peer">
                                <div
                                    class="p-4 border-2 border-gray-200 rounded-xl hover:border-purple-200 peer-checked:border-purple-500">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-users text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Family</h4>
                                            <p class="text-xs text-gray-500">Shared with family members</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100">
                                    <div class="w-5 h-5 bg-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 mt-8">
                        <a href="{{ route('category.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-lightbulb text-blue-600"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-medium text-blue-900">Tips for Categories</h3>
                        <ul class="mt-2 text-sm text-blue-700 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 mr-2"></i>
                                <span>Be specific with category names to make tracking easier.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 mr-2"></i>
                                <span>Personal categories are only visible to you, while family categories are
                                    shared.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-0.5 mr-2"></i>
                                <span>You can always edit or delete categories later if needed.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
