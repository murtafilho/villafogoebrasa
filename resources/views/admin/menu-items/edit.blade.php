@extends('layouts.admin')

@section('title', 'Editar Item')
@section('header', 'Editar Item do Cardápio')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.cardapio.itens.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria *</label>
                <select name="category_id" id="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('category_id') border-red-500 @enderror">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $item->slug) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('slug') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Deixe em branco para gerar automaticamente</p>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-1">Subcategoria</label>
                <input type="text" name="subcategory" id="subcategory" value="{{ old('subcategory', $item->subcategory) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('subcategory') border-red-500 @enderror">
                @error('subcategory')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Preço *</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">R$</span>
                    <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" step="0.01" min="0" required placeholder="0.00" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('price') border-red-500 @enderror">
                </div>
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('sort_order') border-red-500 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('description') border-red-500 @enderror">{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto do Prato</label>
                @if($item->hasMedia('photo'))
                    <div class="mb-2">
                        @php
                            $media = $item->getFirstMedia('photo');
                            $url = '/storage/' . $media->id . '/' . $media->file_name;
                            $thumbPath = storage_path('app/public/' . $media->id . '/conversions/' . pathinfo($media->file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($media->file_name, PATHINFO_EXTENSION));
                            if (file_exists($thumbPath)) {
                                $url = '/storage/' . $media->id . '/conversions/' . basename($thumbPath);
                            }
                        @endphp
                        <img src="{{ $url }}" alt="{{ $item->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-200" id="current-image">
                        <p class="mt-1 text-xs text-gray-500">Imagem atual</p>
                    </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('photo') border-red-500 @enderror" onchange="previewImage(this)">
                <p class="mt-1 text-xs text-gray-500">Deixe em branco para manter a imagem atual. JPEG, JPG, PNG ou WEBP (máx. 2MB)</p>
                <div id="image-preview" class="mt-3 hidden">
                    <p class="text-xs text-gray-500 mb-1">Nova imagem:</p>
                    <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                </div>
                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Item em destaque</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Item ativo</label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Atualizar Item
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
        const currentImg = document.getElementById('current-image');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                if (currentImg) {
                    currentImg.classList.add('opacity-50');
                }
            };
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            if (currentImg) {
                currentImg.classList.remove('opacity-50');
            }
        }
    }
</script>
@endsection

