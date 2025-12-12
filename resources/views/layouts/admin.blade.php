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
    <!-- Top Header -->
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-villa-charcoal shadow-lg">
        <div class="h-full max-w-7xl mx-auto px-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-heading font-bold text-villa-gold">
                Villa Admin
            </a>

            <!-- Page Title - Hidden on mobile -->
            <h1 class="hidden md:block text-lg font-semibold text-villa-cream">@yield('header', 'Dashboard')</h1>

            <!-- Right Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="text-sm text-villa-cream/80 hover:text-villa-gold transition-colors flex items-center gap-1">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Ver Site</span>
                </a>

                <!-- User Menu (Desktop) -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-villa-ember flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-villa-cream/80 hover:text-villa-ember transition-colors">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 pb-24 md:pb-8 px-4 max-w-7xl mx-auto">
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

        <!-- Page Title (Mobile) -->
        <h1 class="md:hidden text-xl font-semibold text-gray-800 mb-4">@yield('header', 'Dashboard')</h1>

        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-villa-charcoal border-t border-villa-espresso md:hidden">
        <div class="flex justify-around items-center py-2">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 px-4 py-2 {{ request()->routeIs('admin.dashboard') ? 'text-villa-gold' : 'text-villa-cream/70' }} hover:text-villa-gold transition-colors">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="text-xs">Dashboard</span>
            </a>
            <a href="{{ url('/') }}" target="_blank" class="flex flex-col items-center gap-1 px-4 py-2 text-villa-cream/70 hover:text-villa-gold transition-colors">
                <i data-lucide="globe" class="w-5 h-5"></i>
                <span class="text-xs">Ver Site</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <button type="submit" class="flex flex-col items-center gap-1 px-4 py-2 text-villa-cream/70 hover:text-villa-ember transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="text-xs">Sair</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    @stack('scripts')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
