<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mx-auto mt-20">
    <h2 class="text-3xl font-bold mb-6 text-center">Dashboard</h2>

    <!-- Budget Summary -->
    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <h3 class="text-xl font-semibold mb-4">Budget Summary</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-2">Total Income</h4>
                <p class="text-2xl font-bold text-green-500">$1,500.00</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-2">Total Expenses</h4>
                <p class="text-2xl font-bold text-red-500">$1,000.00</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-2">Available Balance</h4>
                <p class="text-2xl font-bold text-blue-500">$500.00</p>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-right">Amount</th>
                    <th class="px-4 py-2 text-right">Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">2023-10-01</td>
                    <td class="border px-4 py-2">Groceries</td>
                    <td class="border px-4 py-2 text-right">$150.00</td>
                    <td class="border px-4 py-2 text-right">Alimentation</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">2023-09-30</td>
                    <td class="border px-4 py-2">Rent</td>
                    <td class="border px-4 py-2 text-right">$800.00</td>
                    <td class="border px-4 py-2 text-right">Logement</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">2023-09-29</td>
                    <td class="border px-4 py-2">Movie Night</td>
                    <td class="border px-4 py-2 text-right">$50.00</td>
                    <td class="border px-4 py-2 text-right">Divertissement</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Upcoming Goals -->
    <div class="bg-gray-50 p-6 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Upcoming Goals</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-2">Buy a New Laptop</h4>
                <p class="text-gray-700 mb-2">Target: $1,200.00</p>
                <p class="text-gray-700 mb-2">Saved: $300.00</p>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 25%;"></div>
                </div>
                <p class="text-gray-700">Progress: 25%</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-2">Vacation to Europe</h4>
                <p class="text-gray-700 mb-2">Target: $5,000.00</p>
                <p class="text-gray-700 mb-2">Saved: $1,000.00</p>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 20%;"></div>
                </div>
                <p class="text-gray-700">Progress: 20%</p>
            </div>
        </div>
    </div>
</div>
@endsection
