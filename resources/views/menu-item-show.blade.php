@extends('layouts.app')

@section('title', $item->name . ' - Cardápio - Villa Fogo & Brasa')

@php
    $ogTitle = $item->name . ' - Villa Fogo & Brasa';
    $ogDescription = $item->description ?? 'Confira este prato especial do nosso cardápio.';
@endphp

@section('content')
<section class="py-24 lg:py-32 bg-villa-charcoal texture-overlay relative">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <div class="flex items-center gap-2 text-sm text-villa-cream/60">
                <a href="{{ route('cardapio') }}" class="hover:text-villa-gold transition-colors">Cardápio</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-villa-cream">{{ $item->name }}</span>
            </div>
        </nav>

        <!-- Item Content -->
        <div class="bg-villa-espresso/30 border border-villa-coffee/30 rounded-lg overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-8 p-6 lg:p-8">
                <!-- Image -->
                <div class="order-2 lg:order-1">
                    @if($imageUrl)
                        <div class="aspect-[4/3] rounded-lg overflow-hidden border border-villa-coffee/30 bg-villa-coffee/30">
                            <img src="{{ asset($imageUrl) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-[4/3] rounded-lg bg-villa-coffee/30 border border-villa-coffee/30 flex items-center justify-center">
                            <i data-lucide="utensils" class="w-24 h-24 text-villa-cream/30"></i>
                        </div>
                    @endif
                </div>

                <!-- Details -->
                <div class="order-1 lg:order-2 flex flex-col justify-center">
                    @if($item->is_featured)
                        <div class="flex items-center gap-2 mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-villa-gold fill-current"></i>
                            <span class="text-villa-gold text-sm font-medium uppercase tracking-wider">Indicação do Chef</span>
                        </div>
                    @endif

                    <h1 class="font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-4">
                        {{ $item->name }}
                    </h1>

                    @if($item->category)
                        <p class="text-villa-gold/70 text-sm uppercase tracking-wider mb-4">
                            {{ $item->category->name }}
                        </p>
                    @endif

                    @if($item->subcategory)
                        <p class="text-villa-cream/60 text-sm mb-4">
                            <span class="text-villa-cream/80">Subcategoria:</span> {{ $item->subcategory }}
                        </p>
                    @endif

                    @if($item->description)
                        <div class="mb-6">
                            <p class="text-villa-cream/80 leading-relaxed">
                                {{ $item->description }}
                            </p>
                        </div>
                    @endif

                    @if($item->price)
                        <div class="mt-auto pt-6 border-t border-villa-coffee/30">
                            <div class="flex items-baseline gap-2">
                                <span class="text-villa-cream/60 text-sm">Preço:</span>
                                <span class="text-villa-gold font-display text-3xl font-semibold">
                                    R$ {{ number_format($item->price, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('cardapio') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-villa-gold/60 hover:border-villa-gold text-villa-gold tracking-wider uppercase transition-all duration-300">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar ao Cardápio</span>
            </a>
            <a href="#reservas" class="inline-flex items-center gap-2 px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>Reservar Mesa</span>
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

