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
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ asset('Proposta_Comercial.html') }}" target="_blank" class="nav-link text-sm tracking-widest uppercase text-villa-ember hover:text-villa-flame transition-colors font-semibold">Proposta</a>
                    @endif
                @endauth
            </div>

            <!-- CTA Button -->
            <a href="#reservas" class="hidden lg:inline-flex items-center gap-2 px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white text-sm tracking-wider uppercase transition-all duration-300 ember-glow">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Reservar Mesa
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-villa-cream p-2">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden bg-villa-charcoal/98 backdrop-blur-lg border-t border-villa-coffee">
        <div class="px-6 py-8 space-y-6">
            <a href="#home" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Início</a>
            <a href="#about" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Quem Somos</a>
            <a href="#menu" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Cardápio</a>
            <a href="#experience" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Experiência</a>
            <a href="#gallery" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Galeria</a>
            <a href="#contact" class="block text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Contato</a>
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ asset('Proposta_Comercial.html') }}" target="_blank" class="block text-sm tracking-widest uppercase text-villa-ember hover:text-villa-flame transition-colors font-semibold">Proposta</a>
                @endif
            @endauth
            <a href="#reservas" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember text-white text-sm tracking-wider uppercase">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Reservar Mesa
            </a>
        </div>
    </div>
</nav>
