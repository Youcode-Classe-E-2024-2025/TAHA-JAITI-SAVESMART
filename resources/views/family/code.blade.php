@extends('layouts.app')
@section('title', '7sebFlosk - Family Creation')
@section('content')
    <div class="min-h-screen w-full flex flex-col items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-2xl relative">
            <!-- Card Container -->
            <div class="w-full bg-gray-900/50 backdrop-blur-sm border border-gray-800 rounded-xl p-6 sm:p-8">
                <!-- Subtle top gradient border -->
                <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-yellow-500 to-lime-500 rounded-t-xl"></div>
                <!-- Header with Family Info -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-white mb-2">{{ $family->name }}</h1>
                    <p class="text-gray-400 text-sm">Family Code</p>
                </div>
                @if (session('status'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                        <p class="text-sm text-red-400 text-center">{{ session('status') }}</p>
                    </div>
                @endif
                <!-- Family Code Section -->
                <div class="mb-8">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <label for="code" class="block text-sm font-medium text-gray-300 mb-2">Family Code</label>
                        <div class="flex items-center space-x-3">
                            <div class="relative flex-1">
                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    value="{{ $family->code }}"
                                    class="w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-yellow-500 focus:ring focus:ring-yellow-500/20 focus:outline-none transition-colors"
                                    readonly
                                >
                            </div>
                            <button
                                onclick="copyToClipboard()"
                                class="px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500/50"
                            >
                                Copy
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Share this code with family members to let them join</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard() {
            const codeInput = document.getElementById('code');
            const button = event.target;
            const originalText = button.textContent;
            if (codeInput && codeInput.value) {
                navigator.clipboard.writeText(codeInput.value)
                    .then(() => {
                        button.textContent = 'Copied!';
                        setTimeout(() => {
                            button.textContent = originalText;
                        }, 2000);
                    })
                    .catch(err => console.error('Failed to copy:', err));
            }
        }
    </script>
@endsection

<style>
    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.125);
    }
</style>
