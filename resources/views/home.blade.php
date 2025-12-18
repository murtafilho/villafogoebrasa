@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Video/Image Placeholder -->
        <div class="absolute inset-0 bg-gradient-to-br from-villa-espresso via-villa-charcoal to-black">
            <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('{{ asset('img/cardapio/costelao.jpg') }}');"></div>
            <div class="hero-overlay absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-6 max-w-5xl mx-auto">
            <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-6 opacity-0 animate-fadeInUp">
                Churrascaria Premium em Nova Lima
            </p>

            <div class="mb-6 opacity-0 animate-fadeInUp stagger-1">
                <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="h-32 md:h-44 lg:h-56 w-auto mx-auto opacity-80 drop-shadow-[0_0_35px_rgba(217,83,30,0.7)]">
            </div>

            <p class="font-body text-lg md:text-xl text-villa-cream/70 max-w-2xl mx-auto mb-10 opacity-0 animate-fadeInUp stagger-2">
                Uma experiência gastronômica única onde tradição e sofisticação se encontram.
                Carnes nobres preparadas com maestria no calor da brasa.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 opacity-0 animate-fadeInUp stagger-3">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                            <span>Administrar</span>
                            <i data-lucide="settings" class="w-4 h-4 group-hover:rotate-90 transition-transform"></i>
                        </a>
                    @else
                        <a href="#reservas" class="group inline-flex items-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                            <span>Reserve sua Mesa</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    @endif
                @else
                    <a href="#reservas" class="group inline-flex items-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                        <span>Reserve sua Mesa</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @endauth
                <a href="{{ route('cardapio') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                    <span>Confira nosso Cardápio</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 opacity-0 animate-fadeInUp stagger-4">
            <a href="#about" class="flex flex-col items-center gap-2 text-villa-cream/50 hover:text-villa-gold transition-colors">
                <span class="text-xs tracking-widest uppercase">Descubra</span>
                <i data-lucide="chevron-down" class="w-5 h-5 animate-bounce"></i>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 lg:py-32 bg-villa-espresso texture-overlay relative overflow-hidden">
        <!-- Decorative Element - hidden on mobile to prevent overflow -->
        <div class="hidden lg:block absolute top-0 right-0 w-96 h-96 bg-villa-ember/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="relative pb-8">
                    <div class="aspect-[4/5] bg-villa-coffee overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558030006-450675393462?w=800" alt="Churrasqueiro preparando carnes" class="w-full h-full object-cover opacity-90 hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 right-0 lg:-right-12 bg-villa-ember p-6 lg:p-8 shadow-2xl shadow-orange-600/50">
                        <p class="font-display text-3xl lg:text-4xl font-semibold text-white">Tradição</p>
                        <p class="text-white/80 text-sm tracking-wider uppercase">Gaúcha</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:pl-8">
                    <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-4">Quem Somos</p>
                    <h2 class="font-display text-4xl lg:text-5xl font-semibold text-villa-cream mb-6 line-accent">
                        Raízes Gaúchas,<br>Alma Mineira
                    </h2>
                    <div class="space-y-4 text-villa-cream/70 leading-relaxed">
                        <p>
                            O Villa Fogo & Brasa nasce da paixão pelo autêntico churrasco gaúcho — uma
                            tradição centenária que celebra o encontro, a hospitalidade e o respeito pelo fogo.
                            Trazemos para Nova Lima a essência da Serra Gaúcha: cortes nobres preparados com
                            a técnica ancestral do fogo de chão.
                        </p>
                        <p>
                            Aqui, o ritual do churrasco é levado a sério. Nossos churrasqueiros dominam a arte
                            de domar o fogo, transformando cada corte em uma experiência que honra gerações
                            de tradição sulista com o calor da hospitalidade mineira.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-2 gap-6 mt-10">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-12 h-12 bg-villa-ember/20 flex items-center justify-center">
                                <i data-lucide="flame" class="w-6 h-6 text-villa-ember"></i>
                            </div>
                            <div>
                                <h4 class="font-display text-lg text-villa-cream mb-1">Fogo Natural</h4>
                                <p class="text-sm text-villa-cream/60">Carvão e lenha selecionados</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-12 h-12 bg-villa-ember/20 flex items-center justify-center">
                                <i data-lucide="award" class="w-6 h-6 text-villa-ember"></i>
                            </div>
                            <div>
                                <h4 class="font-display text-lg text-villa-cream mb-1">Cortes Nobres</h4>
                                <p class="text-sm text-villa-cream/60">Carnes certificadas premium</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    @include('partials.experience-section')

    <!-- Gallery Section -->
    @include('partials.gallery-section')

    <!-- Reservations Section -->
    @include('partials.reservations-section')

    <!-- Contact Section -->
    @include('partials.contact-section')
@endsection
