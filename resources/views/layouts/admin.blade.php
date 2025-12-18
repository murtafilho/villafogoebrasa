<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <nav class="mt-6 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.reservas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.reservas.*') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                <span>Reservas</span>
            </a>
            
            <!-- Cardápio e Serviços -->
            <div class="mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-villa-cream/60 uppercase tracking-wider">
                    Cardápio e Serviços
                </div>
                <div class="mt-1 space-y-1">
                    <a href="{{ route('admin.cardapio.categorias.index') }}" class="flex items-center gap-3 px-4 py-2 ml-4 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.cardapio.categorias.*') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                        <i data-lucide="folder" class="w-4 h-4"></i>
                        <span class="text-sm">Categorias</span>
                    </a>
                    <a href="{{ route('admin.cardapio.itens.index') }}" class="flex items-center gap-3 px-4 py-2 ml-4 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.cardapio.itens.*') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                        <span class="text-sm">Cardápio</span>
                    </a>
                </div>
            </div>
            
            <a href="{{ route('admin.galeria.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.galeria.*') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                <i data-lucide="image" class="w-5 h-5"></i>
                <span>Galeria</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors {{ request()->routeIs('admin.usuarios.*') ? 'bg-villa-espresso text-villa-gold' : '' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Usuários</span>
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
                <a href="{{ route('admin.reservas.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    <span>Reservas</span>
                </a>
                
                <!-- Cardápio e Serviços -->
                <div class="mt-2">
                    <div class="px-4 py-2 text-xs font-semibold text-villa-cream/60 uppercase tracking-wider">
                        Cardápio e Serviços
                    </div>
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.cardapio.categorias.index') }}" class="flex items-center gap-3 px-4 py-2 ml-4 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                            <i data-lucide="folder" class="w-4 h-4"></i>
                            <span class="text-sm">Categorias</span>
                        </a>
                        <a href="{{ route('admin.cardapio.itens.index') }}" class="flex items-center gap-3 px-4 py-2 ml-4 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                            <i data-lucide="utensils" class="w-4 h-4"></i>
                            <span class="text-sm">Cardápio</span>
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('admin.galeria.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                    <i data-lucide="image" class="w-5 h-5"></i>
                    <span>Galeria</span>
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-villa-cream/80 hover:bg-villa-espresso hover:text-villa-gold transition-colors">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Usuários</span>
                </a>

                <div class="border-t border-villa-espresso my-3"></div>

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

            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="text-sm text-gray-600 hover:text-villa-ember transition-colors flex items-center gap-1">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    Ver Site
                </a>

                <!-- User Menu -->
                <div class="relative">
                    <button id="admin-user-menu-btn" onclick="toggleAdminUserMenu()" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-villa-ember flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <svg id="admin-user-menu-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-gray-500 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="admin-user-menu-dropdown" class="hidden absolute right-0 top-full mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            <i data-lucide="home" class="w-4 h-4"></i>
                            <span>Ir para o Site</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                <span>Sair</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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

        // Admin user menu toggle
        function toggleAdminUserMenu() {
            const dropdown = document.getElementById('admin-user-menu-dropdown');
            const arrow = document.getElementById('admin-user-menu-arrow');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', function(event) {
            const userMenuBtn = document.getElementById('admin-user-menu-btn');
            const dropdown = document.getElementById('admin-user-menu-dropdown');
            const arrow = document.getElementById('admin-user-menu-arrow');
            
            if (userMenuBtn && dropdown && !userMenuBtn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    </script>
</body>
</html>
