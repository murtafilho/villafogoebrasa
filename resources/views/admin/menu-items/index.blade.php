@extends('layouts.admin')

@section('title', 'Itens do Cardápio')
@section('header', 'Gerenciar Itens do Cardápio')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.cardapio.itens.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nome ou descrição" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none">
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none">
                <option value="">Todas</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="search" class="w-4 h-4"></i>
                Filtrar
            </button>
            <a href="{{ route('admin.cardapio.itens.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-2">
                <i data-lucide="x" class="w-4 h-4"></i>
                Limpar
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Itens</h2>
        <a href="{{ route('admin.cardapio.itens.create') }}" class="px-4 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Novo Item
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Imagem</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Destaque</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->hasMedia('photo'))
                                @php
                                    $media = $item->getFirstMedia('photo');
                                    $url = '/storage/' . $media->id . '/' . $media->file_name;
                                    $thumbPath = storage_path('app/public/' . $media->id . '/conversions/' . pathinfo($media->file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($media->file_name, PATHINFO_EXTENSION));
                                    if (file_exists($thumbPath)) {
                                        $url = '/storage/' . $media->id . '/conversions/' . basename($thumbPath);
                                    }
                                @endphp
                                <img src="{{ $url }}" alt="{{ $item->name }}" class="max-w-48 max-h-48 w-auto h-auto object-contain rounded-lg">
                            @else
                                <div class="max-w-48 max-h-48 w-48 aspect-[16/9] bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-lg font-bold text-gray-900">{{ $item->name }}</div>
                            @if($item->subcategory)
                                <div class="text-base text-gray-500 mt-1">{{ $item->subcategory }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-900">
                            {{ $item->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg font-semibold text-gray-900">
                            R$ {{ number_format($item->price, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button 
                                type="button" 
                                data-item-id="{{ $item->id }}"
                                data-featured="{{ $item->is_featured ? '1' : '0' }}"
                                class="toggle-featured relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-villa-ember focus:ring-offset-2 {{ $item->is_featured ? 'bg-villa-ember' : 'bg-gray-300' }}" 
                                title="{{ $item->is_featured ? 'Desativar destaque' : 'Ativar destaque' }}">
                                <span class="toggle-featured-slider inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $item->is_featured ? 'translate-x-6' : 'translate-x-1' }}"></span>
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->is_active)
                                <span class="px-2 py-1 text-base font-semibold rounded-full bg-green-100 text-green-800">Ativo</span>
                            @else
                                <span class="px-2 py-1 text-base font-semibold rounded-full bg-gray-100 text-gray-800">Inativo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg font-medium">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.cardapio.itens.edit', $item) }}" class="text-blue-600 hover:text-blue-800" title="Editar">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                                <form action="{{ route('admin.cardapio.itens.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Excluir">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-base text-gray-500">
                            Nenhum item encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $items->links() }}
        </div>
    @endif
</div>

<script>
    // Aguardar o DOM estar pronto
    document.addEventListener('DOMContentLoaded', function() {
        // AJAX Toggle Featured
        document.querySelectorAll('.toggle-featured').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                const button = this;
                const slider = this.querySelector('.toggle-featured-slider');
                
                // Desabilitar botão durante a requisição
                button.disabled = true;
                
                fetch(`/admin/cardapio/itens/${itemId}/toggle-featured`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Atualizar estado visual
                        const newFeatured = data.is_featured;
                        button.setAttribute('data-featured', newFeatured ? '1' : '0');
                        
                        if (newFeatured) {
                            button.classList.remove('bg-gray-300');
                            button.classList.add('bg-villa-ember');
                            slider.classList.remove('translate-x-1');
                            slider.classList.add('translate-x-6');
                            button.setAttribute('title', 'Desativar destaque');
                        } else {
                            button.classList.remove('bg-villa-ember');
                            button.classList.add('bg-gray-300');
                            slider.classList.remove('translate-x-6');
                            slider.classList.add('translate-x-1');
                            button.setAttribute('title', 'Ativar destaque');
                        }
                    }
                })
                .catch(error => {
                    console.error('Erro ao atualizar destaque:', error);
                    alert('Erro ao atualizar destaque. Por favor, tente novamente.');
                })
                .finally(() => {
                    button.disabled = false;
                });
            });
        });
    });
</script>
@endsection

