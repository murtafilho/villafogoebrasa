@extends('layouts.app')

@section('title', 'Cardápio - Villa Fogo & Brasa')

@php
    $ogTitle = 'Cardápio Completo - Villa Fogo & Brasa';
    $ogDescription = 'Explore nosso cardápio completo com cortes nobres, pratos especiais, bebidas selecionadas e sobremesas. Autêntico churrasco gaúcho em Nova Lima.';
@endphp

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

        <!-- Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button 
                class="filter-btn px-6 py-2 bg-villa-ember text-white text-sm tracking-wider uppercase transition-all hover:bg-villa-flame active flex items-center gap-2" 
                data-filter="all"
            >
                <i data-lucide="grid" class="w-4 h-4"></i>
                <span>Todos</span>
            </button>
            @foreach($categories as $category)
                @php
                    $icon = \App\Http\Controllers\HomeController::getCategoryIcon($category);
                @endphp
                <button 
                    class="filter-btn px-6 py-2 border border-villa-coffee text-villa-cream/70 hover:border-villa-gold hover:text-villa-gold text-sm tracking-wider uppercase transition-all flex items-center gap-2" 
                    data-filter="{{ md5($category) }}"
                >
                    <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
                    <span>{{ $category }}</span>
                </button>
            @endforeach
        </div>

        <!-- Menu Items by Category -->
        <div class="space-y-16" id="menu-container">
            @foreach($menuData as $categoria => $itens)
                @php
                    $icon = \App\Http\Controllers\HomeController::getCategoryIcon($categoria);
                @endphp
                <div class="menu-category mb-16" data-category="{{ md5($categoria) }}">
                    <h2 class="font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-8 line-accent flex items-center gap-4">
                        <i data-lucide="{{ $icon }}" class="w-8 h-8 lg:w-10 lg:h-10 text-villa-ember"></i>
                        <span>{{ $categoria }}</span>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar ícones do Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    const filterButtons = document.querySelectorAll('.filter-btn');
    const menuCategories = document.querySelectorAll('.menu-category');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Atualizar estado dos botões
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-villa-ember', 'text-white');
                btn.classList.add('border', 'border-villa-coffee', 'text-villa-cream/70');
            });
            
            this.classList.add('active', 'bg-villa-ember', 'text-white');
            this.classList.remove('border', 'border-villa-coffee', 'text-villa-cream/70');
            
            // Filtrar categorias
            menuCategories.forEach(category => {
                const categoryId = category.getAttribute('data-category');
                
                if (filter === 'all' || categoryId === filter) {
                    category.style.display = 'block';
                    // Animação suave
                    category.style.opacity = '0';
                    setTimeout(() => {
                        category.style.transition = 'opacity 0.3s ease-in-out';
                        category.style.opacity = '1';
                        // Reinicializar ícones após mostrar
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }, 10);
                } else {
                    category.style.transition = 'opacity 0.3s ease-in-out';
                    category.style.opacity = '0';
                    setTimeout(() => {
                        category.style.display = 'none';
                    }, 300);
                }
            });
            
            // Scroll suave para o topo do container
            document.getElementById('menu-container').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        });
    });
});
</script>
@endpush
@endsection
