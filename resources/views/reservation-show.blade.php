@extends('layouts.app')

@section('title', 'Confirmação de Reserva - Villa Fogo & Brasa')

@php
    // Função para formatar telefone no formato (31) 984182096
    function formatPhone($phone) {
        // Remove tudo que não é número
        $phone = preg_replace('/\D/', '', $phone);
        
        // Se tiver 11 dígitos (com DDD e 9º dígito) - formato (31) 984182096
        if (strlen($phone) == 11) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2);
        }
        // Se tiver 10 dígitos (com DDD sem 9º dígito) - formato (31) 34182096
        elseif (strlen($phone) == 10) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2);
        }
        // Retorna original se não conseguir formatar
        return $phone;
    }
    
    $formattedPhone = formatPhone($reservation->phone);
@endphp

@section('content')
<section class="py-24 lg:py-32 bg-villa-charcoal texture-overlay relative">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-500/20 rounded-full mb-6">
                <i data-lucide="check-circle" class="w-12 h-12 text-green-500"></i>
            </div>
            <h1 class="font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-4">
                Reserva Recebida!
            </h1>
            <p class="text-villa-cream/70 text-lg">
                Entraremos em contato para confirmação da sua reserva.
            </p>
        </div>

        <!-- Reservation Details Card -->
        <div class="bg-villa-espresso/30 border border-villa-coffee/30 rounded-lg overflow-hidden mb-8">
            <div class="p-6 lg:p-8">
                <div class="mb-6 pb-6 border-b border-villa-coffee/30">
                    <h2 class="font-display text-2xl font-semibold text-villa-cream mb-2">Detalhes da Reserva</h2>
                    <p class="text-villa-gold/70 text-sm">Número da reserva: #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Nome -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">Nome Completo</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $reservation->name }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">E-mail</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $reservation->email }}</p>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">Telefone</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $formattedPhone }}</p>
                    </div>

                    <!-- Data -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">Data</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $reservation->date->format('d/m/Y') }}</p>
                    </div>

                    <!-- Horário -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">Horário</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $reservation->time }}</p>
                    </div>

                    <!-- Número de Pessoas -->
                    <div>
                        <label class="block text-villa-cream/60 text-sm mb-1">Número de Pessoas</label>
                        <p class="text-villa-cream font-medium text-lg">{{ $reservation->guests }} {{ $reservation->guests == 1 ? 'pessoa' : 'pessoas' }}</p>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-villa-cream/60 text-sm mb-1">Status</label>
                        <span class="inline-block px-4 py-2 bg-yellow-500/20 text-yellow-400 rounded-lg font-medium">
                            {{ $reservation->status_label }}
                        </span>
                    </div>

                    @if($reservation->occasion)
                        <!-- Ocasião -->
                        <div class="md:col-span-2">
                            <label class="block text-villa-cream/60 text-sm mb-1">Ocasião</label>
                            <p class="text-villa-cream font-medium">{{ $reservation->occasion }}</p>
                        </div>
                    @endif

                    @if($reservation->notes)
                        <!-- Observações -->
                        <div class="md:col-span-2">
                            <label class="block text-villa-cream/60 text-sm mb-1">Observações</label>
                            <p class="text-villa-cream/80 leading-relaxed">{{ $reservation->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-villa-coffee/20 border border-villa-coffee/30 rounded-lg p-6 mb-8">
            <h3 class="font-display text-xl font-semibold text-villa-cream mb-4">Informações de Contato</h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <i data-lucide="phone" class="w-5 h-5 text-villa-ember shrink-0"></i>
                    <div>
                        <p class="text-villa-cream/60 text-sm">Telefone</p>
                        <p class="text-villa-cream font-medium">(31) 98552-8192</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <i data-lucide="clock" class="w-5 h-5 text-villa-ember shrink-0"></i>
                    <div>
                        <p class="text-villa-cream/60 text-sm">Horário de Funcionamento</p>
                        <p class="text-villa-cream font-medium">Ter-Dom: 11h às 23h</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('cardapio') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-villa-gold/60 hover:border-villa-gold text-villa-gold tracking-wider uppercase transition-all duration-300">
                <i data-lucide="utensils" class="w-4 h-4"></i>
                <span>Ver Cardápio</span>
            </a>
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Voltar ao Início</span>
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endpush
@endsection

