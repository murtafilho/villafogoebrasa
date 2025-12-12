<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') - Villa Fogo & Brasa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gray-100 font-body">
    <!-- Desktop Sidebar -->
    <aside class="hidden lg:block fixed inset-y-0 left-0 z-50 w-64 bg-villa-charcoal text-villa-cream">
        <div class="flex items-center justify-center h-16 border-b border-villa-espresso">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-heading font-bold text-villa-gold">
                Villa Admin
            </a>
        </div>

        <nav class="mt-6 px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-villa-espresso">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-villa-ember flex items-center justify-center">
                    <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-villa-cream">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-villa-cream/60">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-villa-cream/80 hover:text-villa-ember transition-colors">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Sair</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-drawer" class="lg:hidden fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div id="drawer-backdrop" class="absolute inset-0 bg-black/50"></div>

        <!-- Drawer Content -->
        <div class="absolute bottom-16 left-0 right-0 bg-villa-charcoal border-t border-villa-espresso rounded-t-2xl p-6 transform transition-transform">
            <!-- User Info -->
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-villa-espresso">
                <div class="w-12 h-12 rounded-full bg-villa-ember flex items-center justify-center">
                    <span class="text-white text-lg font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <p class="text-base font-medium text-villa-cream">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-villa-cream/60">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="space-y-2">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                    <i data-lucide="globe" class="w-5 h-5"></i>
                    <span>Ver Site</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-ember transition-colors">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Desktop Top Bar -->
        <header class="hidden lg:flex h-16 bg-white shadow-sm items-center justify-between px-6">
            <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>

            <a href="{{ url('/') }}" target="_blank" class="text-sm text-gray-600 hover:text-villa-ember transition-colors flex items-center gap-1">
                <i data-lucide="external-link" class="w-4 h-4"></i>
                Ver Site
            </a>
        </header>

        <!-- Page Content -->
        <main class="p-4 lg:p-6 pb-24 lg:pb-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Mobile Page Title -->
            <h1 class="lg:hidden text-xl font-semibold text-gray-800 mb-4">@yield('header', 'Dashboard')</h1>

            @yield('content')
        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-villa-charcoal border-t border-villa-espresso safe-area-bottom">
        <div class="flex justify-around items-center py-3">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 px-4 py-1 {{ request()->routeIs('admin.dashboard') ? 'text-villa-gold' : 'text-villa-cream/70' }} hover:text-villa-gold transition-colors">
                <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                <span class="text-xs">Dashboard</span>
            </a>
            <button id="menu-toggle" class="flex flex-col items-center gap-1 px-4 py-1 text-villa-cream/70 hover:text-villa-gold transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
                <span class="text-xs">Menu</span>
            </button>
        </div>
    </nav>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    @stack('scripts')

    <script>
        lucide.createIcons();

        // Mobile drawer toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const drawerBackdrop = document.getElementById('drawer-backdrop');

        if (menuToggle && mobileDrawer) {
            menuToggle.addEventListener('click', () => {
                mobileDrawer.classList.toggle('hidden');
            });

            drawerBackdrop.addEventListener('click', () => {
                mobileDrawer.classList.add('hidden');
            });
        }
    </script>
</body>
</html>
