<!-- Contact / Location Section -->
<section id="contact" class="py-24 lg:py-32 bg-villa-charcoal texture-overlay">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-4">Localização</p>
            <h2 class="font-display text-4xl lg:text-5xl font-semibold text-villa-cream mb-6 line-accent">
                Visite-nos
            </h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Map -->
            <div class="aspect-video lg:aspect-auto lg:h-full min-h-[400px] bg-villa-coffee overflow-hidden relative">
                @if(config('laravel-google-maps.key'))
                    {!! Mapper::map(-20.0902429, -43.9734027, [
                        'zoom' => 17,
                        'markers' => [
                            'title' => 'Villa Fogo & Brasa',
                            'animation' => 'DROP'
                        ]
                    ])->render() !!}
                @else
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1876.1!2d-43.9734027!3d-20.0902429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa6bb479b731b31%3A0x701a19e332e8b429!2sVILLA%20175!5e0!3m2!1spt-BR!2sbr!4v1733464800000!5m2!1spt-BR!2sbr"
                        width="100%"
                        height="100%"
                        style="border:0; filter: grayscale(80%) contrast(1.1);"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                @endif
                <!-- Route Button -->
                <a href="https://www.google.com/maps/dir/?api=1&destination=VILLA+175,+Av.+Quinta+Avenida,+175,+Vale+do+Sol,+Nova+Lima+MG"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="absolute bottom-4 right-4 inline-flex items-center gap-2 px-4 py-3 bg-villa-ember hover:bg-villa-flame text-white text-sm tracking-wider uppercase transition-all duration-300 shadow-lg">
                    <i data-lucide="navigation" class="w-4 h-4"></i>
                    <span>Como Chegar</span>
                </a>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <!-- Address -->
                <div class="flex gap-6">
                    <div class="w-14 h-14 bg-villa-ember/20 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="map-pin" class="w-6 h-6 text-villa-ember"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-xl text-villa-cream mb-2">Endereço</h4>
                        <p class="text-villa-cream/70">
                            Av. Quinta Avenida, 175<br>
                            Vale do Sol, Nova Lima - MG<br>
                            CEP: 34011-093
                        </p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex gap-6">
                    <div class="w-14 h-14 bg-villa-ember/20 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="phone" class="w-6 h-6 text-villa-ember"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-xl text-villa-cream mb-2">Telefone</h4>
                        <p class="text-villa-cream/70">
                            55 31 985528192
                        </p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="flex gap-6">
                    <div class="w-14 h-14 bg-villa-ember/20 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="clock" class="w-6 h-6 text-villa-ember"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-xl text-villa-cream mb-2">Horário</h4>
                        <p class="text-villa-cream/70">
                            Terça a Quinta: 11h às 22h<br>
                            Sexta e Sábado: 11h às 23h<br>
                            Domingo: 11h às 17h<br>
                            <span class="text-villa-ember">Segunda: Fechado</span>
                        </p>
                    </div>
                </div>

                <!-- Social -->
                <div class="pt-8 border-t border-villa-coffee/30">
                    <h4 class="font-display text-xl text-villa-cream mb-4">Redes Sociais</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 bg-villa-coffee/50 hover:bg-villa-ember flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="instagram" class="w-5 h-5 text-villa-cream"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-villa-coffee/50 hover:bg-villa-ember flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="facebook" class="w-5 h-5 text-villa-cream"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-villa-coffee/50 hover:bg-villa-ember flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="message-circle" class="w-5 h-5 text-villa-cream"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
