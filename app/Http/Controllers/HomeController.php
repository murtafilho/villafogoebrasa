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
                    ->orderBy('sort_order');
            }])
            ->get();

        // Transformar para o formato esperado pela view
        $menuData = [];
        $categories = [];

        foreach ($categoriesFromDb as $category) {
            if ($category->items->isEmpty()) {
                continue;
            }

            $categories[] = $category->name;

            $menuData[$category->name] = $category->items->map(function ($item) {
                return [
                    'nome' => $item->name,
                    'preco' => $item->price ? number_format($item->price, 2, ',', '.') : '',
                    'descricao' => $item->description ?? '',
                    'subcategoria' => $item->subcategory ?? '',
                ];
            })->toArray();
        }

        return view('cardapio', [
            'menuData' => $menuData,
            'categories' => $categories,
        ]);
    }

    public static function getCategoryIcon(string $category): string
    {
        $iconMap = [
            'Carnes' => 'drumstick',
            'Carnes Nobres' => 'drumstick',
            'Rodízio' => 'chef-hat',
            'Rodízio Completo' => 'chef-hat',
            'Acompanhamentos' => 'salad',
            'Sobremesas' => 'cake',
            'Bebidas' => 'wine',
            'Carta de Vinhos' => 'wine',
            'Vinhos' => 'wine',
            'Entradas' => 'utensils-crossed',
            'Pratos Executivos' => 'briefcase',
            'Especiais da Casa' => 'sparkles',
            'Pratos Especiais' => 'star',
            'Saladas' => 'salad',
            'Massas' => 'utensils',
            'Peixes' => 'fish',
            'Frutos do Mar' => 'fish',
            'Aves' => 'chicken',
            'Vegetarianos' => 'leaf',
            'Kids' => 'baby',
            'Infantil' => 'baby',
            'Bebidas Não Alcoólicas' => 'glass-water',
            'Refrigerantes' => 'glass-water',
            'Sucos' => 'glass-water',
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
