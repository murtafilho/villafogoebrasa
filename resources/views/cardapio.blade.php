@extends('layouts.app')

@section('title', 'Cardápio - Villa Fogo & Brasa')

@php
    $ogTitle = 'Cardápio Completo - Villa Fogo & Brasa';
    $ogDescription = 'Explore nosso cardápio completo com cortes nobres, pratos especiais, bebidas selecionadas e sobremesas. Autêntico churrasco gaúcho em Nova Lima.';
@endphp

@push('styles')
<style>
    .menu-item-row {
        position: relative;
    }
    
    /* Linha pontilhada entre nome e preço */
    .menu-item-row > .flex {
        position: relative;
    }
    
    /* Container principal que contém imagem e texto */
    .menu-item-row > .flex > .flex-1 {
        position: relative;
    }
    
    /* Linha pontilhada - começa após a imagem e fica abaixo da categoria */
    .menu-item-row > .flex > .flex-1::after {
        content: '';
        position: absolute;
        bottom: 0.5rem;
        left: 0;
        right: 0;
        height: 1px;
        background-image: repeating-linear-gradient(
            to right,
            transparent,
            transparent 3px,
            rgba(196, 92, 38, 0.2) 3px,
            rgba(196, 92, 38, 0.2) 6px
        );
        pointer-events: none;
        margin-left: calc(8rem + 1rem); /* 128px (w-32) + gap-4 (1rem) */
    }
    
    .menu-item-row > .flex > .shrink-0 {
        position: relative;
        z-index: 1;
        background-color: rgba(26, 23, 20, 0.9);
        padding-left: 0.5rem;
    }
