<nav id="navbar" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; background-color: rgba(26, 23, 20, 0.95); backdrop-filter: blur(12px);">
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">

            <!-- Desktop Menu -->
            <div class="desktop-menu" style="display: none;">
                <a href="{{ url('/') }}#home" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Início</a>
                <a href="{{ url('/') }}#about" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Quem Somos</a>
                <a href="{{ url('/cardapio') }}" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Cardápio</a>
                <a href="{{ url('/') }}#experience" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Experiência</a>
                <a href="{{ url('/') }}#gallery" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Galeria</a>
                <a href="{{ url('/') }}#contact" class="nav-link" style="color: #f5f0e8; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; margin: 0 16px;">Contato</a>
            </div>

            <!-- Desktop CTA -->
            <div class="desktop-cta" style="display: none; align-items: center; gap: 16px;">
                <a href="{{ url('/') }}#reservas" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #c45c26; color: white; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; border-radius: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Reservar Mesa
                </a>
                @auth
                <div class="user-menu" style="position: relative;">
                    <button id="user-menu-btn" onclick="toggleUserMenu()" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; background-color: rgba(196, 92, 38, 0.2); border: 1px solid rgba(196, 92, 38, 0.4); border-radius: 4px; color: #f5f0e8; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ auth()->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="transition: transform 0.3s;" id="user-menu-arrow">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="user-menu-dropdown" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; background-color: #1a1714; border: 1px solid #3d352e; border-radius: 8px; min-width: 200px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); z-index: 1000; overflow: hidden;">
                        <div style="padding: 12px 16px; border-bottom: 1px solid #3d352e;">
                            <div style="color: #f5f0e8; font-size: 14px; font-weight: 500;">{{ auth()->user()->name }}</div>
                            <div style="color: #c45c26; font-size: 12px; margin-top: 4px;">{{ auth()->user()->email }}</div>
                        </div>
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 8px; padding: 12px 16px; color: #f5f0e8; font-size: 14px; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(196, 92, 38, 0.2)'" onmouseout="this.style.backgroundColor='transparent'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Painel Admin</span>
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 12px 16px; color: #f5f0e8; font-size: 14px; text-align: left; background: none; border: none; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(196, 92, 38, 0.2)'" onmouseout="this.style.backgroundColor='transparent'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Sair</span>
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" style="color: #c45c26; text-decoration: none;" title="Login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </a>
                @endauth
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
            <a href="{{ url('/') }}#home" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Início</a>
            <a href="{{ url('/') }}#about" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Quem Somos</a>
            <a href="{{ url('/cardapio') }}" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Cardápio</a>
            <a href="{{ url('/') }}#experience" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Experiência</a>
            <a href="{{ url('/') }}#gallery" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Galeria</a>
            <a href="{{ url('/') }}#contact" onclick="closeMobileMenu()" style="display: block; padding: 12px 16px; color: #f5f0e8; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;">Contato</a>

            <div style="padding-top: 16px; margin-top: 16px; border-top: 1px solid #3d352e;">
                <a href="{{ url('/') }}#reservas" onclick="closeMobileMenu()" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 16px 24px; background-color: #c45c26; color: white; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-radius: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Reservar Mesa
                </a>
            </div>

            @auth
            <div style="padding-top: 16px; margin-top: 16px; border-top: 1px solid #3d352e;">
                <div style="padding: 12px 16px; background-color: rgba(196, 92, 38, 0.1); border-radius: 8px; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px; color: #f5f0e8; font-size: 16px; font-weight: 500; margin-bottom: 4px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <div style="color: #c45c26; font-size: 12px;">{{ auth()->user()->email }}</div>
                </div>
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" onclick="closeMobileMenu()" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 12px 16px; color: #f5f0e8; font-size: 14px; text-decoration: none; border-radius: 8px; background-color: rgba(196, 92, 38, 0.1); margin-bottom: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Painel Admin</span>
                </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="closeMobileMenu()" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 12px 16px; border: 2px solid #c45c26; color: #c45c26; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; background: transparent; border-radius: 8px; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sair
                    </button>
                </form>
            </div>
            @else
            <div style="padding-top: 8px;">
                <a href="{{ route('login') }}" onclick="closeMobileMenu()" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 12px 24px; border: 2px solid #c45c26; color: #c45c26; font-size: 16px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; border-radius: 8px; background: transparent;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Login
                </a>
            </div>
            @endauth
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
        #navbar > div > div {
            height: 96px !important;
        }
    }

    /* Tablet adjustments */
    @media (min-width: 640px) and (max-width: 1023px) {
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

function toggleUserMenu() {
    var dropdown = document.getElementById('user-menu-dropdown');
    var arrow = document.getElementById('user-menu-arrow');
    
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
        arrow.style.transform = 'rotate(180deg)';
    } else {
        dropdown.style.display = 'none';
        arrow.style.transform = 'rotate(0deg)';
    }
}

// Fechar dropdown ao clicar fora
document.addEventListener('click', function(event) {
    var userMenu = document.querySelector('.user-menu');
    var dropdown = document.getElementById('user-menu-dropdown');
    var arrow = document.getElementById('user-menu-arrow');
    
    if (userMenu && !userMenu.contains(event.target)) {
        dropdown.style.display = 'none';
        arrow.style.transform = 'rotate(0deg)';
    }
});
</script>
