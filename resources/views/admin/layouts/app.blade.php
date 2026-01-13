<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') Chapakhana</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .sidebar-link {
            transition: all 0.2s;
        }
        .sidebar-link:hover {
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background: linear-gradient(to right, #3B82F6, #2563EB);
        }

        @yield('styles')
    </style>
</head>
<body class="bg-gray-50">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    @php
                        $headerSection = \App\Models\PageSection::where('page', 'header')
                            ->where('section_key', 'main')
                            ->first();
                        $logo = $headerSection?->content['logo'] ?? null;
                    @endphp
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ config('site.name') }}" class="h-10 w-auto">
                    @else
                        <img src="{{ asset('logo.png') }}" alt="{{ config('site.name') }}" class="h-10 w-auto">
                    @endif
                </a>
            </div>

            <div class="flex items-center gap-4">
                <a href="/" target="_blank" class="hidden md:flex items-center gap-2 text-gray-700 hover:text-gray-900 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>View Site</span>
                </a>

                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline text-sm text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    @include('components.delete-modal')

    <script>
        // Pass Laravel session data to JavaScript
        window.toastData = {
            success: @json(session('success')),
            error: @json(session('error')),
            errors: @json($errors->all())
        };
    </script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
