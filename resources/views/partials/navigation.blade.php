<nav id="navbar" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; background-color: rgba(26, 23, 20, 0.95); backdrop-filter: blur(12px);">
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">

            <!-- Logo -->
            <a href="#home" style="flex-shrink: 0;">
                <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" style="height: 32px; width: auto;">
            </a>

            <!-- Desktop Menu -->
            <div class="desktop-menu" style="display: none;">
                <a href="#home" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Início</a>
                <a href="#about" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Quem Somos</a>
                <a href="#menu" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Cardápio</a>
                <a href="#experience" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Experiência</a>
                <a href="#gallery" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Galeria</a>
                <a href="#contact" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Contato</a>
            </div>

            <!-- Desktop CTA -->
            <div class="desktop-cta" style="display: none; align-items: center; gap: 16px;">
                <a href="#reservas" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #c45c26; color: white; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; border-radius: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Reservar Mesa
                </a>
                @guest
                <a href="{{ route('login') }}" style="color: #c45c26; text-decoration: none;" title="Login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </a>
                @endguest
            </div>

            <!-- Mobile Menu Button - ALWAYS VISIBLE ON MOBILE -->
            <button
                id="mobile-menu-btn"
                onclick="toggleMobileMenu()"
                aria-label="Menu"
                style="display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; background-color: rgba(196, 92, 38, 0.3); border: none; border-radius: 8px; cursor: pointer;"
            >
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8" stroke-width="2" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Panel -->
    <div id="mobile-menu" style="display: none; background-color: #1a1714; border-top: 1px solid #3d352e;">
        <div style="padding: 24px 16px;">
            <a href="#home" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Início</a>
            <a href="#about" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Quem Somos</a>
            <a href="#menu" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Cardápio</a>
            <a href="#experience" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Experiência</a>
            <a href="#gallery" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Galeria</a>
            <a href="#contact" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Contato</a>

            <div style="padding-top: 16px; margin-top: 16px; border-top: 1px solid #3d352e;">
                <a href="#reservas" onclick="closeMobileMenu()" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 16px 24px; background-color: #c45c26; color: white; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-radius: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Reservar Mesa
                </a>
            </div>

            @guest
            <div style="padding-top: 8px;">
                <a href="{{ route('login') }}" onclick="closeMobileMenu()" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 12px 24px; border: 2px solid #c45c26; color: #c45c26; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-radius: 8px; background: transparent;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Login
                </a>
            </div>
            @endguest
        </div>
    </div>
</nav>

<style>
    /* Desktop styles - show desktop elements, hide mobile button at 1024px+ */
    @media (min-width: 1024px) {
        .desktop-menu {
            display: flex !important;
            align-items: center;
        }
        .desktop-cta {
            display: flex !important;
        }
        #mobile-menu-btn {
            display: none !important;
        }
        #mobile-menu {
            display: none !important;
        }
        #navbar img {
            height: 48px !important;
        }
        #navbar > div > div {
            height: 96px !important;
        }
    }

    /* Tablet adjustments */
    @media (min-width: 640px) and (max-width: 1023px) {
        #navbar img {
            height: 40px !important;
        }
        #navbar > div > div {
            height: 80px !important;
        }
    }
</style>

<script>
function toggleMobileMenu() {
    var menu = document.getElementById('mobile-menu');
    var menuIcon = document.getElementById('menu-icon');
    var closeIcon = document.getElementById('close-icon');

    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
        menuIcon.style.display = 'none';
        closeIcon.style.display = 'block';
    } else {
        menu.style.display = 'none';
        menuIcon.style.display = 'block';
        closeIcon.style.display = 'none';
    }
}

function closeMobileMenu() {
    var menu = document.getElementById('mobile-menu');
    var menuIcon = document.getElementById('menu-icon');
    var closeIcon = document.getElementById('close-icon');

    menu.style.display = 'none';
    menuIcon.style.display = 'block';
    closeIcon.style.display = 'none';
}
</script>
