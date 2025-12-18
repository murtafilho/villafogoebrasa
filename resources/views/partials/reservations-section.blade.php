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
                <form id="reservationForm" class="space-y-6" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Nome Completo *</label>
                            <input type="text" name="name" required class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors" placeholder="Seu nome">
                        </div>
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">E-mail *</label>
                            <input type="email" name="email" required class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors" placeholder="seu@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-2">Telefone *</label>
                        <input type="tel" name="phone" required class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors" placeholder="(31) 99999-9999">
                    </div>
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Data *</label>
                            <input type="date" name="date" required min="{{ date('Y-m-d') }}" class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-villa-cream/60 text-sm mb-2">Horário *</label>
                            <select name="time" required class="w-full bg-black text-white text-lg border border-villa-coffee focus:border-villa-ember px-4 py-3 outline-none transition-colors">
                                <option value="">Selecione</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-2">Número de Pessoas *</label>
                        <select name="guests" required class="w-full bg-black text-white text-lg border border-villa-coffee focus:border-villa-ember px-4 py-3 outline-none transition-colors">
                            <option value="">Selecione</option>
                            <option value="2 pessoas">2 pessoas</option>
                            <option value="3 pessoas">3 pessoas</option>
                            <option value="4 pessoas">4 pessoas</option>
                            <option value="5 pessoas">5 pessoas</option>
                            <option value="6 pessoas">6 pessoas</option>
                            <option value="7 pessoas">7+ pessoas</option>
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
        
        const form = this;
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        // Desabilitar botão e mostrar loading
        submitButton.disabled = true;
        submitButton.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i> <span>Enviando...</span>';
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirecionar para página de confirmação
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else {
                    alert(data.message || 'Reserva enviada com sucesso! Entraremos em contato em breve.');
                    form.reset();
                }
            } else {
                let errorMessage = 'Erro ao enviar reserva. ';
                if (data.errors) {
                    const errors = Object.values(data.errors).flat();
                    errorMessage += errors.join(' ');
                } else if (data.message) {
                    errorMessage += data.message;
                }
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erro ao enviar reserva. Por favor, tente novamente ou entre em contato pelo telefone.');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    });
</script>
