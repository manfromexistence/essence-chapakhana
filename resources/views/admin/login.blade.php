<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Chapakhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gradient background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(180deg); }
        }
        
        /* Logo animation */
        .logo-container {
            animation: fadeInDown 0.8s ease-out;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Card animation */
        .login-card {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Toast Notification Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.4s ease-out, fadeOut 0.3s ease-in 4.7s forwards;
            backdrop-filter: blur(10px);
        }

        .toast-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .toast-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .toast-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 14px;
            opacity: 0.95;
        }

        .toast-close {
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .toast-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }

        @media (max-width: 640px) {
            .toast {
                right: 10px;
                left: 10px;
                min-width: auto;
                max-width: none;
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Toast Container -->
    <div id="toast-container"></div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Header -->
            <div class="text-center logo-container">
                <a href="/" class="inline-block mb-6">
                    @php
                        $headerSection = \App\Models\PageSection::where('page', 'header')
                            ->where('section_key', 'main')
                            ->first();
                        $logo = $headerSection?->content['logo'] ?? '/logo.png';
                    @endphp
                    <div class="bg-white rounded-2xl p-6 shadow-2xl inline-block">
                        <img src="{{ $logo }}" alt="Chapakhana" class="h-20 w-auto mx-auto">
                    </div>
                </a>
                <h2 class="mt-6 text-4xl font-bold text-white drop-shadow-lg">Admin Portal</h2>
                <p class="mt-3 text-lg text-white/90 drop-shadow">
                    Welcome back! Please sign in to continue
                </p>
            </div>

            <!-- Login Form -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 sm:p-10 login-card border border-white/20">
                <form class="space-y-6" action="{{ route('admin.login.post') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                                class="block w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-400"
                                placeholder="admin@chapakhana.com"
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="block w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-400"
                                placeholder="Enter your password"
                            >
                        </div>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded transition"
                            >
                            <label for="remember" class="ml-2 block text-sm font-medium text-gray-700">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center items-center gap-3 py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-xl"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign In to Dashboard
                        </button>
                    </div>
                </form>

                <!-- Back to Home -->
                <div class="mt-8 text-center">
                    <a href="/" class="inline-flex items-center gap-2 text-sm font-medium text-purple-600 hover:text-purple-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Homepage
                    </a>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Secure Admin Area
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toast Notification Function
        function showToast(message, type = 'success', title = '') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const isSuccess = type === 'success';
            const toastClass = isSuccess ? 'toast-success' : 'toast-error';
            const defaultTitle = isSuccess ? 'Success!' : 'Error!';
            const displayTitle = title || defaultTitle;

            // Success icon
            const successIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;

            // Error icon
            const errorIcon = `
                <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;

            toast.className = `toast ${toastClass}`;
            toast.innerHTML = `
                ${isSuccess ? successIcon : errorIcon}
                <div class="toast-content">
                    <div class="toast-title">${displayTitle}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 5000);
        }

        // Show toast on page load if there's a session message
        @if (session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif

        @if (session('error'))
            showToast('{{ session('error') }}', 'error', 'Login Failed');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showToast('{{ $error }}', 'error', 'Validation Error');
            @endforeach
        @endif
    </script>
</body>
</html>
