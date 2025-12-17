<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Villa Fogo & Brasa - Churrascaria Premium em Nova Lima, MG. Autêntico churrasco gaúcho com cortes nobres e ambiente sofisticado.">
    <meta name="keywords" content="churrascaria, churrasco gaúcho, Nova Lima, carnes nobres, rodízio, restaurante premium">
    <title>@yield('title', 'Villa Fogo & Brasa - Churrascaria Premium em Nova Lima')</title>

    @if(config('app.env') !== 'production')
    <meta name="robots" content="noindex, nofollow">
    @endif

    <!-- Open Graph / Facebook / WhatsApp -->
    @php
        $pageTitle = trim(\Illuminate\Support\Facades\View::yieldContent('title'));
        $ogTitle = isset($ogTitle) ? $ogTitle : (!empty($pageTitle) ? $pageTitle : 'Villa Fogo & Brasa - Churrascaria Premium em Nova Lima');
        $ogDescription = isset($ogDescription) ? $ogDescription : 'Autêntico churrasco gaúcho com cortes nobres e ambiente sofisticado. Reserve sua mesa e viva uma experiência gastronômica única em Nova Lima!';
    @endphp
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:image" content="{{ url(asset('img/logo.webp')) }}">
    <meta property="og:image:secure_url" content="{{ url(asset('img/logo.webp')) }}">
    <meta property="og:image:type" content="image/webp">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Villa Fogo & Brasa - Churrascaria Premium em Nova Lima">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:locale:alternate" content="pt_PT">
    <meta property="og:site_name" content="Villa Fogo & Brasa">

    <!-- WhatsApp Specific -->
    <meta property="og:image:url" content="{{ url(asset('img/logo.webp')) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ url(asset('img/logo.webp')) }}">
    <meta name="twitter:image:alt" content="Villa Fogo & Brasa - Churrascaria Premium em Nova Lima">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#1a1714">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-villa-charcoal text-villa-cream font-body">
    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-villa-charcoal/95 backdrop-blur-lg border-t border-villa-gold/20 lg:hidden">
        <div class="flex justify-around items-center py-3">
            <a href="{{ url('/cardapio') }}" class="flex flex-col items-center gap-1 text-villa-cream/70 hover:text-villa-gold transition-colors">
                <i data-lucide="utensils" class="w-5 h-5"></i>
                <span class="text-xs">Menu</span>
            </a>
            <a href="{{ url('/') }}#reservas" class="flex flex-col items-center gap-1 text-villa-ember hover:text-villa-flame transition-colors">
                <i data-lucide="calendar" class="w-6 h-6"></i>
                <span class="text-xs font-medium">Reservas</span>
            </a>
            <a href="{{ url('/') }}#contact" class="flex flex-col items-center gap-1 text-villa-cream/70 hover:text-villa-gold transition-colors">
                <i data-lucide="phone" class="w-5 h-5"></i>
                <span class="text-xs">Contato</span>
            </a>
        </div>
    </nav>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    @stack('scripts')

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }

        // Navbar background on scroll
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.classList.add('bg-villa-charcoal/95', 'backdrop-blur-lg', 'shadow-lg');
            } else {
                navbar.classList.remove('bg-villa-charcoal/95', 'backdrop-blur-lg', 'shadow-lg');
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        // Observe elements with animation
        document.querySelectorAll('section > div').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });

        // Handle anchor links when coming from other pages
        if (window.location.hash) {
            const hash = window.location.hash;
            const targetElement = document.querySelector(hash);
            
            if (targetElement) {
                setTimeout(() => {
                    targetElement.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        }
    </script>
</body>
</html>
