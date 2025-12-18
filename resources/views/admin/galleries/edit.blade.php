@extends('layouts.admin')

@section('title', 'Editar Foto')
@section('header', 'Editar Foto da Galeria')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <form action="{{ route('admin.galeria.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoria *</label>
                <select name="category" id="category" required class="w-full px-4 py-2 bg-black text-white text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('category') border-red-500 @enderror">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category', $gallery->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Ordem</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('sort_order') border-red-500 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagem</label>
                @if($gallery->hasMedia('image'))
                    <div class="mb-2">
                        @php
                            $media = $gallery->getFirstMedia('image');
                            $url = '/storage/' . $media->id . '/' . $media->file_name;
                            $thumbPath = storage_path('app/public/' . $media->id . '/conversions/' . pathinfo($media->file_name, PATHINFO_FILENAME) . '-thumb.' . pathinfo($media->file_name, PATHINFO_EXTENSION));
                            if (file_exists($thumbPath)) {
                                $url = '/storage/' . $media->id . '/conversions/' . basename($thumbPath);
                            }
                        @endphp
                        <img src="{{ $url }}" alt="{{ $gallery->title }}" class="w-32 h-32 object-cover rounded-lg">
                        <p class="mt-1 text-xs text-gray-500">Imagem atual</p>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('image') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Deixe em branco para manter a imagem atual. JPEG, JPG, PNG ou WEBP (máx. 2MB)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-villa-ember focus:border-villa-ember outline-none @error('description') border-red-500 @enderror">{{ old('description', $gallery->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Foto em destaque</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }} class="w-4 h-4 text-villa-ember border-gray-300 rounded focus:ring-villa-ember">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Foto ativa</label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Atualizar Foto
            </button>
            <a href="{{ route('admin.galeria.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();
</script>
@endsection

