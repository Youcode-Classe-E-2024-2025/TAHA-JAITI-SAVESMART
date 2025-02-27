@extends('layouts.app')

@section('title', 'Family')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12 px-4 sm:px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-blue-700 mb-2 tracking-tight">
                <i class="fas fa-home text-blue-500 mr-3"></i>Family Hub
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Connect, share, and grow together with your loved ones
            </p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            @if (Auth::user()->family_id)
                <!-- Family Details Section -->
                <div class="border-b border-gray-100">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-8 py-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold">{{ Auth::user()->family->name }}</h3>
                                <p class="text-blue-100 mt-1">
                                    <i class="fas fa-users mr-2"></i>{{ Auth::user()->family->users()->count() }} members
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="bg-white/20 backdrop-blur-sm px-4 py-3 rounded-xl flex items-center">
                                    <div>
                                        <p class="text-xs uppercase tracking-wider text-blue-100">Family Code</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl font-mono font-bold tracking-wider">{{ Auth::user()->family->code }}</span>
                                            <button onclick="copyToClipboard('{{ Auth::user()->family->code }}')" class="text-blue-100 hover:text-white transition-colors">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Actions -->
                <div class="px-8 py-6 bg-gray-50 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-cog mr-2 text-gray-500"></i>Family Management
                            </h4>
                            <p class="text-gray-500 text-sm mt-1">
                                @if (Auth::user()->role === 'head')
                                    You are the family head with full management rights
                                @else
                                    You are a family member
                                @endif
                            </p>
                        </div>
                        <div>
                            @if (Auth::user()->role === 'head')
                                <form action="{{ route('family.destroy') }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg transition-all duration-200 font-medium flex items-center gap-2 shadow-sm hover:shadow"
                                        onclick="return confirm('Are you sure you want to delete this family? This cannot be undone.')">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete Family</span>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('family.leave') }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg transition-all duration-200 font-medium flex items-center gap-2 shadow-sm hover:shadow"
                                        onclick="return confirm('Are you sure you want to leave this family?')">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Leave Family</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Family Members -->
                <div class="px-8 py-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">
                            <i class="fas fa-user-friends text-blue-500 mr-2"></i>Members
                        </h3>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ Auth::user()->family->users()->count() }} total
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach (Auth::user()->family->users as $member)
                            <div class="bg-white border border-gray-100 rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-all duration-200 group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-full bg-gradient-to-br {{ $member->role === 'head' ? 'from-blue-500 to-blue-700' : 'from-blue-300 to-blue-500' }} flex items-center justify-center text-white font-bold text-xl shadow-sm">
                                        {{ strtoupper($member->name[0]) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-gray-800 font-semibold text-lg">{{ $member->name }}</p>
                                            @if ($member->role === 'head')
                                                <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-medium">
                                                    <i class="fas fa-crown text-yellow-500 mr-1"></i>Head
                                                </span>
                                            @else
                                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs font-medium">
                                                    <i class="fas fa-user mr-1"></i>Member
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                    </div>
                                </div>
                                @if (Auth::user()->role === 'head' && $member->email !== Auth::user()->email)
                                    <form action="{{ route('family.remove', $member->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-gray-400 hover:text-red-600 transition-colors duration-200 opacity-0 group-hover:opacity-100"
                                            onclick="return confirm('Remove this member permanently?')">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Join or Create Family Section -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-8 py-6 text-white">
                    <h3 class="text-2xl font-bold">Welcome to Family Hub</h3>
                    <p class="text-blue-100 mt-1">Connect with your family members to share experiences and memories</p>
                </div>

                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Create Family -->
                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mb-4">
                                <i class="fas fa-plus-circle text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Create New Family</h4>
                            <p class="text-gray-600 mb-6">Start your own family group and invite members to join</p>

                            <form action="{{ route('family.create') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 mb-2 font-medium">Family Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-home text-gray-400"></i>
                                        </div>
                                        <input type="text" id="name" name="name"
                                            class="w-full border border-gray-300 rounded-lg pl-10 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                            placeholder="e.g., The Smith Family" required>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    <i class="fas fa-plus"></i>
                                    <span>Create Family</span>
                                </button>
                            </form>
                        </div>

                        <!-- Join Family -->
                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center text-green-600 mb-4">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Join Existing Family</h4>
                            <p class="text-gray-600 mb-6">Enter a family code to connect with your family members</p>

                            <form action="{{ route('family.join') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="code" class="block text-gray-700 mb-2 font-medium">Family Code</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-key text-gray-400"></i>
                                        </div>
                                        <input type="text" id="family_code" name="code"
                                            class="w-full border border-gray-300 rounded-lg pl-10 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                            placeholder="Enter 6-digit family code" required>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Join Family</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Family code copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
