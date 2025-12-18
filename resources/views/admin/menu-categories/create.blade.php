@extends('layouts.admin')

@section('title', 'Nova Categoria')
@section('header', 'Criar Nova Categoria')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.cardapio.categorias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('slug') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Deixe em branco para gerar automaticamente</p>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="menu_type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Menu</label>
                <input type="text" name="menu_type" id="menu_type" value="{{ old('menu_type', 'principal') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('menu_type') border-red-500 @enderror">
                @error('menu_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('sort_order') border-red-500 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cover" class="block text-sm font-medium text-gray-700 mb-1">Imagem de Capa</label>
                <input type="file" name="cover" id="cover" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('cover') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">JPEG, JPG, PNG ou WEBP (máx. 2MB)</p>
                @error('cover')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Categoria ativa</label>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Salvar Categoria
            </button>
            <a href="{{ route('admin.cardapio.categorias.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();
</script>
@endsection


