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
                    $subcategories = $categorySubcategories[$category] ?? [];
                @endphp
                @if(count($subcategories) > 0)
                    <div class="relative group">
                        <button
                            class="filter-btn px-6 py-2 border border-villa-coffee text-villa-cream/70 hover:border-villa-gold hover:text-villa-gold text-sm tracking-wider uppercase transition-all flex items-center gap-2"
                            data-filter="{{ md5($category) }}"
                        >
                            <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
                            <span>{{ $category }}</span>
                            <i data-lucide="chevron-down" class="w-3 h-3 ml-1 transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute left-0 top-full mt-1 min-w-max bg-villa-espresso border border-villa-coffee/50 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <button
                                class="subcategory-btn w-full text-left px-4 py-2 text-sm text-villa-cream/70 hover:bg-villa-ember/20 hover:text-villa-gold transition-colors"
                                data-filter="{{ md5($category) }}"
                                data-subcategory="all"
                            >
                                Ver Todos
                            </button>
                            @foreach($subcategories as $subcategory)
                                <button
                                    class="subcategory-btn w-full text-left px-4 py-2 text-sm text-villa-cream/70 hover:bg-villa-ember/20 hover:text-villa-gold transition-colors"
                                    data-filter="{{ md5($category) }}"
                                    data-subcategory="{{ md5($subcategory) }}"
                                >
                                    {{ $subcategory }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <button
                        class="filter-btn px-6 py-2 border border-villa-coffee text-villa-cream/70 hover:border-villa-gold hover:text-villa-gold text-sm tracking-wider uppercase transition-all flex items-center gap-2"
                        data-filter="{{ md5($category) }}"
                    >
                        <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
                        <span>{{ $category }}</span>
                    </button>
                @endif
            @endforeach
        </div>

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
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 {{ $subcategoria !== '_sem_subcategoria' ? 'mb-8' : '' }}" data-subcategory-group="{{ $subcategoria !== '_sem_subcategoria' ? md5($subcategoria) : 'none' }}">
                            @foreach($subItems as $item)
                                <div class="menu-item bg-villa-espresso/50 p-6 border border-villa-coffee/30 hover:border-villa-ember/50 transition-all card-hover" data-item-subcategory="{{ !empty($item['subcategoria']) ? md5($item['subcategoria']) : 'none' }}" data-item-name="{{ mb_strtolower($item['nome']) }}" data-item-description="{{ mb_strtolower($item['descricao'] ?? '') }}">
                                    <div class="flex justify-between items-start mb-3 gap-4">
                                        <h3 class="item-name font-display text-xl text-villa-cream flex-1">{{ $item['nome'] }}</h3>
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
    const filterBtns = document.querySelectorAll('.filter-btn');
    const subcategoryBtns = document.querySelectorAll('.subcategory-btn');
    const categories = document.querySelectorAll('.menu-category');
    const menuItems = document.querySelectorAll('.menu-item');

    // Função para normalizar texto (remover acentos)
    function normalizeText(text) {
        return text.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
    }

    // Função para resetar estado dos botões
    function resetButtonStates() {
        filterBtns.forEach(b => {
            b.classList.remove('active', 'bg-villa-ember', 'text-white');
            b.classList.add('border', 'border-villa-coffee', 'text-villa-cream/70');
        });
    }

    // Função para mostrar todos os itens
    function showAll() {
        categories.forEach(cat => {
            cat.style.display = 'block';
            cat.style.opacity = '1';
            cat.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'block');
            cat.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'grid');
            cat.querySelectorAll('.menu-item').forEach(i => i.style.display = 'block');
        });
    }

    // Função para mostrar todos os itens de uma categoria
    function showAllItemsInCategory(categoryEl) {
        categoryEl.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'block');
        categoryEl.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'grid');
        categoryEl.querySelectorAll('.menu-item').forEach(i => i.style.display = 'block');
    }

    // Função para filtrar por subcategoria
    function filterBySubcategory(categoryEl, subcategoryHash) {
        categoryEl.querySelectorAll('.subcategory-header').forEach(h => h.style.display = 'none');
        categoryEl.querySelectorAll('[data-subcategory-group]').forEach(g => g.style.display = 'none');
        categoryEl.querySelectorAll('.menu-item').forEach(i => i.style.display = 'none');

        const header = categoryEl.querySelector(`.subcategory-header[data-subcategory="${subcategoryHash}"]`);
        if (header) header.style.display = 'block';

        const group = categoryEl.querySelector(`[data-subcategory-group="${subcategoryHash}"]`);
        if (group) {
            group.style.display = 'grid';
            group.querySelectorAll('.menu-item').forEach(i => i.style.display = 'block');
        }
    }

    // Busca auto-filtrante
    function performSearch(query) {
        const normalizedQuery = normalizeText(query.trim());

        if (normalizedQuery === '') {
            showAll();
            clearSearchBtn.classList.add('hidden');
            searchResultsCount.classList.add('hidden');
            resetButtonStates();
            filterBtns[0].classList.add('active', 'bg-villa-ember', 'text-white');
            filterBtns[0].classList.remove('border', 'border-villa-coffee', 'text-villa-cream/70');
            return;
        }

        clearSearchBtn.classList.remove('hidden');
        resetButtonStates();

        let totalMatches = 0;

        categories.forEach(category => {
            const categoryName = normalizeText(category.getAttribute('data-category-name') || '');
            const categoryMatches = categoryName.includes(normalizedQuery);

            let hasVisibleItems = false;

            // Verificar subcategorias e itens
            category.querySelectorAll('.subcategory-header').forEach(header => {
                const subcatName = normalizeText(header.getAttribute('data-subcategory-name') || '');
                const subcatMatches = subcatName.includes(normalizedQuery);
                header.style.display = subcatMatches || categoryMatches ? 'block' : 'none';
            });

            category.querySelectorAll('.menu-item').forEach(item => {
                const itemName = normalizeText(item.getAttribute('data-item-name') || '');
                const itemDesc = normalizeText(item.getAttribute('data-item-description') || '');
                const itemSubcat = item.closest('[data-subcategory-group]');
                const subcatName = itemSubcat ? normalizeText(document.querySelector(`.subcategory-header[data-subcategory="${itemSubcat.getAttribute('data-subcategory-group')}"]`)?.getAttribute('data-subcategory-name') || '') : '';

                const matches = categoryMatches ||
                               itemName.includes(normalizedQuery) ||
                               itemDesc.includes(normalizedQuery) ||
                               subcatName.includes(normalizedQuery);

                if (matches) {
                    item.style.display = 'block';
                    hasVisibleItems = true;
                    totalMatches++;

                    // Mostrar o grupo pai se o item é visível
                    if (itemSubcat) {
                        itemSubcat.style.display = 'grid';
                        const subcatHash = itemSubcat.getAttribute('data-subcategory-group');
                        const header = category.querySelector(`.subcategory-header[data-subcategory="${subcatHash}"]`);
                        if (header) header.style.display = 'block';
                    }
                } else {
                    item.style.display = 'none';
                }
            });

            // Mostrar/esconder categoria
            if (hasVisibleItems || categoryMatches) {
                category.style.display = 'block';
                category.style.opacity = '1';

                // Se a categoria inteira corresponde, mostrar todos os itens
                if (categoryMatches) {
                    showAllItemsInCategory(category);
                    totalMatches = category.querySelectorAll('.menu-item').length;
                }
            } else {
                category.style.display = 'none';
            }

            // Esconder grupos vazios
            category.querySelectorAll('[data-subcategory-group]').forEach(group => {
                const visibleItems = group.querySelectorAll('.menu-item[style*="display: block"], .menu-item:not([style*="display: none"])');
                const hasVisible = Array.from(group.querySelectorAll('.menu-item')).some(i => i.style.display !== 'none');
                if (!hasVisible && !categoryMatches) {
                    group.style.display = 'none';
                }
            });
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

    // Filtro principal de categorias
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Limpar busca ao clicar em filtro
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchResultsCount.classList.add('hidden');

            const filter = this.getAttribute('data-filter');

            resetButtonStates();
            this.classList.add('active', 'bg-villa-ember', 'text-white');
            this.classList.remove('border', 'border-villa-coffee', 'text-villa-cream/70');

            categories.forEach(category => {
                const categoryId = category.getAttribute('data-category');

                if (filter === 'all' || categoryId === filter) {
                    category.style.display = 'block';
                    category.style.opacity = '1';
                    showAllItemsInCategory(category);
                } else {
                    category.style.display = 'none';
                }
            });
        });
    });

    // Filtro de subcategorias
    subcategoryBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();

            // Limpar busca ao clicar em filtro
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchResultsCount.classList.add('hidden');

            const categoryFilter = this.getAttribute('data-filter');
            const subcategoryFilter = this.getAttribute('data-subcategory');

            resetButtonStates();

            const parentBtn = this.closest('.group').querySelector('.filter-btn');
            if (parentBtn) {
                parentBtn.classList.add('active', 'bg-villa-ember', 'text-white');
                parentBtn.classList.remove('border', 'border-villa-coffee', 'text-villa-cream/70');
            }

            categories.forEach(category => {
                const categoryId = category.getAttribute('data-category');

                if (categoryId === categoryFilter) {
                    category.style.display = 'block';
                    category.style.opacity = '1';

                    if (subcategoryFilter === 'all') {
                        showAllItemsInCategory(category);
                    } else {
                        filterBySubcategory(category, subcategoryFilter);
                    }
                } else {
                    category.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
@endsection
