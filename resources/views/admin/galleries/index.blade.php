@extends('layouts.admin')

@section('title', 'Galeria')
@section('header', 'Gerenciar Galeria')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.galeria.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Título ou descrição" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none">
        </div>
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select name="category" id="category" class="w-full px-4 py-2 bg-black text-white text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none">
                <option value="">Todas</option>
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="search" class="w-4 h-4"></i>
                Filtrar
            </button>
            <a href="{{ route('admin.galeria.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-2">
                <i data-lucide="x" class="w-4 h-4"></i>
                Limpar
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Lista de Fotos</h2>
        <a href="{{ route('admin.galeria.create') }}" class="px-4 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Nova Foto
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        @forelse($galleries as $gallery)
            <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                @if($gallery->hasMedia('image'))
                    @php
                        $media = $gallery->getFirstMedia('image');
                        $url = '/storage/' . $media->id . '/' . $media->file_name;
                        $thumbPath = storage_path('app/public/' . $media->id . '/conversions/' . pathinfo($media->file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($media->file_name, PATHINFO_EXTENSION));
                        if (file_exists($thumbPath)) {
                            $url = '/storage/' . $media->id . '/conversions/' . basename($thumbPath);
                        }
                    @endphp
                    <img src="{{ $url }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $gallery->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $categories[$gallery->category] ?? $gallery->category }}</p>
                    @if($gallery->is_featured)
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-villa-gold/20 text-villa-gold mb-2">Destaque</span>
                    @endif
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('admin.galeria.edit', $gallery) }}" class="flex-1 px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors flex items-center justify-center gap-1">
                            <i data-lucide="edit" class="w-3 h-3"></i>
                            Editar
                        </a>
                        <form action="{{ route('admin.galeria.destroy', $gallery) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem certeza que deseja excluir esta foto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors flex items-center justify-center gap-1">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Nenhuma foto encontrada.
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $galleries->links() }}
        </div>
    @endif
</div>

<script>
    lucide.createIcons();
</script>
@endsection

