<!-- Message Component -->
<div class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-sm">
    @if (session()->has('success'))
        <div id="message-success"
            class="bg-white border-l-4 border-green-500 shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8">
            <div class="p-4 flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900">Success!</p>
                    <p class="mt-1 text-sm text-gray-600">{{ session('success') }}</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button type="button" @click="show = false"
                        class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
            <!-- Progress bar -->
            <div class="h-1 bg-green-100 w-full">
                <div class="h-full bg-green-500 transition-all duration-[5000ms] w-0" x-init="setTimeout(() => $el.classList.add('w-full'), 100)">
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div id="message-error"
            class="bg-white border-l-4 border-red-500 shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8">
            <div class="p-4 flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900">Error!</p>
                    <p class="mt-1 text-sm text-gray-600">{{ session('error') }}</p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button type="button" @click="show = false"
                        class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
            <!-- Progress bar -->
            <div class="h-1 bg-red-100 w-full">
                <div class="h-full bg-red-500 transition-all duration-[5000ms] w-0" x-init="setTimeout(() => $el.classList.add('w-full'), 100)">
                </div>
            </div>
        </div>
    @endif
</div>