</style>
@endpush

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

        <!-- Search -->
        <div class="max-w-xl mx-auto mb-8">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-villa-cream/50"></i>
                <input
                    type="text"
                    id="menu-search"
                    placeholder="Buscar por prato, categoria ou bebida..."
                    class="w-full pl-12 pr-10 py-3 bg-villa-espresso/50 border border-villa-coffee/50 text-villa-cream placeholder-villa-cream/40 focus:border-villa-gold focus:outline-none transition-colors"
                >
                <button
                    id="clear-search"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-villa-cream/50 hover:text-villa-gold transition-colors hidden"
                >
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <p id="search-results-count" class="text-villa-cream/50 text-sm mt-2 text-center hidden"></p>
        </div>

        <!-- Filters -->
        <div class="max-w-xl mx-auto mb-12">
            <div class="flex items-center gap-4">
                <label for="category-filter" class="text-villa-cream/80 text-sm font-medium whitespace-nowrap">
                    Filtrar por categoria:
                </label>
                <select
                    id="category-filter"
                    class="filter-select w-full px-4 py-2 bg-black text-white text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none"
                >
                    <option value="all">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ md5($category) }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Indicações do Chef -->
        @if(!empty($featuredItems) && count($featuredItems) > 0)
            <div class="menu-category mb-16 chef-recommendations" data-category="chef-recommendations" data-category-name="indicações do chef" style="display: block; opacity: 1;">
                <div class="text-center mb-8">
                    <p class="text-villa-gold text-sm tracking-[0.3em] uppercase mb-4">Especial</p>
                    <h2 class="font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-4 line-accent flex items-center justify-center gap-4">
                        <i data-lucide="chef-hat" class="w-8 h-8 lg:w-10 lg:h-10 text-villa-gold"></i>
                        <span>Indicações do Chef</span>
                    </h2>
                    <p class="text-villa-cream/70 max-w-2xl mx-auto">
                        Nossas seleções especiais, cuidadosamente escolhidas para proporcionar uma experiência gastronômica única.
                    </p>
                </div>
                
                <div class="menu-table bg-villa-espresso/30 border border-villa-coffee/30 rounded-lg overflow-hidden">
                    <div class="divide-y divide-villa-coffee/20">
                        @foreach($featuredItems as $item)
                            <div class="menu-item-row py-4 px-6 hover:bg-villa-espresso/50 transition-colors" data-item-name="{{ mb_strtolower($item['nome']) }}" data-item-description="{{ mb_strtolower($item['descricao'] ?? '') }}">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex items-start gap-4 flex-1 min-w-0">
                                        @if(!empty($item['imagem']))
                                            <div class="max-w-32 max-h-32 w-32 aspect-[16/9] shrink-0 rounded-lg overflow-hidden border border-villa-coffee/30">
                                                <img src="{{ asset($item['imagem']) }}" alt="{{ $item['nome'] }}" class="w-full h-full object-contain">
                                            </div>
                                        @else
                                            <div class="max-w-32 max-h-32 w-32 aspect-[16/9] shrink-0 rounded-lg bg-villa-coffee/30 border border-villa-coffee/30 flex items-center justify-center">
                                                <i data-lucide="utensils" class="w-10 h-10 text-villa-cream/30"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h3 class="item-name font-display text-xl text-villa-cream font-semibold">
                                                    {{ $item['nome'] }}
                                                </h3>
                                                <i data-lucide="star" class="w-4 h-4 text-villa-gold fill-current shrink-0" title="Indicação do Chef"></i>
                                            </div>
                                            @if(!empty($item['descricao']))
                                                <p class="text-villa-cream/60 text-sm leading-relaxed mb-1">{{ $item['descricao'] }}</p>
                                            @endif
                                            @if(!empty($item['categoria']))
                                                <p class="text-villa-gold/70 text-xs uppercase tracking-wider">{{ $item['categoria'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!empty($item['preco']))
                                        <div class="flex items-center gap-2 shrink-0">
                                            <span class="text-villa-gold font-display text-lg font-semibold whitespace-nowrap">R$ {{ $item['preco'] }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Menu Items by Category -->
        <div class="space-y-16" id="menu-container">
            @if(empty($menuData) || count($menuData) === 0)
                <div class="text-center py-12">
                    <p class="text-villa-cream/70">Nenhum item encontrado no cardápio.</p>
                </div>
            @else
            @foreach($menuData as $categoria => $itens)
                @php
                    $icon = \App\Http\Controllers\HomeController::getCategoryIcon($categoria);
                @endphp
                <div class="menu-category mb-16" data-category="{{ md5($categoria) }}" data-category-name="{{ mb_strtolower($categoria) }}" style="display: block; opacity: 1;">
                    <h2 class="category-title font-display text-3xl lg:text-4xl font-semibold text-villa-cream mb-8 line-accent flex items-center gap-4">
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
                            <h3 class="subcategory-header font-display text-xl font-medium text-villa-gold mb-4 mt-8" data-subcategory="{{ md5($subcategoria) }}" data-subcategory-name="{{ mb_strtolower($subcategoria) }}">
                                {{ $subcategoria }}
                            </h3>
                        @endif
                        <div class="menu-table bg-villa-espresso/30 border border-villa-coffee/30 rounded-lg overflow-hidden {{ $subcategoria !== '_sem_subcategoria' ? 'mb-8' : '' }}" data-subcategory-group="{{ $subcategoria !== '_sem_subcategoria' ? md5($subcategoria) : 'none' }}">
                            <div class="divide-y divide-villa-coffee/20">
                                @foreach($subItems as $item)
                                    <div class="menu-item-row py-4 px-6 hover:bg-villa-espresso/50 transition-colors" data-item-subcategory="{{ !empty($item['subcategoria']) ? md5($item['subcategoria']) : 'none' }}" data-item-name="{{ mb_strtolower($item['nome']) }}" data-item-description="{{ mb_strtolower($item['descricao'] ?? '') }}">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                                @if(!empty($item['imagem']))
                                                    <div class="max-w-32 max-h-32 w-32 aspect-[16/9] shrink-0 rounded-lg overflow-hidden border border-villa-coffee/30">
                                                        <img src="{{ asset($item['imagem']) }}" alt="{{ $item['nome'] }}" class="w-full h-full object-contain">
                                                    </div>
                                                @else
                                                    <div class="max-w-32 max-h-32 w-32 aspect-[16/9] shrink-0 rounded-lg bg-villa-coffee/30 border border-villa-coffee/30 flex items-center justify-center">
                                                        <i data-lucide="utensils" class="w-10 h-10 text-villa-cream/30"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="item-name font-display text-xl text-villa-cream font-semibold mb-1">
                                                        {{ $item['nome'] }}
                                                    </h3>
                                                    @if(!empty($item['descricao']))
                                                        <p class="text-villa-cream/60 text-sm leading-relaxed mb-1">{{ $item['descricao'] }}</p>
                                                    @endif
                                                    @if(!empty($item['categoria']))
                                                        <p class="text-villa-gold/70 text-xs uppercase tracking-wider">{{ $item['categoria'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(!empty($item['preco']))
                                                <div class="flex items-center gap-2 shrink-0">
                                                    <span class="text-villa-gold font-display text-lg font-semibold whitespace-nowrap">R$ {{ $item['preco'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            @endif
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

    // Elementos
    const searchInput = document.getElementById('menu-search');
    const clearSearchBtn = document.getElementById('clear-search');
    const searchResultsCount = document.getElementById('search-results-count');
    const categoryFilter = document.getElementById('category-filter');
    const categories = document.querySelectorAll('.menu-category');

    // Função para normalizar texto (remover acentos)
    function normalizeText(text) {
        return text.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
    }

    // Função para aplicar filtro de categoria
    function applyCategoryFilter(filterValue) {
        // Mostrar/esconder seção de indicações do chef
        const chefSection = document.querySelector('.chef-recommendations');
        if (chefSection) {
            if (filterValue === 'all' || filterValue === 'chef-recommendations') {
                if (filterValue === 'chef-recommendations') {
                    // Mostrar apenas indicações do chef
                    chefSection.style.display = 'block';
                    chefSection.style.opacity = '1';
                } else {
                    // Mostrar indicações do chef quando "all"
                    chefSection.style.display = 'block';
                    chefSection.style.opacity = '1';
                }
            } else {
                chefSection.style.display = 'none';
            }
        }

        categories.forEach(category => {
            const categoryId = category.getAttribute('data-category');

            if (filterValue === 'all') {
                // Mostrar todas as categorias
                category.style.display = 'block';
                category.style.opacity = '1';
                showAllItemsInCategory(category);
            } else if (filterValue === 'chef-recommendations') {
                // Esconder todas as categorias normais quando filtrar por indicações do chef
                category.style.display = 'none';
            } else if (categoryId === filterValue) {
                // Mostrar apenas a categoria selecionada
                category.style.display = 'block';
                category.style.opacity = '1';
                showAllItemsInCategory(category);
            } else {
                category.style.display = 'none';
            }
        });
    }

    // Função para mostrar todos os itens
    function showAll() {
        // Mostrar seção de indicações do chef
        const chefSection = document.querySelector('.chef-recommendations');
        if (chefSection) {
            chefSection.style.display = 'block';
            chefSection.style.opacity = '1';
        }
        
        categories.forEach(cat => {
            cat.style.display = 'block';
            cat.style.opacity = '1';
            cat.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'block');
            cat.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'block');
            cat.querySelectorAll('.menu-item-row').forEach(i => i.style.display = 'block');
        });
    }

    // Função para mostrar todos os itens de uma categoria
    function showAllItemsInCategory(categoryEl) {
        categoryEl.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'block');
        categoryEl.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'block');
        categoryEl.querySelectorAll('.menu-item-row').forEach(i => i.style.display = 'block');
    }

    // Função para filtrar por subcategoria
    function filterBySubcategory(categoryEl, subcategoryHash) {
        categoryEl.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'none');
        categoryEl.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'none');
        categoryEl.querySelectorAll('.menu-item-row').forEach(i => i.style.display = 'none');

        const header = categoryEl.querySelector(`.subcategory-header[data-subcategory="${subcategoryHash}"]`);
        if (header) header.style.display = 'block';

        const group = categoryEl.querySelector(`[data-subcategory-group="${subcategoryHash}"]`);
        if (group) {
            group.style.display = 'block';
            group.querySelectorAll('.menu-item-row').forEach(i => i.style.display = 'block');
        }
    }

    // Função auxiliar para verificar se o texto corresponde à busca
    function matchesSearch(text, query) {
        if (!text || !query) return false;
        const normalizedText = normalizeText(text);
        const normalizedQuery = normalizeText(query);
        
        // Busca exata ou parcial
        if (normalizedText.includes(normalizedQuery)) return true;
        
        // Busca por palavras individuais (para queries com múltiplas palavras)
        const queryWords = normalizedQuery.split(/\s+/).filter(w => w.length > 0);
        if (queryWords.length > 1) {
            // Se todas as palavras estão presentes no texto
            return queryWords.every(word => normalizedText.includes(word));
        }
        
        return false;
    }

    // Busca auto-filtrante melhorada
    function performSearch(query) {
        const normalizedQuery = normalizeText(query.trim());
        const chefSection = document.querySelector('.chef-recommendations');

        if (normalizedQuery === '') {
            showAll();
            clearSearchBtn.classList.add('hidden');
            searchResultsCount.classList.add('hidden');
            if (categoryFilter) {
                categoryFilter.value = 'all';
            }
            applyCategoryFilter('all');
            return;
        }

        clearSearchBtn.classList.remove('hidden');

        let totalMatches = 0;

        // Buscar na seção de indicações do chef
        if (chefSection) {
            let chefMatchCount = 0;
            chefSection.querySelectorAll('.menu-item-row').forEach(item => {
                const itemName = item.getAttribute('data-item-name') || '';
                const itemDesc = item.getAttribute('data-item-description') || '';
                
                if (matchesSearch(itemName, normalizedQuery) || matchesSearch(itemDesc, normalizedQuery)) {
                    item.style.display = 'block';
                    chefMatchCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            if (chefMatchCount > 0) {
                chefSection.style.display = 'block';
                chefSection.style.opacity = '1';
                totalMatches += chefMatchCount;
            } else {
                chefSection.style.display = 'none';
            }
        }

        categories.forEach(category => {
            const categoryName = category.getAttribute('data-category-name') || '';
            const categoryNameMatches = matchesSearch(categoryName, normalizedQuery);

            let categoryMatchCount = 0;

            // Esconder tudo primeiro
            category.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'none');
            category.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'none');
            category.querySelectorAll('.menu-item-row').forEach(i => i.style.display = 'none');

            // Se o nome da categoria corresponde, mostrar tudo dela
            if (categoryNameMatches) {
                showAllItemsInCategory(category);
                category.style.display = 'block';
                category.style.opacity = '1';
                categoryMatchCount = category.querySelectorAll('.menu-item-row').length;
                totalMatches += categoryMatchCount;
                return; // próxima categoria
            }

            // Verificar subcategorias
            category.querySelectorAll('.subcategory-header').forEach(header => {
                const subcatName = header.getAttribute('data-subcategory-name') || '';
                if (matchesSearch(subcatName, normalizedQuery)) {
                    header.style.display = 'block';
                    const subcatHash = header.getAttribute('data-subcategory');
                    const group = category.querySelector(`[data-subcategory-group="${subcatHash}"]`);
                    if (group) {
                        group.style.display = 'block';
                        group.querySelectorAll('.menu-item-row').forEach(item => {
                            item.style.display = 'block';
                            categoryMatchCount++;
                        });
                    }
                }
            });

            // Buscar em cada item (nome e descrição)
            category.querySelectorAll('.menu-item-row').forEach(item => {
                // Se já está visível por subcategoria, pular
                if (item.style.display === 'block') return;

                const itemName = item.getAttribute('data-item-name') || '';
                const itemDesc = item.getAttribute('data-item-description') || '';

                if (matchesSearch(itemName, normalizedQuery) || matchesSearch(itemDesc, normalizedQuery)) {
                    item.style.display = 'block';
                    categoryMatchCount++;

                    // Mostrar o grupo pai
                    const itemSubcat = item.closest('[data-subcategory-group]');
                    if (itemSubcat) {
                        itemSubcat.style.display = 'block';
                        const subcatHash = itemSubcat.getAttribute('data-subcategory-group');
                        const header = category.querySelector(`.subcategory-header[data-subcategory="${subcatHash}"]`);
                        if (header) header.style.display = 'block';
                    }
                }
            });

            // Mostrar/esconder categoria baseado em matches
            if (categoryMatchCount > 0) {
                category.style.display = 'block';
                category.style.opacity = '1';
                totalMatches += categoryMatchCount;
            } else {
                category.style.display = 'none';
            }
        });

        // Atualizar contador de resultados
        if (totalMatches > 0) {
            searchResultsCount.textContent = `${totalMatches} item${totalMatches !== 1 ? 's' : ''} encontrado${totalMatches !== 1 ? 's' : ''}`;
            searchResultsCount.classList.remove('hidden');
        } else {
            searchResultsCount.textContent = 'Nenhum item encontrado';
            searchResultsCount.classList.remove('hidden');
        }
    }

    // Event listeners para busca
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => performSearch(this.value), 150);
    });

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        performSearch('');
        searchInput.focus();
    });

    // Filtro de categorias via select
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            // Limpar busca ao mudar filtro
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchResultsCount.classList.add('hidden');

            const filterValue = this.value;
            applyCategoryFilter(filterValue);
        });
    }
});
</script>
@endpush
@endsection
