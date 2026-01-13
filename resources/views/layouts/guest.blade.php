<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('site.name'))</title>
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="@yield('description', 'Login or register to access your ' . config('site.name') . ' account')">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-gray-50">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        // Pass Laravel session data to JavaScript
        window.toastData = {
            success: @json(session('success')),
            error: @json(session('error')),
            errors: @json($errors->all())
        };
    </script>

    @stack('scripts')
</body>
</html>
