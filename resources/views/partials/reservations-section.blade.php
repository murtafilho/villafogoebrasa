<!-- Reservations Section -->
<section id="reservas" class="py-24 lg:py-32 bg-villa-espresso texture-overlay relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Content -->
            <div>
                <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-4">Reservas</p>
                <h2 class="font-display text-4xl lg:text-5xl font-semibold text-villa-cream mb-6 line-accent">
                    Reserve sua<br>Experiência
                </h2>
                <p class="text-villa-cream/70 mb-8 leading-relaxed">
                    Garanta seu lugar para uma experiência gastronômica inesquecível.
                    Para grupos acima de 10 pessoas ou eventos privativos, entre em contato
                    diretamente conosco.
                </p>

                <!-- Contact Info -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-villa-ember/20 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-5 h-5 text-villa-ember"></i>
                        </div>
                        <div>
                            <p class="text-villa-cream/60 text-sm">Telefone</p>
                            <p class="text-villa-cream font-display text-lg">55 31 985528192</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-villa-ember/20 flex items-center justify-center shrink-0">
                            <i data-lucide="clock" class="w-5 h-5 text-villa-ember"></i>
                        </div>
                        <div>
                            <p class="text-villa-cream/60 text-sm">Horário de Funcionamento</p>
                            <p class="text-villa-cream font-display text-lg">Ter-Dom: 11h às 23h</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-villa-coffee/30 p-8 lg:p-10 border border-villa-coffee/50">
                <form id="reservationForm" class="space-y-6" action="#" method="POST">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Nome Completo</label>
                            <input type="text" name="name" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors" placeholder="Seu nome">
                        </div>
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Telefone</label>
                            <input type="tel" name="phone" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors" placeholder="(31) 99999-9999">
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Data</label>
                            <input type="date" name="date" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Horário</label>
                            <select name="time" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors">
                                <option>12:00</option>
                                <option>13:00</option>
                                <option>14:00</option>
                                <option>19:00</option>
                                <option>20:00</option>
                                <option>21:00</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-2">Número de Pessoas</label>
                        <select name="guests" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors">
                            <option>2 pessoas</option>
                            <option>3 pessoas</option>
                            <option>4 pessoas</option>
                            <option>5 pessoas</option>
                            <option>6 pessoas</option>
                            <option>7+ pessoas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-2">Observações</label>
                        <textarea name="notes" rows="3" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors resize-none" placeholder="Ocasião especial, preferências..."></textarea>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                        <span>Confirmar Reserva</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        // Format date to Brazilian format if possible
        let dateStr = data.date;
        if (dateStr) {
            const [year, month, day] = dateStr.split('-');
            dateStr = `${day}/${month}/${year}`;
        }

        // TODO: Implementar envio de reserva via backend
        alert('Reserva enviada com sucesso! Entraremos em contato em breve.');
    });
</script>
