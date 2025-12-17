<footer class="py-12 pb-24 lg:pb-12 bg-black/50 border-t border-villa-coffee/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <!-- Logo -->
            <img src="{{ asset('img/logo.webp') }}" alt="Villa Fogo & Brasa" class="h-12 w-auto opacity-80">

            <!-- Links -->
            <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
                <a href="#home" class="text-villa-cream/60 hover:text-villa-gold text-xs sm:text-sm tracking-wider uppercase transition-colors">Início</a>
                <a href="{{ url('/cardapio') }}" class="text-villa-cream/60 hover:text-villa-gold text-xs sm:text-sm tracking-wider uppercase transition-colors">Cardápio</a>
                <a href="#reservas" class="text-villa-cream/60 hover:text-villa-gold text-xs sm:text-sm tracking-wider uppercase transition-colors">Reservas</a>
                <a href="#contact" class="text-villa-cream/60 hover:text-villa-gold text-xs sm:text-sm tracking-wider uppercase transition-colors">Contato</a>
            </div>

            <!-- Copyright -->
            <p class="text-villa-cream/40 text-sm">
                © {{ date('Y') }} Villa Fogo & Brasa. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>
