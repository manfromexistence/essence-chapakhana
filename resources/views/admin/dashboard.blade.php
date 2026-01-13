@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
    <p class="mt-2 text-gray-600">Welcome back, {{ Auth::user()->name }}! Here's your business summary.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">1,234</p>
                <p class="text-sm text-green-600 mt-1">+12.5% from last month</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Revenue</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">$56,789</p>
                <p class="text-sm text-green-600 mt-1">+8.3% from last month</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Products</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">456</p>
                <p class="text-sm text-blue-600 mt-1">Active listings</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Customers</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">8,945</p>
                <p class="text-sm text-green-600 mt-1">+15.2% from last month</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Orders</h2>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Order ID</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Customer</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Product</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Amount</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm">#10234</td>
                    <td class="py-3 px-4 text-sm">John Doe</td>
                    <td class="py-3 px-4 text-sm">Paperback Book</td>
                    <td class="py-3 px-4 text-sm font-medium">$234.00</td>
                    <td class="py-3 px-4"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Completed</span></td>
                    <td class="py-3 px-4"><button class="text-blue-600 hover:text-blue-700 text-sm">View</button></td>
                </tr>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm">#10233</td>
                    <td class="py-3 px-4 text-sm">Jane Smith</td>
                    <td class="py-3 px-4 text-sm">Business Cards</td>
                    <td class="py-3 px-4 text-sm font-medium">$89.00</td>
                    <td class="py-3 px-4"><span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">Processing</span></td>
                    <td class="py-3 px-4"><button class="text-blue-600 hover:text-blue-700 text-sm">View</button></td>
                </tr>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm">#10232</td>
                    <td class="py-3 px-4 text-sm">Mike Johnson</td>
                    <td class="py-3 px-4 text-sm">Vinyl Stickers</td>
                    <td class="py-3 px-4 text-sm font-medium">$145.00</td>
                    <td class="py-3 px-4"><span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Shipping</span></td>
                    <td class="py-3 px-4"><button class="text-blue-600 hover:text-blue-700 text-sm">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
