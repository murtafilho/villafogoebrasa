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
        // Buscar categorias ativas com seus itens ativos
        $categoriesFromDb = MenuCategory::query()
            ->where('is_active', true)
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
                $media = $item->getFirstMedia('photo');
                
                // Usar método do Spatie para obter URL da conversão 'card', fallback para 'thumb', depois original
                if ($media->hasGeneratedConversion('card')) {
                    $imageUrl = $media->getUrl('card');
                } elseif ($media->hasGeneratedConversion('thumb')) {
                    $imageUrl = $media->getUrl('thumb');
                } else {
                    $imageUrl = $media->getUrl();
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

        // Separar itens em destaque para a seção "Indicações do Chef"
        $featuredItems = [];
        $menuData = [];
        $categories = [];
        $categorySubcategories = [];

        foreach ($categoriesFromDb as $category) {
            if ($category->items->isEmpty()) {
                continue;
            }

            $categories[] = $category->name;

            // Coletar subcategorias únicas desta categoria
            $subcategories = $category->items
                ->pluck('subcategory')
                ->filter(fn($sub) => !empty($sub))
                ->unique()
                ->values()
                ->toArray();

            $categorySubcategories[$category->name] = $subcategories;

            // Separar itens em destaque dos demais
            $featuredInCategory = $category->items->filter(fn($item) => $item->is_featured);
            $regularItems = $category->items->filter(fn($item) => !$item->is_featured);

            // Adicionar itens em destaque à seção especial
            foreach ($featuredInCategory as $item) {
                $featuredItems[] = $processItem($item);
            }

            // Adicionar itens regulares à categoria
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
