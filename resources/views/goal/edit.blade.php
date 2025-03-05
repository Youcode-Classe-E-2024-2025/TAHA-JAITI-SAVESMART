@extends('layouts.app')
@section('title', 'Edit Financial Goal - 7sebFlosk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-2xl font-bold text-gray-900">Edit Financial Goal</h1>
                        <p class="mt-2 text-sm text-gray-600">Update and modify your existing financial goal.</p>
                    </div>
                    <div>
                        <a href="{{ route('goal.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Financial Goals
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Goal Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Modify the details of your financial goal.</p>
                </div>

                <form action="{{ route('goal.update', $goal->id) }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-md font-medium text-gray-800 mb-4">Goal Information</h2>
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Goal Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $goal->name) }}"
                                    required
                                    class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="e.g., New Car, Emergency Fund, Dream Vacation">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Describe your financial goal and why it's important to you">{{ old('description', $goal->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cover Image -->
                            <div>
                                <label for="cover" class="block text-sm font-medium text-gray-700 mb-1">Cover
                                    Image</label>
                                <div class="mt-1 flex items-center">
                                    <div class="w-full">
                                        <label
                                            class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-150">
                                            <div class="space-y-1 text-center">
                                                <i class="fas fa-cloud-upload-alt text-blue-500 text-3xl mb-2"></i>
                                                <div class="flex text-sm text-gray-600">
                                                    <span>Upload a new image</span>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                                @if ($goal->cover_image)
                                                    <p class="mt-2 text-sm text-gray-500">Current image:
                                                        {{ basename($goal->cover_image) }}</p>
                                                @endif
                                            </div>
                                            <input id="cover" name="cover" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                @error('cover')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Financial Details -->
                    <div>
                        <h2 class="text-md font-medium text-gray-800 mb-4">Financial Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Target Amount -->
                            <div>
                                <label for="target" class="block text-sm font-medium text-gray-700 mb-1">Target Amount
                                    ($)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="target" id="target" step="0.01" min="0"
                                        value="{{ old('target', $goal->target_amount) }}" required
                                        class="w-full pl-7 px-4 py-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="0.00">
                                </div>
                                @error('target')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Amount -->
                            <div>
                                <label for="current_amount" class="block text-sm font-medium text-gray-700 mb-1">Current
                                    Amount ($)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="current_amount" id="current_amount" step="0.01"
                                        min="0" value="{{ old('current_amount', $goal->current_amount) }}"
                                        class="w-full pl-7 px-4 py-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="0.00">
                                </div>
                                @error('current_amount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deadline -->
                            <div>
                                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                                <input type="date" name="deadline" id="deadline"
                                    value="{{ old('deadline', $goal->deadline ? $goal->deadline->format('Y-m-d') : '') }}"
                                    required
                                    class="w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('deadline')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Family Transaction Checkbox (if applicable) -->
                    @if (auth()->user()->family_id)
                        <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center h-5">
                                <input id="is_family" name="is_family" type="checkbox" value="1"
                                    {{ old('is_family', $goal->is_family) ? 'checked' : '' }}
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_family" class="font-medium text-gray-700">Family Transaction</label>
                                <p class="text-gray-500">Share this transaction with your family members</p>
                            </div>
                        </div>
                    @endif

                    <!-- Progress Visualization -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="mb-2">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-600">Goal Progress</span>
                                <span class="text-sm font-medium text-gray-600">
                                    {{ number_format(($goal->current_amount / $goal->target) * 100, 1) }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full"
                                    style="width: {{ number_format(($goal->current_amount / $goal->target) * 100, 1) }}%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-1">
                                <i class="fas fa-lightbulb text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Goal Editing Tips</h3>
                                <div class="mt-2 text-sm text-blue-700 space-y-2">
                                    <p>✓ Review your goal details carefully before updating.</p>
                                    <p>✓ Adjust your target or deadline if your financial situation changes.</p>
                                    <p>✓ Consider updating the current amount as you make progress.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('goal.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            Update Goal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
