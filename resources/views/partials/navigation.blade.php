<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-villa-charcoal/95 backdrop-blur-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20 lg:h-24">

            <!-- Logo (visible on all screens) -->
            <a href="#home" class="flex-shrink-0">
                <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="h-8 sm:h-10 lg:h-12 w-auto">
            </a>

            <!-- Desktop Menu (hidden on mobile) -->
            <div class="hidden lg:flex items-center gap-8 xl:gap-10">
                <a href="#home" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Início</a>
                <a href="#about" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Quem Somos</a>
                <a href="#menu" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Cardápio</a>
                <a href="#experience" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Experiência</a>
                <a href="#gallery" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Galeria</a>
                <a href="#contact" class="nav-link text-sm tracking-widest uppercase text-villa-cream/90 hover:text-villa-gold transition-colors">Contato</a>
            </div>

            <!-- Desktop CTA Button (hidden on mobile) -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="#reservas" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white text-sm tracking-wider uppercase transition-all duration-300 ember-glow rounded">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Reservar Mesa
                </a>
                @guest
                    <a href="{{ route('login') }}" class="text-villa-ember hover:text-villa-flame transition-colors" title="Login">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </a>
                @endguest
            </div>

            <!-- Mobile Menu Button (visible only on mobile) -->
            <button
                id="mobile-menu-btn"
                class="lg:hidden flex items-center justify-center w-12 h-12 rounded-lg bg-villa-ember/20 hover:bg-villa-ember/30 transition-colors"
                onclick="toggleMobileMenu()"
                aria-label="Menu"
            >
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Panel -->
    <div id="mobile-menu" class="lg:hidden hidden">
        <div class="bg-villa-charcoal border-t border-villa-coffee shadow-2xl">
            <div class="px-4 py-6 space-y-4">
                <a href="#home" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Início</a>
                <a href="#about" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Quem Somos</a>
                <a href="#menu" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Cardápio</a>
                <a href="#experience" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Experiência</a>
                <a href="#gallery" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Galeria</a>
                <a href="#contact" onclick="closeMobileMenu()" class="block py-3 px-4 text-base tracking-widest uppercase text-villa-cream hover:text-villa-gold hover:bg-villa-coffee/50 rounded-lg transition-colors">Contato</a>

                <div class="pt-4 border-t border-villa-coffee">
                    <a href="#reservas" onclick="closeMobileMenu()" class="flex items-center justify-center gap-2 w-full py-4 px-6 bg-villa-ember hover:bg-villa-flame text-white text-base tracking-wider uppercase rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Reservar Mesa
                    </a>
                </div>

                @guest
                <div class="pt-2">
                    <a href="{{ route('login') }}" onclick="closeMobileMenu()" class="flex items-center justify-center gap-2 w-full py-3 px-6 border-2 border-villa-ember text-villa-ember hover:bg-villa-ember hover:text-white text-base tracking-wider uppercase rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Login
                    </a>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    menu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
}

function closeMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    menu.classList.add('hidden');
    menuIcon.classList.remove('hidden');
    closeIcon.classList.add('hidden');
}
</script>
