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
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen antialiased">

    <header
        class="sticky top-0 z-50 w-full backdrop-blur-md bg-white/70 border-b border-slate-200 shadow-sm transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('favicon.png') }}" alt="phoneKART"
                            class="w-10 h-10 group-hover:scale-110 transition-transform duration-300 drop-shadow-md">
                        <span
                            class="font-bold text-2xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-cyan-600">
                            phoneKART
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Home</a>
                    <a href="{{ route('products.index') }}"
                        class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Products</a>
                    @auth
                        <a href="{{ route('orders.my') }}"
                            class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">My
                            Orders</a>
                    @endauth
                    <a href="{{ route('about') }}"
                        class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">About</a>
                    <a href="{{ route('contact') }}"
                        class="text-slate-600 hover:text-blue-600 font-medium transition-colors duration-200">Contact</a>
                </nav>

                <!-- User Area -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                        @endphp
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Admin
                                Dashboard</a>
                        @endif
                        <a href="{{ route('cart.index') }}"
                            class="relative text-slate-600 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span id="desktop-cart-count" class="absolute -top-2 -right-2 bg-rose-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ $cartCount > 0 ? '' : 'hidden' }}">
                                {{ $cartCount }}
                            </span>
                        </a>
                        <!-- User Profile Dropdown -->
                        <div class="relative group" id="user-dropdown-container">
                            <button id="user-menu-btn"
                                class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->fname) }}&background=eff6ff&color=2563eb"
                                    alt="User" class="w-8 h-8 rounded-full border border-blue-200">
                                {{ auth()->user()->fname }}
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="user-menu-dropdown" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl shadow-blue-900/10 border border-slate-100 hidden flex-col py-2 z-50 transform origin-top-right transition-all">
                                <div class="px-4 py-3 border-b border-slate-100 mb-1">
                                    <p class="text-xs text-slate-500 mb-0.5">Signed in as</p>
                                    <p class="text-sm font-medium text-slate-800 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="px-2">
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-3 py-2 text-sm font-medium text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-xl transition-colors flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/40 transform hover:-translate-y-0.5 transition-all duration-200">
                            Sign In / Sign Up
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-blue-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white border-t border-slate-200 shadow-lg absolute w-full left-0">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Home</a>
                <a href="{{ route('products.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Products</a>
                @auth
                    <a href="{{ route('orders.my') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">My
                        Orders</a>
                @endauth
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">About</a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Contact</a>

                <div class="border-t border-slate-200 my-2"></div>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors">Admin
                            Dashboard</a>
                    @endif
                    <a href="{{ route('cart.index') }}"
                        class="px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-colors flex justify-between items-center">
                        Cart
                        <span id="mobile-cart-count" class="bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full {{ $cartCount > 0 ? '' : 'hidden' }}">
                            {{ $cartCount }}
                        </span>
                    </a>

                    <div class="block px-3 py-2 rounded-md text-base font-medium text-slate-700">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->fname) }}&background=eff6ff&color=2563eb"
                                alt="User" class="w-8 h-8 rounded-full border border-blue-200">
                            <span>{{ auth()->user()->fname }}</span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full text-center mt-4 px-6 py-2.5 border border-transparent text-base font-semibold rounded-lg text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-md transition-colors">
                        Sign In / Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </header>



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

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        // Mobile Menu Toggle & User Dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }

            const userBtn = document.getElementById('user-menu-btn');
            const userDropdown = document.getElementById('user-menu-dropdown');
            
            if (userBtn && userDropdown) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                
                document.addEventListener('click', (e) => {
                    if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            // Global AJAX Add to Cart handler
            $(document).on('submit', '.add-to-cart-form', function(e) {
                @guest
                // Do nothing if guest, the inline onsubmit will handle showing the toast
                return;
                @else
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();
                let btn = form.find('button[type="submit"]');
                let originalContent = btn.html();

                // Loading state
                btn.html('<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Adding...</span>');
                btn.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            if (response.cart_count > 0) {
                                $('#desktop-cart-count').text(response.cart_count).removeClass('hidden');
                                $('#mobile-cart-count').text(response.cart_count).removeClass('hidden');
                            }
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Something went wrong. Please try again.');
                    },
                    complete: function() {
                        btn.html(originalContent);
                        btn.prop('disabled', false);
                    }
                });
                @endguest
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
