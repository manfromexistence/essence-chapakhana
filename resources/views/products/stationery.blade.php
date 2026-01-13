@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-blue-600 hover:text-blue-800">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-600">Stationery</span>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12 sm:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">Custom Stationery</h1>
                    <p class="text-lg sm:text-xl text-gray-700 max-w-2xl mb-6">
                        Professional stationery products to elevate your brand. From letterheads to notebooks, we offer high-quality custom options.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            <span class="text-2xl font-bold text-yellow-400">★★★★★</span>
                            <span class="text-gray-600">4.6 Feefo Rating</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2C5.58 2 2 5.58 2 10s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 8.5L9 11V6h1.5v4.5l4 2.5-1 1.5z"/>
                            </svg>
                            <span>FSC Certified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">Our Stationery Products</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Letterheads -->
                <a href="/stationery/letterheads" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1516387938699-a93023642d81?w=400&h=400&fit=crop" alt="Letterheads" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Letterheads</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Professional letterheads that make a lasting impression.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Envelopes -->
                <a href="/stationery/envelopes" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=400&fit=crop" alt="Envelopes" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Envelopes</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Custom printed envelopes for correspondence.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Notepads -->
                <a href="/stationery/notepads" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586210579191-33b45e38fa8c?w=400&h=400&fit=crop" alt="Notepads" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Notepads</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Custom branded notepads for office or promotional use.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Folders -->
                <a href="/stationery/folders" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400&h=400&fit=crop" alt="Folders" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Folders</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Professional presentation folders for document organization.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Notebooks -->
                <a href="/stationery/notebooks" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507842741343-583f20270319?w=400&h=400&fit=crop" alt="Notebooks" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Notebooks</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Premium branded notebooks for executives and clients.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Sticky Notes -->
                <a href="/stationery/sticky-notes" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                        <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-50 flex items-center justify-center p-8 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b3f4?w=400&h=400&fit=crop" alt="Sticky Notes" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Sticky Notes</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-1">Custom sticky notes for branding and office use.</p>
                            <div class="flex items-center gap-2 text-blue-600 font-semibold text-sm">
                                <span>Explore</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Information Section -->
    <section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Why Choose Our Stationery?</h2>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Professional quality on every product</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Eco-friendly and sustainable materials</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Quick turnaround times</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Competitive pricing with volume discounts</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Use Cases</h2>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Corporate and business branding</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Marketing and promotional campaigns</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Office and desk organization</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Trade shows and corporate events</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
