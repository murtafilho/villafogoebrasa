@extends('layouts.admin')

@section('title', 'Novo Item')
@section('header', 'Criar Novo Item do Cardápio')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.cardapio.itens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria *</label>
                <select name="category_id" id="category_id" required class="w-full px-4 py-2 bg-black text-white text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('category_id') border-red-500 @enderror">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $defaultCategory?->id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

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
                <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Subcategoria</label>
                <input type="text" name="subcategory" id="subcategory" value="{{ old('subcategory') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('subcategory') border-red-500 @enderror">
                @error('subcategory')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Preço *</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">R$</span>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required placeholder="0.00" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('price') border-red-500 @enderror">
                </div>
                @error('price')
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
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto do Prato</label>
                <input type="file" name="photo" id="photo" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('photo') border-red-500 @enderror" onchange="previewImage(this)">
                <p class="mt-1 text-xs text-gray-500">JPEG, JPG, PNG ou WEBP (máx. 2MB)</p>
                <div id="image-preview" class="mt-3 hidden">
                    <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                </div>
                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Item em destaque</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Item ativo</label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Salvar Item
            </button>
            <a href="{{ route('admin.cardapio.itens.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();

    // Preview de imagem
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
        }
    }

    // Gerar slug automaticamente a partir do nome
    document.getElementById('name').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
            const slug = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });

    // Permitir edição manual do slug
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
    });
</script>
@endsection

