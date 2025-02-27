@extends('layouts.app')
@section('title', 'Categories - 7sebFlosk')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Categories</h1>
                <p class="mt-2 text-sm text-gray-600">Manage your expense and income categories.</p>
            </div>
            <a href="" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i>
                New Category
            </a>
        </div>

        <!-- Categories List -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Your Categories</h3>
                    <div class="flex space-x-2">
                        <div class="relative">
                            <input type="text" placeholder="Search categories..." class="w-64 pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute left-3 top-2.5">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <select class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="all">All Categories</option>
                            <option value="personal">Personal</option>
                            <option value="family">Family</option>
                        </select>
                    </div>
                </div>
            </div>

            @if(count($categories ?? []) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($categories ?? [] as $category)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-{{ $category->family_id ? 'purple' : 'blue' }}-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-tag text-{{ $category->family_id ? 'purple' : 'blue' }}-600"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-{{ $category->family_id ? 'purple' : 'blue' }}-50 text-{{ $category->family_id ? 'purple' : 'blue' }}-600 rounded-full">
                                            {{ $category->family_id ? 'Family' : 'Personal' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $category->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('category.destroy', $category) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tag text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-base font-medium text-gray-900 mb-1">No categories found</h3>
                    <p class="text-sm text-gray-500 mb-4">You haven't created any categories yet.</p>
                    <a href="{{ route('category.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-plus mr-2"></i>
                        Create your first category
                    </a>
                </div>
            @endif

            <!-- Pagination -->
            @if(isset($categories) && $categories->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-lightbulb text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-base font-medium text-blue-900">Pro Tip</h3>
                    <p class="mt-1 text-sm text-blue-700">
                        Organizing your transactions into categories helps you track spending patterns and identify areas where you can save money. Try creating categories for essential expenses (like rent, utilities) and discretionary spending (entertainment, dining out).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
