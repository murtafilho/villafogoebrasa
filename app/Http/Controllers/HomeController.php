<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function cardapio()
    {
        // Buscar categorias ativas com seus itens ativos (excluindo "Indicações do Chef")
        $categoriesFromDb = MenuCategory::query()
            ->where('is_active', true)
            ->where('slug', '!=', 'indicacoes-do-chef')
            ->orderBy('sort_order')
            ->with(['items' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('is_featured', 'desc') // Itens em destaque primeiro
                    ->orderBy('sort_order')
                    ->orderBy('name');
            }])
            ->get();

        // Função auxiliar para processar item
        $processItem = function ($item) {
            $imageUrl = null;

            if ($item->hasMedia('photo')) {
                try {
                    $media = $item->getFirstMedia('photo');

                    // Usar URL original diretamente - mais confiável
                    $imageUrl = $media->getUrl();

                    // Se a URL retornada contém 'http://localhost', remover para usar relativa
                    if (str_contains($imageUrl, 'http://localhost')) {
                        $imageUrl = str_replace('http://localhost', '', $imageUrl);
                    }

                    // Garantir que comece com /storage
                    if (! str_starts_with($imageUrl, '/storage')) {
                        // Se não começa com /storage, construir manualmente
                        $imageUrl = '/storage/'.$media->id.'/'.$media->file_name;
                    }
                } catch (\Exception $e) {
                    // Se houver erro, não definir imagem
                    $imageUrl = null;
                }
            }

            return [
                'nome' => $item->name,
                'preco' => $item->price ? number_format($item->price, 2, ',', '.') : '',
                'descricao' => $item->description ?? '',
                'subcategoria' => $item->subcategory ?? '',
                'imagem' => $imageUrl,
                'is_featured' => $item->is_featured,
                'categoria' => $item->category->name ?? '',
            ];
        };

        // Separar itens destacados (is_featured) para a seção "Indicações do Chef"
        $featuredItems = [];
        $menuData = [];
        $categories = [];
        $categorySubcategories = [];

        foreach ($categoriesFromDb as $category) {
            if ($category->items->isEmpty()) {
                continue;
            }

            // Ignorar categoria "Indicações do Chef" - não é mais uma categoria de menu
            if ($category->slug === 'indicacoes-do-chef') {
                continue;
            }

            $categories[] = $category->name;

            // Coletar subcategorias únicas desta categoria
            $subcategories = $category->items
                ->pluck('subcategory')
                ->filter(fn ($sub) => ! empty($sub))
                ->unique()
                ->values()
                ->toArray();

            $categorySubcategories[$category->name] = $subcategories;

            // Separar itens destacados dos regulares
            $featuredInCategory = $category->items->filter(fn ($item) => $item->is_featured);
            $regularItems = $category->items->filter(fn ($item) => ! $item->is_featured);

            // Adicionar itens destacados à seção especial "Indicações do Chef"
            foreach ($featuredInCategory as $item) {
                $featuredItems[] = $processItem($item);
            }

            // Adicionar apenas itens regulares ao menu normal
            if ($regularItems->isNotEmpty()) {
                $menuData[$category->name] = $regularItems->map($processItem)->toArray();
            }
        }

        return view('cardapio', [
            'featuredItems' => $featuredItems,
            'menuData' => $menuData,
            'categories' => $categories,
            'categorySubcategories' => $categorySubcategories,
        ]);
    }

    public static function getCategoryIcon(string $category): string
    {
        $iconMap = [
            'Carnes' => 'drumstick',
            'Carnes Nobres' => 'drumstick',
            'Parrilla' => 'flame',
            'Rodízio' => 'chef-hat',
            'Rodízio Completo' => 'chef-hat',
            'Acompanhamentos' => 'salad',
            'Guarnições' => 'salad',
            'Sobremesas' => 'cake',
            'Bebidas' => 'wine',
            'Carta de Vinhos' => 'wine',
            'Vinhos' => 'wine',
            'Cervejas' => 'beer',
            'Chopps' => 'beer',
            'Doses' => 'glass-water',
            'Drinks' => 'martini',
            'Entradas' => 'utensils-crossed',
            'Pratos Executivos' => 'briefcase',
            'Especiais da Casa' => 'sparkles',
            'Pratos Especiais' => 'star',
            'Saladas' => 'leaf',
            'Massas' => 'utensils',
            'Peixes' => 'fish',
            'Frutos do Mar' => 'fish',
            'Aves' => 'egg',
            'Vegetarianos' => 'leaf',
            'Kids' => 'baby',
            'Infantil' => 'baby',
            'Serviços' => 'concierge-bell',
            'Cafeteria' => 'coffee',
            'Cafés' => 'coffee',
            'Café' => 'coffee',
        ];

        // Buscar correspondência exata ou parcial
        foreach ($iconMap as $key => $icon) {
            if (stripos($category, $key) !== false) {
                return $icon;
            }
        }

        // Ícone padrão
        return 'utensils';
    }
}
