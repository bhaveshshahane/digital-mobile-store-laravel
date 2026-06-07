<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'phoneKART')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen antialiased">

<header class="sticky top-0 z-50 w-full backdrop-blur-md bg-white/70 border-b border-slate-200 shadow-sm transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="bg-gradient-to-tr from-blue-600 to-cyan-500 text-white p-2 rounded-xl group-hover:rotate-12 transition-transform duration-300 shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-cyan-600">
                        phoneKART
                    </span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Home</a>
                <a href="{{ route('products.index') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Products</a>
                <a href="{{ route('about') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">About</a>
                <a href="{{ route('contact') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Contact</a>
            </nav>

            <!-- User Area -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Admin Dashboard</a>
                    @endif
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->fname) }}&background=eff6ff&color=2563eb" alt="User" class="w-8 h-8 rounded-full border border-blue-200">
                            {{ auth()->user()->fname }}
                        </button>
                    </div>
                    <a href="{{ route('cart.index') }}" class="relative text-slate-600 hover:text-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-rose-500 hover:text-rose-700 transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                        Sign In / Sign Up
                    </a>
                @endauth
            </div>
            
            <!-- Mobile Menu Button (Optional, not fully implemented for brevity) -->
            <div class="md:hidden flex items-center">
                <button class="text-slate-600 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    @if(session('error'))
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-md shadow-sm mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-rose-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-md shadow-sm mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>

<main class="flex-grow">
    @yield('content')
</main>

<footer class="bg-white border-t border-slate-200 mt-16 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-slate-500 text-sm">© {{ date('Y') }} phoneKART. All rights reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    };
</script>
@yield('scripts')
</body>
</html>
