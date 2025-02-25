<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '7sebFlosk - sebFlosk - Add a new Transaction')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="overflow-x-hidden text-white bg-black">

<main>
    <div class="min-h-screen flex items-center justify-center ">
        <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 bg-gray-900 rounded-3xl shadow-2xl">
            <!-- Form Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold">Add New Transaction</h1>
                <p class="text-gray-400">Record your transactions</p>
            </div>

            <!-- Income Form -->
            <form action="{{ route('trans.store') }}" method="POST"
                  class="glass rounded-3xl p-6 space-y-6">
                @csrf
                <!-- Basic Information -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">$</span>
                            <input name="amount"
                                   type="number" step="0.01"
                                   class="w-full pl-8 pr-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400"
                                   placeholder="0.00">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Receive Date</label>
                        <input type="date"
                               name="date_received"
                               class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                    </div>
                </div>

                <!-- Source and Category -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Category</label>
                        <select
                            name="category_id"
                            class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                            @if (count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>>
                                @endforeach
                            @else
                                <option value="">No category has been created</option>>
                            @endif
                        </select>

                    </div>
                </div>

                <!-- Recurring Options -->
                <div class="space-y-4">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Frequency</label>
                            <select
                                name="frequency"
                                class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                                <option value="monthly">Monthly</option>
                                <option value="weekly">Weekly</option>
                                <option value="daily">Daily</option>
                                <option value="one-time">One-Time</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Type</label>
                            <select
                                name="type"
                                class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-xl focus:border-lime-400 focus:ring-lime-400">
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                            class="px-6 py-2 bg-lime-400 text-black rounded-xl hover:bg-yellow-400 transition-colors">
                        Save Income
                    </button>
                    <a href="{{route('dashboard')}}" type="button"
                       class="px-6 py-2 border border-gray-700 rounded-xl hover:bg-gray-800 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>

