<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 lg:h-24">
            <!-- Mobile Logo -->
            <a href="#home" class="lg:hidden">
                <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="h-10 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-10">
                <a href="#home" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Início</a>
                <a href="#about" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Quem Somos</a>
                <a href="#menu" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Cardápio</a>
                <a href="#experience" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Experiência</a>
                <a href="#gallery" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Galeria</a>
                <a href="#contact" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Contato</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="#reservas" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white text-sm tracking-wider uppercase transition-all duration-300 ember-glow">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Reservar Mesa
                </a>
                @guest
                    <a href="{{ route('login') }}" class="text-villa-ember hover:text-villa-flame transition-colors" title="Login">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </a>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-villa-cream p-2" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden absolute top-20 left-0 right-0 bg-villa-charcoal border-t border-villa-coffee" style="z-index: 9999;">
        <div class="px-6 py-8 space-y-6">
            <a href="#home" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Início</a>
            <a href="#about" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Quem Somos</a>
            <a href="#menu" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Cardápio</a>
            <a href="#experience" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Experiência</a>
            <a href="#gallery" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Galeria</a>
            <a href="#contact" class="block text-sm tracking-widest uppercase text-villa-cream hover:text-villa-gold transition-colors">Contato</a>
            <a href="#reservas" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember text-white text-sm tracking-wider uppercase">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Reservar Mesa
            </a>
            @guest
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-villa-ember hover:text-villa-flame transition-colors">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                    <span class="text-sm tracking-widest uppercase">Login</span>
                </a>
            @endguest
        </div>
    </div>
</nav>
