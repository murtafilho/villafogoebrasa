@extends('layouts.app')

@section('title', 'Cardápio - Villa Fogo & Brasa')

@section('content')
<section class="py-24 lg:py-32 bg-villa-charcoal texture-overlay relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-4">Nosso Cardápio</p>
            <h1 class="font-display text-4xl lg:text-5xl font-semibold text-villa-cream mb-6 line-accent">
                Cardápio Completo
            </h1>
            <p class="text-villa-cream/70">
                Uma seleção cuidadosa dos melhores pratos e bebidas, preparados com excelência para proporcionar uma experiência gastronômica única.
            </p>
        </div>

        <!-- Menu Items by Category -->
        <div class="space-y-16">
            @foreach($menuData as $categoria => $itens)
                <div class="mb-16">
                    <h2 class="font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-8 line-accent">
                        {{ $categoria }}
                    </h2>
                    
                    @php
                        // Agrupar por subcategoria se existir
                        $groupedItems = [];
                        foreach ($itens as $item) {
                            $subcat = !empty($item['subcategoria']) ? $item['subcategoria'] : '_sem_subcategoria';
                            if (!isset($groupedItems[$subcat])) {
                                $groupedItems[$subcat] = [];
                            }
                            $groupedItems[$subcat][] = $item;
                        }
                    @endphp
                    
                    @foreach($groupedItems as $subcategoria => $subItems)
                        @if($subcategoria !== '_sem_subcategoria')
                            <h3 class="font-display text-xl font-medium text-villa-gold mb-4 mt-8">
                                {{ $subcategoria }}
                            </h3>
                        @endif
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 {{ $subcategoria !== '_sem_subcategoria' ? 'mb-8' : '' }}">
                            @foreach($subItems as $item)
                                <div class="bg-villa-espresso/50 p-6 border border-villa-coffee/30 hover:border-villa-ember/50 transition-all card-hover">
                                    <div class="flex justify-between items-start mb-3 gap-4">
                                        <h3 class="font-display text-xl text-villa-cream flex-1">{{ $item['nome'] }}</h3>
                                        @if(!empty($item['preco']))
                                            <span class="text-villa-gold font-display text-xl shrink-0">R$ {{ $item['preco'] }}</span>
                                        @endif
                                    </div>
                                    @if(!empty($item['descricao']))
                                        <p class="text-villa-cream/60 text-sm leading-relaxed">{{ $item['descricao'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

